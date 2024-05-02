<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Add Comment') }}

      </h2>

    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-900 dark:text-gray-100">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add Comment') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure to add valid Information') }}
                            </p>
                        </header>

                        <form action="{{ route('tasks.comments.store', ["taskId" => $taskId]) }}" method="POST" class="mt-6 space-y-6">
                        @csrf

                        <input type="hidden" name="task_id" value="{{ $taskId }}">

                        <div>
                            <x-input-label for="comment" :value="__('Comment')" />
                            <x-text-input id="comment" name="comment" type="text" class="mt-1 block w-full" autocomplete="comment" value="{{ old('comment') }}" required/>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none">Create Task</button>
                          <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none">Cancle</a>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
