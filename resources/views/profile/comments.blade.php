<x-app-layout>

    <x-slot name="header">
  
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
  
        {{ __('Comments') }}
  
      </h2>
  
    </x-slot>
  
  
    <div class="py-12">
  
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
  
  
        @forelse ($comments as $comment)
  
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
  
            <div class="col">
  
              <div class="bg-white shadow-md rounded overflow-hidden">  <div class="px-4 py-5 sm:p-6">  <p class="text-gray-700 text-base">{{ $comment->comment }}</p>
  
                  <div class="flex justify-between mt-4">  @if ($comment->task)
  
                      <a href="{{ route('tasks.show', $comment->task->id) }}" class="px-3 py-1.5 text-center text-white bg-green-500 hover:bg-green-700 rounded-md"> View Task </a>
  
                    @endif
  
                    <a href="{{ route('profile.show', $comment->author->id) }}" class="px-3 py-1.5 text-center text-white bg-blue-500 hover:bg-blue-700 rounded-md"> Author Profile </a>
  
                  </div>
  
                </div>
  
              </div>
  
            </div>
  
          </div>
        @empty
  
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="p-6 text-gray-900 dark:text-gray-100">
                          {{ __("No comments found.") }}
                      </div>
                  </div>
              </div>
          </div>
          @endforelse
          
          @if ($comments->count() > 0)
          
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="p-6 text-gray-900 dark:text-gray-100">
                          <div class="d-flex justify-content-center mt-4">
                            {{ $comments->links() }}
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          
          @endif
  
      </div>
  
    </div>
  
  </x-app-layout>
  