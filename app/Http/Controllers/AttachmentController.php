<?php

namespace App\Http\Controllers;

use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Models\Attachment;
use App\Http\Requests\Web\Attachment\StoreAttachmentRequest;
use App\Http\Requests\Web\Attachment\UpdateAttachmentRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        try {
            // Get all attachments
            $attachmentss = $this->attachmentService->getAllAttachments();

            // Log successful retrieval (optional)
            $this->logger->info('Retrieved all attachments successfully');

            // Render a view with the attachments
            return view('attachments.index', ['attachments' => $attachmentss]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error fetching attachments: ' . $e->getMessage());

            // Return an error view (customize as needed)
            return view('errors.500');
        }
    }

    public function show(int $attachmentId)
    {
        try {
            // Get a specific attachments by ID
            $attachments = $this->attachmentService->getattachmentById($attachmentId); // I found that if i change the name to findattachmentsById() is more clarity. no worries for now

            if (!$attachments) {
                // attachments not found
                return abort(404, 'attachments not found');
            }

            // Map the retrieved data to a view model (if needed)
            // For example:
            // $model = new RecurringattachmentsModel($attachments);

            // Return a view with the attachments details
            return view('attachments.show', ['attachments' => $attachments]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            // For example:
            // Log::error('Error fetching attachments details: ' . $e->getMessage());
            $this->logger->error('Error fetching attachments details: ' . $e->getMessage());

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function store(StoreattachmentRequest $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new attachments from the request data
            $attachments = new attachment([
                'title' => $request->input("title"),
                'short_description' => $request->input("short_description"),
                'long_description' => $request->input("long_description"),
                'due_date' => $request->input("due_date"),
                'priority' => $request->input("priority"),
                'status_id' => $request->input("status_id"),
                'status' => $request->input("status"),
                'created_by' => $request->input("created_by"),
                'assigned_to' => $request->input("assigned_to"),
                'is_recurring' => $request->input("is_recurring"),
                'recurring_attachments_id' => $request->input("recurring_attachments_id"),
            ]);

            // Add the attachments to the database
            $this->attachmentService->addattachment($attachments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error creating attachments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function update(UpdateattachmentRequest $request, int $attachmentId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific attachments by ID
            $attachments = $this->attachmentService->getattachmentById($attachmentId);

            if (!$attachments) {
                // attachments not found
                return abort(404, 'attachments not found');
            }

            // Update attachments properties from the request data
            $attachments->title = $request->input("title");
            $attachments->short_description = $request->input("short_description");
            $attachments->long_description = $request->input("long_description");
            $attachments->due_date = $request->input("due_date");
            $attachments->priority = $request->input("priority");
            $attachments->status_id = $request->input("status_id");
            $attachments->status = $request->input("status");
            $attachments->created_by = $request->input("created_by");
            $attachments->assigned_to = $request->input("assigned_to");
            $attachments->is_recurring = $request->input("is_recurring");
            $attachments->recurring_attachments_id = $request->input("recurring_attachments_id");

            // Save the updated attachments
            $this->attachmentService->updateattachment($attachments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error updating attachments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function destroy(int $attachmentId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific attachments by ID
            $attachments = $this->attachmentService->getattachmentById($attachmentId);

            if (!$attachments) {
                // attachments not found
                return abort(404, 'attachments not found');
            }

            // Delete the attachments
            $this->attachmentService->deleteattachment($attachments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('attachments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error deleting attachments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    // End Methods

    // Helpers

    // End Helpers
}
