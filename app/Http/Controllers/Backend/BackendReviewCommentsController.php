<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ReviewComment;
use App\Models\Review;
use App\Models\User;

class BackendReviewCommentsController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'Review Comments';

        // Filter data
        $this->data['reviews'] = Review::whereHas('comments')->get();
        $this->data['users'] = User::whereHas('reviewComments')->get();

        $query = ReviewComment::with('user', 'review');

        if ($request->filled('review_id')) {
            $query->where('review_id', $request->review_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('stars')) {
            $query->where('stars', $request->stars);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['comments'] = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('backend.review_comments.index', $this->data);
    }

    public function show($id)
    {
        $this->data['title'] = 'View Review Comment';

        $this->data['comment'] = ReviewComment::with('user', 'review')->findOrFail($id);

        return view('backend.review_comments.show', $this->data);
    }

    public function destroy($id)
    {
        $comment = ReviewComment::findOrFail($id);

        $comment->delete();

        return redirect()->route('backend.review_comments.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Comment deleted successfully.');
    }
}
