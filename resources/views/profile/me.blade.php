<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-900 dark:text-gray-100">

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="row">
                                <div class="col-md-4 w-full md:w-1/3 px-4 mb-6">
                                    <div class="card">
                                        <div class="rounded-lg shadow-md overflow-hidden">
                                            @if($user->profile_picture)
                                                <img src="{{ $user->profile_picture }}" class="card-img-top img-fluid w-full h-48 object-cover" alt="Profile Picture">
                                            @else
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __("No profile Picture")}}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-xl font-bold">{{ $user->name }}</h5>
                                            <p class="card-text">
                                                <span class="font-medium">Email:</span> {{ $user->email }}<br>
                                                <span class="font-medium">Name:</span> {{ $user->first_name ?? "N/A" }} {{ $user->last_name ?? "N/A" }}<br>
                                                <span class="font-medium">Birthday:</span> {{ $user->birth_date ? $user->birth_date->diffForHumans() : "N/A" }}<br>
                                                <span class="font-medium">Gender:</span> {{ $user->gender ?? "N/A" }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <div id="tasks">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Tasks') }}
                                <p class="mt-2 text-gray-600"> Created : {{ $user->createdTasks->count() }} • Assigned : {{ $user->assignedTasks->count() }}</p>
                            </h2>
                            @forelse($tasks as $task)
                                <ul class="list-group">
                                    @foreach ($tasks as $task)
                                        <div class="py-12">
                                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                                        <li class="list-group-item">
                                                            <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            @empty
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 text-gray-900 dark:text-gray-100">
                                            {{ __("No Tasks found.") }}
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
                        <div id="comments">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Comments') }}
                                <p class="mt-2 text-gray-600"> No : {{ $user->comments->count() }}</p>
                            </h2>
                            @forelse($userComments as $comment)
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
                            @if ($userComments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                                    <div class="flex justify-center mt-4">
                                                        {{ $userComments->links() }}
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
                                <p class="mt-2 text-gray-600"> No : {{ $user->attachments->count() }}</p>
                            </h2>
                            @forelse($userAttachments as $attachment)
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
                            @if ($userAttachments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                                    <div class="flex justify-center mt-4">
                                                        {{ $userAttachments->links() }}
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
    </x-app-layout>
