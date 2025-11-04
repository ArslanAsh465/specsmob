<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MobileComment;
use App\Models\Mobile;
use App\Models\User;

class BackendMobileCommentsController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'Mobile Comments';

        // Filter's Data
        $this->data['mobiles'] = Mobile::whereHas('comments')->get();
        $this->data['users'] = User::whereHas('mobiles')->get();

        $query = MobileComment::with('user', 'mobile');

        if ($request->filled('mobile_id')) {
            $query->where('mobile_id', $request->mobile_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('stars')) {
            $query->where('stars', $request->stars);
        }

        $this->data['comments'] = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('backend.mobile_comments.index', $this->data);
    }

    public function show($id)
    {
        $this->data['title'] = 'View Mobile Comment';

        $this->data['comment'] = MobileComment::with('user', 'mobile')->findOrFail($id);

        return view('backend.mobile_comments.show', $this->data);
    }

    public function destroy($id)
    {
        $comment = MobileComment::findOrFail($id);

        $comment->delete();

        return redirect()->route('backend.mobile_comments.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Comment deleted successfully.');
    }
}
