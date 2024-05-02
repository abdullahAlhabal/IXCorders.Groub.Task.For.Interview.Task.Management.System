<?php

namespace App\Http\Controllers;

use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Models\Attachment;
use App\Http\Requests\Web\Attachment\StoreAttachmentRequest;
use App\Http\Requests\Web\Attachment\UpdateAttachmentRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{    // Members
    private AttachmentServicesInterface $attachmentService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(AttachmentServicesInterface $attachmentService, Logger $logger)
    {
        $this->attachmentService = $attachmentService;
        $this->logger = $logger;
    }
    // End Constructor

    // Methods

    public function index(Request $request)
    {
        try {

            $perPage = $request->query('perPage', 10);

            $attachmentss = $this->attachmentService->getAllAttachments();

            $this->logger->info('Retrieved all attachments successfully');

            return view('attachments.index', ['attachments' => $attachmentss]);
        } catch (\Exception $e) {
            $this->logger->error('Error fetching attachments: ' . $e->getMessage());

            return view('errors.500');
        }
    }

    public function show(int $attachmentId)
    {
        try {
            $attachments = $this->attachmentService->getattachmentById($attachmentId);

            if (!$attachments) {
                return abort(404, 'attachments not found');
            }


            return view('attachments.show', ['attachments' => $attachments]);
        } catch (\Exception $e) {
            $this->logger->error('Error fetching attachments details: ' . $e->getMessage());

            return view('errors.500');
        }
    }

    public function create($taskId)
    {
        try {
            $this->authorize('create', Attachment::class);
            return view('attachments.create', compact("taskId"));

        } catch (\Exception $e) {

            $this->logger->error('Error : ' . $e->getMessage());
            session()->flash('error', 'Error .');
            return abort(500, 'Error ');
        }
    }

    public function store(StoreattachmentRequest $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('attachment_path');

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('attachments', $fileName, 'public');

            $attachments = new Attachment([
              'attachment_path' => "storage/attachments/$fileName",
              'attached_by' => Auth::id(),
              'task_id' => $request->input("task_id"),
            ]);

            $this->attachmentService->addattachment($attachments);

            DB::commit();

            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            $this->logger->error('Error creating attachments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function update(UpdateattachmentRequest $request, int $attachmentId)
    {
        try {
            DB::beginTransaction();

            $attachments = $this->attachmentService->getAttachmentById($attachmentId);

            if (!$attachments) {
              return abort(404, 'Attachment not found');
            }

            $file = $request->file('attachment_path');

            if (!$file) {
                $attachments->update($request->all());
            } else {
              $this->deleteAttachmentFile($attachments->attachment_path);

              $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
              $file->storeAs('attachments', $fileName, 'public');

              $attachments->attachment_path = "storage/attachments/$fileName";
            }

            $this->attachmentService->updateAttachment($attachments);

            DB::commit();

            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            $this->logger->error('Error updating attachments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function destroy(int $attachmentId)
    {
        try {
            DB::beginTransaction();

            $attachments = $this->attachmentService->getattachmentById($attachmentId);

            if (!$attachments) {
                return abort(404, 'attachments not found');
            }
            $this->attachmentService->deleteattachment($attachments);

            DB::commit();
            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            $this->logger->error('Error deleting attachments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500'); // Customize the error view as needed
        }
    }

    // End Methods

    // Helpers

    private function deleteAttachmentFile(string $filePath): void
    {
      if (Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath);
      }
    }

    // End Helpers
}
