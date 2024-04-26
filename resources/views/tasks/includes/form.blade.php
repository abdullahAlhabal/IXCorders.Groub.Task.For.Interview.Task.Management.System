<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

      @isset($task) {{ __('Update Task') }} @else {{ __('Create Task') }} @endisset

    </h2>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

          <div class="row">

            <div class="col-md-8 mx-auto">

              <div class="card">

                <div class="card-header">

                  Create New Task

                </div>

                <div class="card-body">

                  <form action="{{ isset($task) ? route('tasks.update', ["task" => $task->id]) : route("tasks.store")  }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @isset($task)
                        @method("PUT")
                    @else
                        @method("POST")
                    @endisset

                    <div class="mb-3">

                      <label for="title" class="form-label">Title</label>

                      <input type="text" @class(['form-control', 'border-danger' => $errors->has('title'), 'is-invalid' => $errors->has('title')]) id="title" name="title" value="{{ $task->title ?? old("title") }}" required autofocus>

                      @error('title')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="short_description" class="form-label">Short Description</label>

                      <textarea @class(['form-control', 'border-danger' => $errors->has('short_description'), 'is-invalid' => $errors->has('short_description')]) id="short_description" name="short_description" rows="3">{{ $task->short_description ?? old("short_description") }}</textarea>

                      @error('short_description')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="long_description" class="form-label">Long Description (Optional)</label>

                      <textarea @class(['form-control', 'border-danger' => $errors->has('long_description'), 'is-invalid' => $errors->has('long_description')]) id="long_description" name="long_description" rows="5">{{ $task->long_description ?? old("long_description") }}</textarea>

                      @error('long_description')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="due_date" class="form-label">Due Date</label>

                      <input type="date" @class(['form-control', 'border-danger' => $errors->has('due_date'), 'is-invalid' => $errors->has('due_date')]) id="due_date" name="due_date" value="{{ $task->due_date ?? old("due_date") }}" required>

                      @error('due_date')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="priority" class="form-label">Priority</label>

                      <select @class(['form-control', 'border-danger' => $errors->has('priority'), 'is-invalid' => $errors->has('priority')]) id="priority" name="priority" required>

                        <option value="">Select Priority</option>

                        <option value="low" @if($task->priority ?? old("priority") === 'low') selected @endif>Low</option>

                        <option value="medium" @if($task->priority ?? old("priority") === 'medium') selected @endif>Medium</option>

                        <option value="high" @if($task->priority ?? old("priority") === 'high') selected @endif>High</option>

                      </select>

                      @error('priority')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="status" class="form-label">status</label>

                      <select @class(['form-control', 'border-danger' => $errors->has('status'), 'is-invalid' => $errors->has('status')]) id="status" name="status" required>

                        <option value="">Select status</option>

                        <option value="To Do" @if($task->status ?? old("status") === 'To Do') selected @endif>To Do</option>

                        <option value="In Progress" @if($task->status ?? old("status") === 'In Progress') selected @endif>In Progress</option>

                        <option value="Done" @if($task->status ?? old("status") === 'Done') selected @endif>Done</option>

                      </select>

                      @error('status')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3 form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="is_recurring" name="is_recurring" {{ $task->is_recurring ?? old("is_recurring") ? 'checked' : '' }}>
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

                      <select @class(['form-control', 'border-danger' => $errors->has('assigned_to'), 'is-invalid' => $errors->has('assigned_to')]) id="assigned_to" name="assigned_to">
                          <option value="">Select User</option>
                              @forelse($users as $user)
                                <option value="{{ $user->id }}"
                                  @if($task->assigned_to ?? old('assigned_to') == $user->id) selected @endif>
                                  {{ $user->name }}
                                </option>
                              @empty
                              <option value="">no users found</option>
                              @endforeach
                      </select>
                      @error('assigned_to')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="recurring_pattern" class="form-label">Recurring pattern</label>

                      <select @class(['form-control', 'border-danger' => $errors->has('recurring_pattern'), 'is-invalid' => $errors->has('recurring_pattern')]) id="recurring_pattern" name="recurring_pattern" required>

                        <option value="">Select status</option>

                        <option value="daily" @if( $task->recurring_pattern ?? old("recurring_pattern") === 'daily') selected @endif>daily</option>

                        <option value="weekly" @if( $task->recurring_pattern ?? old("recurring_pattern") === 'weekly') selected @endif>weekly</option>

                        <option value="monthly" @if( $task->recurring_pattern ?? old("recurring_pattern") === 'monthly') selected @endif>monthly</option>

                      </select>

                      @error('recurring_pattern')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="mb-3">

                      <label for="recurring_interval" class="form-label">Recurring Interval</label>

                      <input type="number" @class(['form-control', 'border-danger' => $errors->has('recurring_interval'), 'is-invalid' => $errors->has('recurring_interval')]) id="recurring_interval" name="recurring_interval" value="{{ $task->recurring_interval }}" required autofocus>

                      @error('recurring_interval')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <button type="submit" @class(['btn', "btn-primary"])>
                        @isset($task)
                        Save Changes
                        @else
                        Add Task
                        @endisset
                    </button>

                    <a href="{{ route('tasks.index') }}" @class(['btn', "btn-secondary"])>Cancle</a>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-slot>
