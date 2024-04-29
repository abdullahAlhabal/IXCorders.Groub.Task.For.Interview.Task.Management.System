<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Task Details') }}

      </h2>

    </x-slot>


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
                          </div>
                        </div>
                        <div class="space-x-2">
                          @if ($task->created_by === $task->assigned_to)
                            <a href="{{ route('profile.show', $task->creator->id) }}" class="px-3 py-1 text-white bg-blue-500 rounded-sm hover:bg-blue-700">Creator Profile</a>
                          @else
                            <a href="{{ route('profile.show', $task->creator->id) }}" class="px-3 py-1 text-white bg-blue-500 rounded-sm hover:bg-blue-700">Creator Profile</a>
                            <a href="{{ route('profile.show', $task->assignee->id) }}" class="px-3 py-1 text-white bg-green-500 rounded-sm hover:bg-green-700">Assignee Profile</a>
                          @endif
                        </div>
                        <div class="space-x-2 block">
                          @can('update', $task)
                              <a href="{{ route('tasks.edit', ["task" => $task]) }}" class="px-3 py-1 text-white bg-blue-500 rounded-sm hover:bg-blue-700">Edit Task</a>
                          @endcan
                          @can('delete', $task)
                              <form method="POST" action="{{ route('tasks.destroy', ["task" => $task]) }}">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded-sm hover:bg-red-700">Delete Task</button>
                              </form>
                          @endcan
                        </div>
                      </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <div id="comments">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Comments') }}
                                <p class="mt-2 text-gray-600"> No : ({{ $task->comments->count() }})</p>
                            </h2>
                            @forelse($task->comments as $comment)
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                <p>No comments found.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            @if ($task->comments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                                    <div class="flex justify-center mt-4">
                                                        {{ $$task->comments->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div id="attachments">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Attachments') }}
                                <p class="mt-2 text-gray-600"> No : {{ $task->attachments->count() }}</p>
                            </h2>
                            @forelse($task->attachments as $attachment)
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                <img src="{{ asset('storage/' . $attachment->attachment_path) }}" alt="attachment" class="rounded-lg shadow-md">  <div class="flex justify-between mt-2">  <a href="{{ route('profile.show', $attachment->uploader->id) }}" class="btn btn-primary btn-sm px-3 py-1.5 text-center text-white bg-blue-500 hover:bg-blue-700 rounded-md"> Uploader Profile </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                <p>No Attachments found.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            @if ($task->attachments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                                    <div class="flex justify-center mt-4">
                                                        {{ $task->attachments->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>



      </div>

    </div>

  </x-app-layout>
