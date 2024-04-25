<x-app-layout>

    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        {{ __('Comments') }}

      </h2>

    </x-slot>


    <div class="py-12">

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


        @forelse ($comments as $comment)

          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            <div class="col">

              <div class="card">

                <div class="card-body">

                  <p class="card-text">{{ $comment->comment }}</p>

                  <div class="d-flex justify-content-between mt-2">

                    @if ($comment->task)

                      <a href="{{ route('tasks.show', $comment->task->id) }}" class="btn btn-success btn-sm">View Task</a>

                    @endif

                    <a href="{{ route('profile.show', $comment->author->id) }}" class="btn btn-primary btn-sm">Author Profile</a>

                  </div>

                </div>

              </div>

            </div>

          </div>

        @empty

          <p>No comments found.</p>

        @endforelse

        @if ($comments->count() > 0)

          <div class="d-flex justify-content-center mt-4">
            {{ $comments->links() }}
          </div>

        @endif


      </div>

    </div>

  </x-app-layout>
