<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Update Task') }}

      </h2>

    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-900 dark:text-gray-100">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Task') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure to add valid Information') }}
                            </p>
                        </header>

                        <form action="{{ route('tasks.update', ["task"  => $task->id]) }}" method="POST"  class="mt-6 space-y-6">
                        @csrf
                        @method("PUT")

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title" value="{{ $task->title }}" required/>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="short_description" :value="__('Short Description')" />
                            <textarea class="form-control @error('short_description') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm " id="short_description" name="short_description" rows="3">{{ $task->short_description }}</textarea>
                            @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="long_description" :value="__('Long Description  (Optional)')" />
                            <textarea class="form-control @error('long_description') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm " id="long_description" name="long_description" rows="3">{{ $task->long_description }}</textarea>
                            @error('long_description')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                          <div class="mb-3">

                            <label for="due_date" class="form-label">Due Date</label>

                            <input type="date" class="form-control @error('due_date') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="due_date" name="due_date" value="{{ $task->due_date }}" required>

                            @error('due_date')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <div class="mb-3">

                            <label for="priority" class="form-label">Priority</label>

                            <select class="form-select @error('priority') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="priority" name="priority" required>

                              <option value="">Select Priority</option>

                              <option value="low" @if( $task->priority === 'low') selected @endif>Low</option>

                              <option value="medium" @if( $task->priority === 'medium') selected @endif>Medium</option>

                              <option value="high" @if( $task->priority === 'high') selected @endif>High</option>

                            </select>

                            @error('priority')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <div class="mb-3">

                            <label for="status" class="form-label">status</label>

                            <select class="form-select @error('status') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="status" name="status" required>
                            {{-- $table->enum('status', ['To Do', 'In Progress', 'Done']); --}}

                              <option value="">Select status</option>

                              <option value="To Do" @if($task->status === 'To Do') selected @endif>To Do</option>

                              <option value="In Progress" @if($task->status === 'In Progress') selected @endif>In Progress</option>

                              <option value="Done" @if($task->status === 'Done') selected @endif>Done</option>

                            </select>

                            @error('status')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <div class="mb-3 form-check">
                            <input class="form-check-input border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="checkbox" value="1" id="is_recurring" name="is_recurring">
                            <label class="form-check-label" for="is_recurring">
                              Is Recurring?
                            </label>
                            @error('is_recurring')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>

                          <div class="mb-3">

                            <label for="assigned_to" class="form-label">Assigned To</label>

                            <select class="form-select @error('assigned_to') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="assigned_to" name="assigned_to">
                                <option value="">Select User</option>
                                    @forelse($users as $user)
                                      <option value="{{ $user->id }}"
                                        @if($task->assigned_to == $user->id) selected @endif>
                                        {{ $user->name }}
                                      </option>
                                    @empty
                                    <option value="">no users found</option>
                                    @endforelse
                            </select>
                            @error('assigned_to')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <div class="mb-3">

                            <label for="recurring_pattern" class="form-label">Recurring pattern</label>

                            <select class="form-select @error('recurring_pattern') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="recurring_pattern" name="recurring_pattern" required>
                                {{-- $table->enum('recurring_pattern', ['daily', 'weekly', 'monthly'])->nullable(); --}}

                              <option value="">Select status</option>

                              <option value="daily" @if($task->recurring_pattern === 'daily') selected @endif>daily</option>

                              <option value="weekly" @if($task->recurring_pattern === 'weekly') selected @endif>weekly</option>

                              <option value="monthly" @if($task->recurring_pattern === 'monthly') selected @endif>monthly</option>

                            </select>

                            @error('recurring_pattern')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <div class="mb-3">

                            <label for="recurring_interval" class="form-label">Recurring Interval</label>

                            <input type="number" class="form-control @error('recurring_interval') is-invalid @enderror border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="recurring_interval" name="recurring_interval" value="{{ $task->recurring_interval }}" required >

                            @error('recurring_interval')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                          </div>

                          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none">Update Task</button>
                          <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none">Cancle</a>


                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
