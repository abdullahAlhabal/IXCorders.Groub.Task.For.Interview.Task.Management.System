<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;
      /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
      // Allow all users to view tasks (adjust as needed)
      return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
      // Allow viewing own tasks or assigned tasks
      return $user->id === $task->created_by || $user->id === $task->assigned_to;
    }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user): bool
    // {
    //   return true;
    // }

    /**
     * Determine whether the user can assign to the target user.
     */
    public function assign(User $user, Task $task): bool
    {
      // Allow assigning only if the user created the task
      return $user->id === $task->created_by;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
      // Allow updating own tasks or tasks assigned to the user
      return $user->id === $task->created_by;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
      // Allow deleting only the user's own tasks
      return $user->id === $task->created_by;
    }

    // ... other methods (approve, reject, restore, forceDelete)

    // /**
    //  * Determine whether the user can approve the model.
    //  */
    // public function approve(User $user, Task $task): bool
    // {
    //   // ... (implement your approval logic)
    // }

    // /**
    //  * Determine whether the user can reject the model.
    //  */
    // public function reject(User $user, Task $task): bool
    // {
    //   // ... (implement your rejection logic)
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Task $task): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Task $task): bool
    // {
    //     //
    // }
}
