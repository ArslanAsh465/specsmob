<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\News;
use App\Models\Mobile;
use App\Models\User;

class BackendNewsController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'News';

        // Filter's Data
        $this->data['users'] = User::whereHas('news')->get();
        $this->data['mobiles'] = Mobile::whereHas('news')->get();

        $query = News::with('user', 'mobile', 'comments');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('mobile_id')) {
            $query->where('mobile_id', $request->mobile_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['news'] = $query->paginate(20)->withQueryString();

        return view('backend.news.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add News';

        $this->data['mobiles'] = Mobile::where('status', 1)->get();

        return view('backend.news.create', $this->data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobile_id' => 'required|exists:mobiles,id',
            'title' => 'required|string|unique:news,title',
            'slug' => 'nullable|string|unique:news,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,archived',

            // SEO
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($validated);

        return redirect()->route('backend.news.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'News created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View News';

        $this->data['news'] = News::with('user', 'mobile', 'comments')->findOrFail($id);

        return view('backend.news.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit News';

        $this->data['news'] = News::with('user', 'mobile', 'comments')->findOrFail($id);

        $this->data['mobiles'] = Mobile::where('status', 1)->get();

        return view('backend.news.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'mobile_id' => 'required|exists:mobiles,id',
            'title' => 'required|string|unique:news,title,' . $news->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,archived',

            // SEO
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('backend.news.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        $news->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'News deleted successfully!');
    }
}
