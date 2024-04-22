@extends("layouts.layout")

@section("page_title", "Task List")

@section("title", "Task List")

@section("content")
        <nav class="mb-4">
            <a href="{{ route('tasks.create') }}" @class(['text-decoration-under-line'])>Add task ➡️</a>
        </nav>

        <div class="card rounded-3">
          <div class="card-body p-4">
            @forelse($tasks as $task)
                <div @class(['list-group-item', 'border-0', 'd-flex', 'align-items-center', 'ps-0'])>
                    <span class="mx-2">{{ $task->completed_at ? ' ✅ ' : ' ❌ ' }}</span>
                    <span @class(['font-bold', 'text-decoration-line-through' => $task->completed_at])>
                         <a href="{{ route('tasks.show',["task" => $task->id]) }}"
                            class="text-decoration-none text-dark">{{ $task->title }}</a>
                    </span>
                </div>
            @empty
                <p>There are no tasks!</p>
            @endforelse
          </div>
        </div>

        @if($tasks->count())
            <div class="d-flex justify-content-center align-items-center sm my-5">
                {!! $tasks->links()  !!}
            </div>
        @endif

@endsection
