<?php

namespace App\Http\Controllers;

use App\Contracts\TaskStatus\TaskStatusServicesInterface;
use App\Models\TaskStatus;
use App\Http\Requests\Web\TaskStatus\StoreTaskStatusRequest;
use App\Http\Requests\Web\TaskStatus\UpdateTaskStatusRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;

class TaskStatusController extends Controller
{
    // Members
    private TaskStatusServicesInterface $statusService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(TaskStatusServicesInterface $statusService, Logger $logger)
    {
        $this->statusService = $statusService;
        $this->logger = $logger;
    }
    // End Constructor

    // Methods

    public function index()
    {
        try {
            // Get all status
            $statuss = $this->statusService->getAllStatus();

            // Log successful retrieval (optional)
            $this->logger->info('Retrieved all status successfully');

            // Render a view with the status
            return view('status.index', ['status' => $statuss]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error fetching status: ' . $e->getMessage());

            // Return an error view (customize as needed)
            return view('errors.500');
        }
    }

    public function show(int $statusId)
    {
        try {
            // Get a specific status by ID
            $status = $this->statusService->getStatusById($statusId); // I found that if i change the name to findTaskById() is more clarity. no worries for now

            if (!$status) {
                // status not found
                return abort(404, 'status not found');
            }

            // Map the retrieved data to a view model (if needed)
            // For example:
            // $model = new RecurringTaskModel($status);

            // Return a view with the status details
            return view('status.show', ['status' => $status]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            // For example:
            // Log::error('Error fetching status details: ' . $e->getMessage());
            $this->logger->error('Error fetching status details: ' . $e->getMessage());

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function store(StoreTaskStatusRequest $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new status from the request data
            $status = new TaskStatus([
                'title' => $request->input("title"),

            ]);

            // Add the status to the database
            $this->statusService->addStatus($status);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('status.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error creating status: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function update(UpdateTaskStatusRequest $request, int $statusId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific status by ID
            $status = $this->statusService->getStatusById($statusId);

            if (!$status) {
                // status not found
                return abort(404, 'status not found');
            }

            // Update status properties from the request data
            $status->title = $request->input("title");


            // Save the updated status
            $this->statusService->updateStatus($status);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('status.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error updating status: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function destroy(int $statusId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific status by ID
            $status = $this->statusService->getStatusById($statusId);

            if (!$status) {
                // status not found
                return abort(404, 'status not found');
            }

            // Delete the status
            $this->statusService->deleteStatus($status);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('status.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error deleting status: ' . $e->getMessage());

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
