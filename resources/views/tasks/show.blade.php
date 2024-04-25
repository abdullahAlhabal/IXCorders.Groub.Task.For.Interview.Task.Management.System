<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Task Details') }}

      </h2>

    </x-slot>


    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="row">

          <div class="col">

            <div class="card">

              <div class="card-body">

                <h5 class="card-title">{{ $task->title }}</h5>

                <p class="card-text">{{ $task->short_description }}</p>

                <ul class="list-group list-group-flush">

                  <li class="list-group-item">Due Date: {{ $task->due_date->format('Y-m-d') }}</li>

                  <li class="list-group-item">Priority: {{ $task->priority }}</li>

                  <li class="list-group-item">Status: {{ $task->status }}</li>

                  <li class="list-group-item">
                    Recurring: {{ $task->is_recurring() ? $task->recurring_pattern . ' (' . $task->recurring_interval . ')' : 'No' }}
                  </li>

                </ul>

              </div>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-6">

            <h3>Comments ({{ $task->comments->count() }})</h3>

            @forelse ($task->comments as $comment)

              <div class="card mb-3">

                <div class="card-body">

                  <p class="card-text">{{ $comment->content }}</p>

                  <small class="text-muted">Commented by: {{ $comment->user->name }} ({{ $comment->created_at->format('Y-m-d H:i') }})</small>

                  @if (Auth::user()->can('delete', $comment))
                    <form action="{{ route('tasks.comments.destroy', [$task->id, $comment->id]) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  @endif

                </div>

              </div>

            @empty

              <p>No comments found.</p>

            @endforelse

          </div>

          <div class="col-md-6">

            <h3>Attachments ({{ $task->attachments->count() }})</h3>

            @forelse ($task->attachments as $attachment)

              <div class="card mb-3">

                <div class="card-body">

                  <p class="card-text">
                    {{ $attachment->name }}
                    @if ($attachment->type === 'image')
                      <img src="{{ asset('storage/' . $attachment->path) }}" alt="{{ $attachment->name }}" class="img-thumbnail mt-2" width="100">
                    @endif
                  </p>

                </div>

              </div>

            @empty

              <p>No attachments found.</p>

            @endforelse

          </div>

        </div>

      </div>

    </div>

  </x-app-layout>
