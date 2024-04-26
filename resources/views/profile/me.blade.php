<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-900 dark:text-gray-100">
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
            <div class="row">
                <div class="col-md-12">
                    <ul class="flex border-b border-gray-200 dark:border-gray-700">
                        <li class="mr-2">
                            <a href="#tasks" class="inline-block px-4 py-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">Tasks</a>
                        </li>
                        <li class="mr-2">
                            <a href="#comments" class="inline-block px-4 py-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">Comments</a>
                        </li>
                        <li class="mr-2">
                            <a href="#attachments" class="inline-block px-4 py-2 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">Attachments</a>
                        </li>
                    </ul>
                    <div class="mt-4">
                        <div id="tasks" class="tab-content">
                            @forelse($tasks as $task)
                                <ul class="list-group">
                                    @foreach ($tasks as $task)
                                        <li class="list-group-item">
                                            <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @empty
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                {{ __("No tasks found.") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            @if ($tasks->count() > 0)
                                <div class="flex justify-center mt-4">
                                    {{ $tasks->links() }}
                                </div>
                            @endif
                        </div>
                        <div id="comments" class="tab-content hidden">
                            @forelse($userComments as $comment)
                                <p>{{ $comment->content }}</p>
                            @empty
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                {{ __("No tasks found.") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            @if ($userComments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    {{ $userComments->links() }}
                                </div>
                            @endif
                        </div>
                        <div id="attachments" class="tab-content hidden">
                            @forelse($userAttachments as $attachments)
                                <p>{{ $attachments->content }}</p>
                            @empty
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                                {{ __("No tasks found.") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                            @if ($userAttachments->count() > 0)
                                <div class="flex justify-center mt-4">
                                    {{ $userAttachments->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
