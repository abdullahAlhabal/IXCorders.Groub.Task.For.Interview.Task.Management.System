<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $user->profile_picture }}" class="card-img-top img-fluid" alt="Profile Picture">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">
                                Email: {{ $user->email }}<br>
                                Name: {{ $user->first_name }} {{ $user->last_name }}<br>
                                Birthday: {{ $user->birth_date->diffForHumans() }}<br>
                                Gender: {{ $user->gender }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion" id="profileAccordions">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="tasksAccordion">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTasks" aria-expanded="false" aria-controls="collapseTasks">
                                    Tasks
                                </button>
                            </h2>
                            <div id="collapseTasks" class="accordion-collapse collapse" aria-labelledby="tasksAccordion" data-bs-parent="#profileAccordions">
                                <div class="accordion-body">
                                    @if ($tasks->count() > 0)
                                        <ul class="list-group">
                                            @foreach ($tasks as $task)
                                                <li class="list-group-item">
                                                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No tasks found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="commentsAccordion">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                                    Comments
                                </button>
                            </h2>
                            <div id="collapseComments" class="accordion-collapse collapse" aria-labelledby="commentsAccordion" data-bs-parent="#profileAccordions">
                                <div class="accordion-body">
                                    @if ($userComments->count() > 0)
                                        @foreach ($userComments as $comment)
                                            <p>{{ $comment->content }}</p>
                                        @endforeach
                                    @else
                                        <p>No comments found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="attachmentsAccordion">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAttachments" aria-expanded="false" aria-controls="collapseAttachments">
                                    Comments
                                </button>
                            </h2>
                            <div id="collapseAttachments" class="accordion-collapse collapse" aria-labelledby="attachmentsAccordion" data-bs-parent="#profileAccordions">
                                <div class="accordion-body">
                                    @forelse ($userAttachments as $comment)
                                        <p>{{ $comment->content }}</p>
                                    @empty
                                        <p>No comments found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
