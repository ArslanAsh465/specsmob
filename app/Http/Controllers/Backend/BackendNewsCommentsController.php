<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\NewsComment;
use App\Models\News;
use App\Models\User;

class BackendNewsCommentsController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'News Comments';

        // Filter's Data
        $this->data['news'] = News::whereHas('comments')->get();
        $this->data['users'] = User::whereHas('newsComments')->get();

        $query = NewsComment::with('user', 'news');

        if ($request->filled('news_id')) {
            $query->where('news_id', $request->news_id);
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

        return view('backend.news_comments.index', $this->data);
    }

    public function show($id)
    {
        $this->data['title'] = 'View News Comment';

        $this->data['comment'] = NewsComment::with('user', 'news')->findOrFail($id);

        return view('backend.news_comments.show', $this->data);
    }

    public function destroy($id)
    {
        $comment = NewsComment::findOrFail($id);

        $comment->delete();

        return redirect()->route('backend.news_comments.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Comment deleted successfully.');
    }
}
