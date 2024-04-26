<x-app-layout>

    <x-slot name="header" class="bg-gray-100 dark:bg-gray-900">

      <h2 class="font-semibold text-xl leading-tight text-gray-900 dark:text-gray-100">

        {{ __('Tasks') }}

      </h2>

    </x-slot>


    <div class="py-12 text-gray-900 dark:text-gray-100">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @forelse ($tasks as $task)
              <div class="py-12">
                  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
    
                      <div class="col">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <p class="card-text">{{ $task->short_description }}</p>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">Due Date: {{ $task->due_date }}</li>
                              <li class="list-group-item">Priority: {{ $task->priority }}</li>
                              <li class="list-group-item">Status: {{ $task->status }}</li>
                              <li class="list-group-item">
                                Recurring: {{ $task->isRecurring() ? $task->recurring_pattern . ' (' . $task->recurring_interval . ')' : 'No' }}
                              </li>
                              <li class="list-group-item">
                                Comments: {{ $task->comments->count() }}
                              </li>
                              <li class="list-group-item">
                                Attachments: {{ $task->attachments->count() }}
                              </li>
                            </ul>
                            <div class="d-flex justify-content-between mt-2">
                              @if ($task->created_by === $task->assigned_to)
                                <a href="{{ route('profile.show', $task->creator->id) }}" class="btn btn-primary btn-sm">Creator Profile</a>
                              @else
                                <a href="{{ route('profile.show', $task->creator->id) }}" class="btn btn-primary btn-sm">Creator Profile</a>
                                <a href="{{ route('profile.show', $task->assignee->id) }}" class="btn btn-success btn-sm">Assignee Profile</a>
                              @endif
                              <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-warning btn-sm">Show Task</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

        @empty

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("No tasks found.") }}
                    </div>
                </div>
            </div>
        </div>

        @endforelse


        @if ($tasks->count() > 0)
          <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
          </div>
        @endif


      </div>

    </div>

  </x-app-layout>
