<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Attachments') }}

      </h2>

    </x-slot>


    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


        @forelse ($attachments as $attachment)

          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            <div class="col">

              <img src="{{ asset('storage/' . $attachment->attachment_path) }}" alt="{{ $attachment->name }}" class="img-thumbnail">

              <div class="d-flex justify-content-between mt-2">

                <a href="{{ route('profile.show', $attachment->uploader->id) }}" class="btn btn-primary btn-sm">Uploader Profile</a>

                @if ($attachment->task)

                  <a href="{{ route('tasks.show', $attachment->task->id) }}" class="btn btn-success btn-sm">View Task</a>

                @endif

              </div>

            </div>

          </div>

        @empty

          <p>No attachments found.</p>

        @endforelse

        @if ($attachments->count() > 0)

          <div class="d-flex justify-content-center mt-4">
            {{ $attachments->links() }}
          </div>

        @endif


      </div>

    </div>

  </x-app-layout>
