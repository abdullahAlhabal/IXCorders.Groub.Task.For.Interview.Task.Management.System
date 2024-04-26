<x-app-layout>

    <x-slot name="header">
  
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
  
        {{ __('Attachments') }}
  
      </h2>
  
    </x-slot>
  
  
    <div class="py-12">
  
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
  
  
        @forelse ($attachments as $attachment)
  
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"> 
              <div class="col">
  
                <img src="{{ asset('storage/' . $attachment->attachment_path) }}" alt="{{ $attachment->name }}" class="rounded-lg shadow-md">  <div class="flex justify-between mt-2">  <a href="{{ route('profile.show', $attachment->uploader->id) }}" class="btn btn-primary btn-sm px-3 py-1.5 text-center text-white bg-blue-500 hover:bg-blue-700 rounded-md"> Uploader Profile </a>  @if ($attachment->task)
  
                <a href="{{ route('tasks.show', $attachment->task->id) }}" class="btn btn-success btn-sm px-3 py-1.5 text-center text-white bg-green-500 hover:bg-green-700 rounded-md"> View Task </a>   @endif
  
              </div>
  
            </div>
  
          </div>
  
          @empty
  
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="p-6 text-gray-900 dark:text-gray-100">
                          {{ __("No attachments found.") }}
                      </div>
                  </div>
              </div>
          </div>
          @endforelse
          
          @if ($attachments->count() > 0)
          
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="p-6 text-gray-900 dark:text-gray-100">
                          <div class="d-flex justify-content-center mt-4">
                              {{ $attachments->links() }}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
          @endif
  
  
      </div>
  
    </div>
  
  </x-app-layout>
  