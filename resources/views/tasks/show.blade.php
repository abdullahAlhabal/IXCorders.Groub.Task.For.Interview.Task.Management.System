@extends("layouts.layout")

@section("page_title", $task->title . " Task"  )
@section("title", $task->title)

@section("content")
        <nav class="mb-4">
            <a href="{{ route('tasks.index') }}" @class(['text-decoration-underline', 'text-dark'])>⬅️ go back to tasks list</a>
        </nav>

        <div class="card rounded-3">
          <div class="card-body p-4">
            <p class="mb-2"><span class="h2 me-2">{{ $task->title }}</span></p>

            @if ($task->long_description)
                <P>{{ $task->long_description }}</P>
            @else
                <P>{{ $task->description }}</P>
            @endif

            <p @class(['font-monospace', 'text-sm'])> Created {{ $task->created_at->diffForHumans() }} ✨ Updated {{ $task->updated_at->diffForHumans() }}</p>

            <p>
                @if($task->completed_at)
                    <span @class(['font-medium', 'text-success'])>Completed ✅</span>
                @else
                    <span @class(['font-medium', 'text-danger'])>Not Completed! ❌</span>
                @endif
            </p>

            <form action="{{ route('tasks.toggle', ["task" => $task->id]) }}" method="POST" @class(['d-flex', 'my-3'])>
                @method("PUT")
                @csrf
                <button class="btn @if($task->completed_at) btn-primary @else btn-danger @endif ">
                    Mark as {{ $task->completed_at ? "not completed" : "completed" }}
                </button>
            </form>

            <div @class(['d-flex', "gap-2"])>
                <div>
                    <a href="{{ route('tasks.edit', ["task"  => $task]) }}"
                        @class(['btn', 'btn-outline-success']) >Edit</a>
                </div>

                <form action="{{ route('tasks.destroy', ["task" => $task]) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" @class(['btn', 'btn-outline-danger'])>Delete</button>
                </form>
            </div>

          </div>
        </div>
@endsection
