<?php

namespace App\Http\Controllers;

use App\Contracts\Task\TaskServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Models\Task;
use App\Http\Requests\Web\Task\CreateTaskRequest;
use App\Http\Requests\Web\Task\UpdateTaskRequest;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Members
    private TaskServiceInterface $taskService;
    private UserServiceInterface $userService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(TaskServiceInterface $taskService, UserServiceInterface $userService, Logger $logger)
    {
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->logger = $logger;
    }
    // End Constructor

    // Methods

    public function index(Request $request)
    {
        try {
            $perPage = $request->query('perPage', 10);

            // more readably
            // $searchTerm = $request->query('search') ;
            // if(empty($searchTerm)){
            //     $searchTerm = "";
            // }

            // save a line of code
            $searchTerm = empty($request->query('search')) ? "" : $request->query('search') ;

            $tasks = $this->taskService->searchTasksScout($searchTerm, $perPage);

            return view('tasks.index', compact('tasks'));

        } catch (\Exception $e) {

            $this->logger->error('Error fetching tasks: ' . $e->getMessage());

            session()->flash('error', 'Error fetching tasks: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching tasks']);
            // abort(500, 'Error fetching tasks');
        }
    }

    public function show(Task $task)
    {
        try {

            $task->load(["creator","assignee","comments","attachments"]);

            return view('tasks.show', [
                "task"  => $task
            ]);

        } catch (\Exception $e) {
            $this->logger->error('Error fetching task details: ' . $e->getMessage());

            abort(500, 'Error fetching task');
        }
    }

    public function create()
    {
        try {
            $users = $this->userService->getAllUsers();

            return view('tasks.create', compact('users'));

        } catch (\Exception $e) {

            $this->logger->error('Error fetching users for task creation: ' . $e->getMessage());
            session()->flash('error', 'Error fetching users for task creation.');
            return abort(500, 'Error fetching users');
        }
    }

    public function store(CreateTaskRequest $request)
    {
      try {
        DB::beginTransaction();

        $task = $this->createTaskFromRequest($request);

        $this->taskService->addTask($task);

        if ($this->shouldNotifyUser($task)) {
            $this->notifyUser($task);
        }

        session()->flash('success', 'Task created successfully!');

        DB::commit();

        return redirect()->route('tasks.index');
      } catch (\Exception $e) {
        $this->logger->error('Error creating task: ' . $e->getMessage());
        DB::rollBack();
        abort(500, 'Error creating task');
      }
    }

    // TODO : For Further features, then we will have a button to assign exsisting tasks

    // public function assign(AssignTaskRequest $request, int $taskId)
    // {
    //   try {
    //     DB::beginTransaction();
    //    $task = $this->fetchAuthorizedTask($taskId);
    //     if (! Gate::allows('assign', $task)) {
    //         abort(403, 'Unauthorized');
    //     }
    //     $task->assigned_to = $request->input('assigned_to');
    //     $this->taskService->saveTask($task);
    //     $user = $this->userService->getUserById($request->input('assigned_to'));
    //     $user->notify(new TaskAssignedNotification($task));
    //     DB::commit();
    //     session()->flash('success', 'Task assigned successfully!');
    //     return redirect()->route('tasks.index');
    //   } catch (\Exception $e) {
    //     $this->logger->error('Error assigning task: ' . $e->getMessage());
    //     DB::rollBack();
    //     abort(500, 'Error assigning task');
    //   }
    // }

    public function edit(Task $task)
    {
        try {

            if (! Gate::allows('update', $task)) {
                abort(403, 'Unauthorized to update this task.');
            }

            $users = $this->userService->getAllUsers();

            return view('tasks.edit', compact('task', 'users'));

        } catch (\Exception $e) {
            $this->logger->error('Error fetching task for editing: ' . $e->getMessage());

            session()->flash('error', 'Error fetching task for editing.');

            return abort(500, 'Error fetching task');
        }
    }
    public function update(UpdateTaskRequest $request, int $taskId)
    {
        try {
            DB::beginTransaction();

            $task = $this->fetchAuthorizedTask($taskId);

            if (! Gate::allows('update', $task)) {
                abort(403, 'Unauthorized to update this task.');
            }

            $this->updateTaskFromRequest($task, $request);

            $this->taskService->updateTask($task);

            DB::commit();

            session()->flash('success', 'Task updated successfully!');

            return redirect()->route('tasks.index');

        } catch (\Exception $e) {
            $this->logger->error('Error updating task: ' . $e->getMessage());

            DB::rollBack();

            abort(500, 'Error updating task');
        }
    }
    public function destroy(int $taskId)
    {
        try {
            DB::beginTransaction();

            $task = $this->fetchAuthorizedTask($taskId);

            if (! Gate::allows('delete', $task)) {
                abort(403, 'Unauthorized');
            }

            $this->taskService->deleteTask($task);

            DB::commit();

            session()->flash('success', 'Task deleted successfully!');

            return redirect()->route('tasks.index');

        } catch (\Exception $e) {
            $this->logger->error('Error deleting task: ' . $e->getMessage());

            DB::rollBack();

            abort(500, 'Error deleting task');
        }
    }

    // End Methods

    // Helpers
    private function createTaskFromRequest(CreateTaskRequest $request): Task
    {
        return new Task([
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'due_date' => $request->input('due_date'),
            'priority' => $request->input('priority'),
            'status_id' => $request->input('status_id'),
            'status' => $request->input('status'),
            'created_by' => Auth::id(),
            'assigned_to' => $request->input('assigned_to') ?? Auth::id(),
            'is_recurring' => $request->input('is_recurring'),
            "recurring_pattern" => $request->input("recurring_pattern"),
            "recurring_interval" => $request->input("recurring_interval")
          ]);
    }
    private function shouldNotifyUser(Task $task): bool
    {
        return $task->created_by !== $task->assigned_to;
    }
    private function notifyUser(Task $task)
    {
        $assignedUser = $this->userService->getUserById($task->assigned_to);
        $assignedUser->notify(new TaskAssignedNotification($task));
    }
    private function fetchAuthorizedTask(int $taskId): Task
    {
        if (is_null($taskId)) {
            abort(400, 'Invalid task ID');
        }

        $task = $this->taskService->getTaskById($taskId);

        if (!$task) {
            return abort(404, 'Task not found');
        }

        return $task;
    }

    private function updateTaskFromRequest(Task &$task, UpdateTaskRequest $request): void
    {
        $task->title = $request->input("title");
        $task->short_description = $request->input("short_description");
        $task->long_description = $request->input("long_description");
        $task->due_date = $request->input("due_date");
        $task->priority = $request->input("priority");
        $task->status_id = $request->input("status_id");
        $task->status = $request->input("status");
        $task->created_by = Auth::id();
        $task->assigned_to = $request->input("assigned_to") ?? Auth::id() ;
        $task->is_recurring = $request->input("is_recurring");
        $task->recurring_pattern = $request->input("recurring_pattern");
        $task->recurring_interval = $request->input("recurring_interval");
    }


    // End Helpers
}
