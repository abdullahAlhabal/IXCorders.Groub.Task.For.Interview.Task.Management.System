@section("page_title" , isset($task) ? "Edit " . $task->title :"Create New Task")
@section("title" , isset($task) ? "Edit : " . $task->title :"Create New Task")

<form action="{{ isset($task) ? route("tasks.update", ["task"  => $task->id]) : route("tasks.store") }}" method="post">
    @csrf

    @isset($task)
        @method("PUT")
    @else
        @method("POST")
    @endisset

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" @class(['form-control', 'border-danger' => $errors->has('title')]) id="title" aria-describedby="titleHelp" value="{{ $task->title ?? old("title")}}">
        @error("title")
            <p id="titleHelp" @class(['text-danger', 'h6'])>{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" @class(['form-control', 'border-danger' => $errors->has('description')]) id="description" value="{{ $task->description ?? old("description") }}">
        @error("description")
            <p id="titleHelp" @class(['text-danger', 'h6'])>{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="longDescription" class="form-label">Long Description</label>
        <textarea name="longDescription" @class(['form-control', 'border-danger' => $errors->has('longDescription')]) id="longDescription" rows="3">{{ $task->long_description ?? old("long_description") }}</textarea>
        @error("longDescription")
            <p id="titleHelp" @class(['text-danger', 'h6'])>{{ $message }}</p>
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
