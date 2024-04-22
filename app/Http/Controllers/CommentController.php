<?php

namespace App\Http\Controllers;

use App\Contracts\Comment\CommentServiceInterface;
use App\Models\Comment;
use App\Http\Requests\Web\Comment\StoreCommentRequest;
use App\Http\Requests\Web\Comment\UpdateCommentRequest;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        try {
            // Get all comments
            $commentss = $this->commentService->getAllComments();

            // Log successful retrieval (optional)
            $this->logger->info('Retrieved all comments successfully');

            // Render a view with the comments
            return view('comments.index', ['comments' => $commentss]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error fetching comments: ' . $e->getMessage());

            // Return an error view (customize as needed)
            return view('errors.500');
        }
    }

    public function show(int $commentId)
    {
        try {
            // Get a specific comments by ID
            $comments = $this->commentService->getCommentById($commentId); // I found that if i change the name to findcommentsById() is more clarity. no worries for now

            if (!$comments) {
                // comments not found
                return abort(404, 'comments not found');
            }

            // Map the retrieved data to a view model (if needed)
            // For example:
            // $model = new RecurringcommentsModel($comments);

            // Return a view with the comments details
            return view('comments.show', ['comments' => $comments]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            // For example:
            // Log::error('Error fetching comments details: ' . $e->getMessage());
            $this->logger->error('Error fetching comments details: ' . $e->getMessage());

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new comments from the request data
            $comments = new Comment([
                'title' => $request->input("title"),
                'short_description' => $request->input("short_description"),
                'long_description' => $request->input("long_description"),
                'due_date' => $request->input("due_date"),
                'priority' => $request->input("priority"),
                'status_id' => $request->input("status_id"),
                'status' => $request->input("status"),
                'created_by' => $request->input("created_by"),
                'assigned_to' => $request->input("assigned_to"),
                'is_recurring' => $request->input("is_recurring"),
                'recurring_comments_id' => $request->input("recurring_comments_id"),
            ]);

            // Add the comments to the database
            $this->commentService->addComment($comments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('comments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error creating comments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function update(UpdateCommentRequest $request, int $commentId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific comments by ID
            $comments = $this->commentService->getCommentById($commentId);

            if (!$comments) {
                // comments not found
                return abort(404, 'comments not found');
            }

            // Update comments properties from the request data
            $comments->title = $request->input("title");
            $comments->short_description = $request->input("short_description");
            $comments->long_description = $request->input("long_description");
            $comments->due_date = $request->input("due_date");
            $comments->priority = $request->input("priority");
            $comments->status_id = $request->input("status_id");
            $comments->status = $request->input("status");
            $comments->created_by = $request->input("created_by");
            $comments->assigned_to = $request->input("assigned_to");
            $comments->is_recurring = $request->input("is_recurring");
            $comments->recurring_comments_id = $request->input("recurring_comments_id");

            // Save the updated comments
            $this->commentService->updateComment($comments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('comments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error updating comments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    public function destroy(int $commentId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get a specific comments by ID
            $comments = $this->commentService->getCommentById($commentId);

            if (!$comments) {
                // comments not found
                return abort(404, 'comments not found');
            }

            // Delete the comments
            $this->commentService->deleteComment($comments);

            // Commit the transaction
            DB::commit();

            // Redirect to the index page (or any other appropriate page)
            return redirect()->route('comments.index');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log, notify, etc.)
            $this->logger->error('Error deleting comments: ' . $e->getMessage());

            // Roll back the transaction
            DB::rollBack();

            // Return an error view
            return view('errors.500'); // Customize the error view as needed
        }
    }

    // End Methods

    // Helpers

    // End Helpers
}
