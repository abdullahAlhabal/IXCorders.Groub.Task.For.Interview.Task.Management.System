<?php

namespace App\Http\Controllers;

use App\Contracts\Comment\CommentServiceInterface;
use App\Models\Comment;
use App\Http\Requests\Web\Comment\StoreCommentRequest;
use App\Http\Requests\Web\Comment\UpdateCommentRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Members
    private CommentServiceInterface $commentService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(CommentServiceInterface $commentService, Logger $logger)
    {
        $this->commentService = $commentService;
        $this->logger = $logger;
    }
    // End Constructor

    // Methods

    public function index(Request $request)
    {
        try {

            $perPage = $request->query('perPage', 10);

            $userId = Auth::id();

            $commentss = $this->commentService->getAllCommentsPaginated($perPage);

            $this->logger->info('Retrieved all comments successfully');

            return view('comments.index', compact("commentss"));
        } catch (\Exception $e) {
            $this->logger->error('Error fetching comments: ' . $e->getMessage());

            return view('errors.500');
        }
    }

    // we will not use it in the views - there won't be a view for a specific comment

    // public function show(int $commentId)
    // {
    //     try {

    //         if (is_null($commentId)) {
    //             abort(400, 'Invalid comment ID');
    //         }

    //         $comments = $this->commentService->getCommentById($commentId);

    //         if (!$comments) {
    //             return abort(404, 'comments not found');
    //         }
    //         return view('comments.show', ['comments' => $comments]);
    //     } catch (\Exception $e) {
    //         $this->logger->error('Error fetching comments details: ' . $e->getMessage());

    //         return view('errors.500');
    //     }
    // }

    public function create($taskId)
    {
        try {
            $this->authorize('create', Comment::class);
            return view('comments.create', compact("taskId"));

        } catch (\Exception $e) {

            $this->logger->error('Error : ' . $e->getMessage());
            session()->flash('error', 'Error .');
            return abort(500, 'Error ');
        }
    }


    public function store(StoreCommentRequest $request)
    {
        try {
            DB::beginTransaction();

            $comments = new Comment([
                'comment' => $request->input('comment'),
                'written_by' => Auth::id(),
                'task_id' => $request->input('task_id'),
            ]);

            $this->commentService->addComment($comments);

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            $this->logger->error('Error creating comments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500');
        }
    }

    public function update(UpdateCommentRequest $request, int $commentId)
    {
        try {
            DB::beginTransaction();

            $comment = $this->commentService->getCommentById($commentId);

            if (!$comment) {
                return abort(404, 'comments not found');
            }

            $comment->comment = $request->input('comment');

            $this->commentService->updateComment($comment);

            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            $this->logger->error('Error updating comments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500');
        }
    }

    public function destroy(int $commentId)
    {
        try {
            DB::beginTransaction();

            $comment = $this->commentService->getCommentById($commentId);

            if (!$comment) {
                return abort(404, 'comments not found');
            }

            $this->commentService->deleteComment($comment);

            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            $this->logger->error('Error deleting comments: ' . $e->getMessage());

            DB::rollBack();

            return view('errors.500');
        }
    }

    // End Methods

    // Helpers

    // End Helpers
}
