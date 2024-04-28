<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-900 dark:text-gray-100">
            
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ $user->profile_picture }}" class="card-img-top img-fluid" alt="Profile Picture">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $user->name }}</h5>
                                            <p class="card-text">
                                                Email: {{ $user->email }}<br>
                                                Name: {{ $user->first_name ?? "N/A" }} {{ $user->last_name ?? "N/A" }}<br>
                                                Birthday: {{ $user->birth_date ? $user->birth_date->diffForHumans() : "N/A" }}<br>
                                                Gender: {{ $user->gender ?? "N/A" }}
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
