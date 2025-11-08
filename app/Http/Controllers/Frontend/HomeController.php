<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Mobile;
use App\Models\Review;
use App\Models\News;

class HomeController extends Controller
{
    protected $data = [];

    // Home Page
    public function home()
    {
        // Get latest 3 devices
        $this->data['latestDevices'] = Mobile::orderBy('created_at', 'desc')->where('status', 1)->take(3)->get();

        // Get latest 3 reviews
        $this->data['latestReviews'] = Review::orderBy('created_at', 'desc')->where('status', 1)->take(3)->get();

        // Pass data array to view
        return view('frontend.home', $this->data);
    }

    public function news()
    {
        $this->data['news'] = News::latest()->paginate(10);

        return view('frontend.news', $this->data);
    }

    public function newsShow($slug)
    {
        $this->data['newsItem'] = News::where('slug', $slug)->firstOrFail();

        return view('frontend.news-show', $this->data);
    }

    public function reviews()
    {
        return view('frontend.reviews');
    }

    public function videos()
    {
        return view('frontend.videos');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function brands()
    {
        return view('frontend.brands');
    }

    // Search Page
    public function search(Request $request)
    {
        $query = $request->input('query');

        $this->data['query'] = $query;
        $this->data['results'] = Mobile::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('frontend.search', $this->data);
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $results = Mobile::where('name', 'LIKE', "%{$query}%")
                ->limit(10) // limit results
                ->get();
            
            return response()->json($results);
        }

        return response()->json([]);
    }
}
