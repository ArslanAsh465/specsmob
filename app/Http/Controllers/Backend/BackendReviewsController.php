<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Review;
use App\Models\Mobile;
use App\Models\User;

class BackendReviewsController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $this->data['title'] = 'Reviews';

        // Filter's Data
        $this->data['users'] = User::whereHas('reviews')->get();
        $this->data['mobiles'] = Mobile::whereHas('review')->get();

        $query = Review::with('user', 'mobile', 'comments');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('mobile_id')) {
            $query->where('mobile_id', $request->mobile_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $this->data['reviews'] = $query->paginate(20)->withQueryString();

        return view('backend.reviews.index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Add Review';

        $this->data['mobiles'] = Mobile::where('status', 1)->get();

        return view('backend.reviews.create', $this->data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobile_id' => 'required|exists:mobiles,id',
            'title' => 'required|string|unique:reviews,title',
            'slug' => 'nullable|string|unique:reviews,slug',
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
            $validated['image'] = $request->file('image')->store('reviews', 'public');
        }

        Review::create($validated);

        return redirect()->route('backend.reviews.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Review created successfully.');
    }

    public function show($id)
    {
        $this->data['title'] = 'View Review';

        $this->data['review'] = Review::with('user', 'mobile', 'comments')->findOrFail($id);

        return view('backend.reviews.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Review';

        $this->data['review'] = Review::with('user', 'mobile', 'comments')->findOrFail($id);

        $this->data['mobiles'] = Mobile::where('status', 1)->get();

        return view('backend.reviews.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'mobile_id' => 'required|exists:mobiles,id',
            'title' => 'required|string|unique:reviews,title,' . $review->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,archived',

            // SEO
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('reviews', 'public');
        }

        $review->update($validated);

        return redirect()->route('backend.reviews.index')
            ->with('alert_type', 'success')
            ->with('alert_message', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Review deleted successfully!');
    }
}
