<?php

namespace App\Http\Controllers;

use App\Contracts\RecurringTask\RecurringTaskServiceInterface;
use App\Models\RecurringTask;
use Illuminate\Support\Collection;
use App\Http\Requests\Web\RecurringTask\StoreRecurringTaskRequest;
use App\Http\Requests\Web\RecurringTask\UpdateRecurringTaskRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB; // Import the DB facade for transactions



class RecurringTaskController extends Controller
{
    // Members
    private RecurringTaskServiceInterface $taskService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(RecurringTaskServiceInterface $taskService, Logger $logger)
    {
        $this->taskService = $taskService;
        $this->logger = $logger;
    }
    // End Constructor

    // Methods

    public function index()
    {
        try {
            // Get all tasks
            $tasks = $this->taskService->getAllTasks();

            // Log successful retrieval (optional)
            $this->logger->info('Retrieved all tasks successfully');

            // Render a view with the tasks
            return view('tasks.index', ['tasks' => $tasks]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error fetching tasks: ' . $e->getMessage());

            // Return an error view (customize as needed)
            return view('errors.500');
        }
    }

    public function show(int $taskId)
    {
        try {
            // Get a specific task by ID
            $task = $this->taskService->getTaskById($taskId);

            if (!$task) {
                // Task not found
                return abort(404, 'Task not found');
            }

            // Map the retrieved data to a view model (if needed)
            // For example:
            // $model = new RecurringTaskModel($task);

            // Return a view with the task details
            return view('tasks.show', ['task' => $task]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            // For example:
            // Log::error('Error fetching task details: ' . $e->getMessage());
            $this->logger->error('Error fetching task details: ' . $e->getMessage());

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function store(StoreRecurringTaskRequest $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new task from the request data
            $task = new RecurringTask([
                'title' => $request->input('title'),
                'short_description' => $request->input('short_description'),
                'long_description' => $request->input('long_description'),
                'frequency' => $request->input('frequency'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'created_by' => $request->input('created_by'),
            ]);

            // Add the task to the database
            $this->taskService->addTask($task);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('tasks.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error creating task: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function update(UpdateRecurringTaskRequest $request, int $taskId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific task by ID
            $task = $this->taskService->getTaskById($taskId);

            if (!$task) {
                // Task not found
                return abort(404, 'Task not found');
            }

            // Update task properties from the request data
            $task->title = $request->input('title');
            $task->short_description = $request->input('short_description');
            $task->long_description = $request->input('long_description');
            $task->frequency = $request->input('frequency');
            $task->start_date = $request->input('start_date');
            $task->end_date = $request->input('end_date');
            $task->created_by = $request->input('created_by');

            // Save the updated task
            $this->taskService->updateTask($task);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('tasks.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error updating task: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function destroy(int $taskId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific task by ID
            $task = $this->taskService->getTaskById($taskId);

            if (!$task) {
                // Task not found
                return abort(404, 'Task not found');
            }

            // Delete the task
            $this->taskService->deleteTask($task);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('tasks.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error deleting task: ' . $e->getMessage());

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
