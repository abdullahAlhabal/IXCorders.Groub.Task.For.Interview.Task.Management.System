<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Create Task') }}

      </h2>

    </x-slot>

    <div class="py-12">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create Task') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure to add valid Information') }}
                            </p>
                        </header>

                        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="update_password_password" :value="__('New Password')" />
                            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>





                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>



    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="row">

          <div class="col-md-8 mx-auto">

            <div class="card">

              <div class="card-header">

                Create New Task

              </div>

              <div class="card-body">

                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf

                  <div class="mb-3">

                    <label for="title" class="form-label">Title</label>

                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required >

                    @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="short_description" class="form-label">Short Description</label>

                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3">{{ old('short_description') }}</textarea>

                    @error('short_description')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="long_description" class="form-label">Long Description (Optional)</label>

                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="5">{{ old('long_description') }}</textarea>

                    @error('long_description')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="due_date" class="form-label">Due Date</label>

                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>

                    @error('due_date')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="priority" class="form-label">Priority</label>

                    <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>

                      <option value="">Select Priority</option>

                      <option value="low" @if(old('priority') === 'low') selected @endif>Low</option>

                      <option value="medium" @if(old('priority') === 'medium') selected @endif>Medium</option>

                      <option value="high" @if(old('priority') === 'high') selected @endif>High</option>

                    </select>

                    @error('priority')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="status" class="form-label">status</label>

                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    {{-- $table->enum('status', ['To Do', 'In Progress', 'Done']); --}}

                      <option value="">Select status</option>

                      <option value="To Do" @if(old('status') === 'To Do') selected @endif>To Do</option>

                      <option value="In Progress" @if(old('status') === 'In Progress') selected @endif>In Progress</option>

                      <option value="Done" @if(old('status') === 'Done') selected @endif>Done</option>

                    </select>

                    @error('status')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="is_recurring" name="is_recurring">
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

                    <select class="form-select @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to">
                        <option value="">Select User</option>
                            @forelse($users as $user)
                              <option value="{{ $user->id }}"
                                @if(old('assigned_to') == $user->id) selected @endif>
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

                    <select class="form-select @error('recurring_pattern') is-invalid @enderror" id="recurring_pattern" name="recurring_pattern" required>
                        {{-- $table->enum('recurring_pattern', ['daily', 'weekly', 'monthly'])->nullable(); --}}

                      <option value="">Select status</option>

                      <option value="daily" @if(old('recurring_pattern') === 'daily') selected @endif>daily</option>

                      <option value="weekly" @if(old('recurring_pattern') === 'weekly') selected @endif>weekly</option>

                      <option value="monthly" @if(old('recurring_pattern') === 'monthly') selected @endif>monthly</option>

                    </select>

                    @error('recurring_pattern')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="mb-3">

                    <label for="recurring_interval" class="form-label">Recurring Interval</label>

                    <input type="number" class="form-control @error('recurring_interval') is-invalid @enderror" id="recurring_interval" name="recurring_interval" value="{{ old('recurring_interval') }}" required >

                    @error('recurring_interval')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>


                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
