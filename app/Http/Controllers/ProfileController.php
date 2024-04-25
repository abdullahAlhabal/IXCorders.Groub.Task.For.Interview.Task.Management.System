<?php

namespace App\Http\Controllers;

use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Contracts\Comment\CommentServiceInterface;
use App\Contracts\Task\TaskServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    // Members
    private TaskServiceInterface $taskService;
    private UserServiceInterface $userService;
    private CommentServiceInterface $commentService;
    private AttachmentServicesInterface $attachmentService;
    private Logger $logger;

    // End Members

    // Constructor
    public function __construct(TaskServiceInterface $taskService, UserServiceInterface $userService, CommentServiceInterface $commentService, AttachmentServicesInterface $attachmentService, Logger $logger)
    {
        $this->taskService = $taskService;
        $this->userService = $userService;
        $this->commentService = $commentService;
        $this->attachmentService = $attachmentService;
        $this->logger = $logger;
    }
    // End Constructor

    public function myProfile()
    {
        try {

            $user = auth()->user();
            $tasks = $this->taskService->getUserTasks($user->id);
            $userComments = $this->commentService->getAllCommentsByUserPaginated($user->id);
            $userAttachments = $this->attachmentService->getAttachmentByUserPaginated($user->id);

            return view('profile.me', compact('user', 'tasks', 'userComments', 'userAttachments'));
        } catch (\Exception $e) {
            $this->logger->error('Error fetching user Profile: ' . $e->getMessage());

            session()->flash('error', 'Error fetching user Profile: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching user Profile']);
        }
    }

    public function showProfile(int $userId)
    {
        try {

            $user = $this->userService->getUserById($userId);

            if (!$user) {
                abort(404, 'User not found');
            }

            $tasks = $this->taskService->getUserTasks($userId);
            $userComments = $this->commentService->getAllCommentsByUserPaginated($userId);
            $userAttachments = $this->attachmentService->getAttachmentByUserPaginated($userId);

            return view('profile.show', compact('user', 'tasks', 'userComments', 'userAttachments'));
        } catch (\Exception $e) {
            $this->logger->error('Error fetching user Profile: ' . $e->getMessage());

            session()->flash('error', 'Error fetching user Profile: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching user Profile']);
        }
    }

    public function showTasks(Request $request)
    {
        try {
            $perPage = $request->query('perPage', 10);

            $searchTerm = $request->query('search') ;

            $userId = $request->user()->id;

            $tasks = $this->taskService->searchUserTasks($userId ,$searchTerm, $perPage);

            return view('profile.tasks', compact('tasks'));

        } catch (\Exception $e) {

            $this->logger->error('Error fetching tasks: ' . $e->getMessage());

            session()->flash('error', 'Error fetching tasks: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching tasks']);
        }
    }

    public function showComments(Request $request)
    {
        try {
            $perPage = $request->query('perPage', 10);

            $userId = $request->user()->id;

            $comments = $this->commentService->getAllCommentsByUserPaginated($userId, $perPage);

            return view('profile.comments', compact('comments'));

        } catch (\Exception $e) {

            $this->logger->error('Error fetching comments: ' . $e->getMessage());

            session()->flash('error', 'Error fetching comments: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching comments']);
        }
    }

    public function showAttachments(Request $request)
    {
        try {
            $perPage = $request->query('perPage', 10);

            $userId = $request->user()->id;

            $attachments = $this->attachmentService->getAttachmentByUserPaginated($userId, $perPage);

            return view('profile.attachments', compact('attachments'));

        } catch (\Exception $e) {

            $this->logger->error('Error fetching attachments: ' . $e->getMessage());

            session()->flash('error', 'Error fetching attachments: ' . $e->getMessage());

            return redirect()->route('dashboard')->withErrors(['error' => 'Error fetching attachments']);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
