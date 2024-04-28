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
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h5 class="text-xl font-semibold">{{ $task->title }}</h5>
                            <p class="mt-2 text-gray-600">{{ $task->short_description }}</p>
                            <div class="flex justify-between mt-4">
                              <div>
                                <p class="text-sm text-gray-500">
                                  Due Date: {{ $task->due_date }} • Priority: {{ $task->priority }} • Status: {{ $task->status }}
                                </p>
                                <p class="text-sm text-gray-500">
                                  Recurring: {{ $task->isRecurring() ? $task->recurring_pattern . ' (' . $task->recurring_interval . ')' : 'No' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                  Comments : {{ $task->comments->count() }}
                                </p>
                                </p>
                                <p class="text-sm text-gray-500">
                                  Attachments: {{   $task->attachments->count() }}
                                </p>
                              </div>
                              <div class="space-x-2">
                                @if ($task->created_by === $task->assigned_to)
                                  <a href="{{ route('profile.show', $task->creator->id) }}" class="px-3 py-1 text-white bg-blue-500 rounded-sm hover:bg-blue-700">Creator Profile</a>
                                @else
                                  <a href="{{ route('profile.show', $task->creator->id) }}" class="px-3 py-1 text-white bg-blue-500 rounded-sm hover:bg-blue-700">Creator Profile</a>
                                  <a href="{{ route('profile.show', $task->assignee->id) }}" class="px-3 py-1 text-white bg-green-500 rounded-sm hover:bg-green-700">Assignee Profile</a>
                                @endif
                                <a href="{{ route('tasks.show', $task->id) }}" class="px-3 py-1 text-white bg-yellow-500 rounded-sm hover:bg-yellow-700">Show Task</a>
                              </div>
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
              <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                      <div class="flex justify-center mt-4">
                          {{ $tasks->links() }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          @endif
        </div>
      </div>

  </x-app-layout>
