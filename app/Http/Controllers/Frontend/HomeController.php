<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use App\Models\Mobile;
use App\Models\Review;
use App\Models\News;
use App\Models\MobileComment;
use App\Models\NewsComment;
use App\Models\ReviewComment;

class HomeController extends Controller
{
    protected $data = [];

    // Home Page
    public function home()
    {
        // Latest 3 reviews
        $latestReviews = Review::where('status', 'published')->withCount('comments')->orderBy('created_at', 'desc')->take(3)->get();
        $this->data['latestReviews'] = $latestReviews;

        // Latest 3 news
        $latestNews = News::where('status', 'published')->withCount('comments')->orderBy('created_at', 'desc')->take(3)->get();
        $this->data['latestNews'] = $latestNews;

        // IDs to exclude (latest 3)
        $excludeReviewIds = $latestReviews->pluck('id')->toArray();
        $excludeNewsIds = $latestNews->pluck('id')->toArray();

        // Top 10 reviews excluding latest 3
        $this->data['topReviews'] = Review::where('status', 1)->whereNotIn('id', $excludeReviewIds)->withCount('comments')->orderBy('views', 'desc')->take(10)->get();

        // Top 10 news excluding latest 3
        $this->data['topNews'] = News::where('status', 1)->whereNotIn('id', $excludeNewsIds)->withCount('comments')->orderBy('views', 'desc')->take(10)->get();

        return view('frontend.home', $this->data);
    }

    public function news()
    {
        $this->data['news'] = News::where('status', 'published')->latest()->paginate(10);

        return view('frontend.news', $this->data);
    }

    public function newsShow($slug)
    {
        $news = News::with(['comments' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $this->data['newsItem'] = $news;

        $this->data['seo'] = [
            'title' => $news->seo_title ?? $news->title,
            'description' => $news->seo_description ?? Str::limit(strip_tags($news->content), 160),
            'keywords' => $news->seo_keywords ?? 'news, latest news',
            'image' => $news->image_url ?? asset('app-assets/images/default-news.png'),
            'url' => route('news.show', $news->slug),
        ];

        return view('frontend.news-show', $this->data);
    }

    public function reviews()
    {
        $this->data['reviews'] = Review::where('status', 'published')->latest()->paginate(10);

        return view('frontend.reviews', $this->data);
    }

    public function reviewShow($slug)
    {
        $review = Review::with(['comments' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $this->data['review'] = $review;

        $this->data['seo'] = [
            'title' => $review->seo_title ?? $review->title,
            'description' => $review->seo_description ?? Str::limit(strip_tags($review->content), 160),
            'keywords' => $review->seo_keywords ?? 'reviews, mobile reviews',
            'image' => $review->image_url ?? asset('app-assets/images/default-review.png'),
            'url' => route('review.show', $review->slug),
        ];

        return view('frontend.review-show', $this->data);
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
        $this->data['brands'] = Brand::with('mobiles')->where('status', 1)->get();
        
        return view('frontend.brands', $this->data);
    }

    public function brandShow($slug)
    {
        $brand = Brand::with(['mobiles' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $this->data['brand'] = $brand;

        $this->data['seo'] = [
            'title' => $brand->seo_title ?? $brand->name,
            'description' => $brand->seo_description ?? Str::limit(strip_tags($brand->description ?? ''), 160),
            'keywords' => $brand->seo_keywords ?? 'brand, mobile, phones',
            'image' => $brand->image_url ?? asset('app-assets/images/default-brand.png'),
            'url' => route('brand.show', $brand->slug),
        ];

        return view('frontend.brand-show', $this->data);
    }

    public function mobileShow($slug)
    {
        $mobile = Mobile::with(['comments' => function($query) {
            $query->orderBy('created_at', 'desc');
        }], 'review', 'news')
        ->where('slug', $slug)
        ->firstOrFail();

        $this->data['mobile'] = $mobile;

        $this->data['seo'] = [
            'title' => $mobile->seo_title ?? $mobile->name,
            'description' => $mobile->seo_description ?? Str::limit(strip_tags($mobile->description), 160),
            'keywords' => $mobile->seo_keywords ?? 'mobile, smartphone, specs',
            'image' => $mobile->image_url ?? asset('app-assets/images/default-mobile.png'),
            'url' => route('mobile.show', $mobile->slug),
        ];

        return view('frontend.mobile-show', $this->data);
    }

    // Phone Finder
    public function phoneFinder()
    {
        $this->data['brands'] = Brand::all();

        return view('frontend.phone-finder', $this->data);
    }

    public function phoneFinderResults(Request $request)
    {
        $this->data['mobiles'] = Mobile::all();

        return view('frontend.phone-finder-results', $this->data);
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

    public function ajaxComment(Request $request)
    {
        $request->validate([
            'comment_model' => 'required|in:mobile,news,review',
            'mobile_id'     => 'required_if:comment_model,mobile|exists:mobiles,id',
            'news_id'       => 'required_if:comment_model,news|exists:news,id',
            'review_id'     => 'required_if:comment_model,review|exists:reviews,id',
            'comment'       => 'required|string|max:1000',
            'stars'         => 'nullable|integer|min:1|max:5',
        ]);

        $commentModel = $request->input('comment_model');
        $commentText  = $request->input('comment');
        $stars        = $request->input('stars', null);

        switch ($commentModel) {
            case 'mobile':
                $comment = MobileComment::create([
                    'user_id'   => auth()->id(),
                    'mobile_id' => $request->input('mobile_id'),
                    'comment'   => $commentText,
                    'stars'     => $stars,
                ]);
                break;

            case 'news':
                $comment = NewsComment::create([
                    'user_id'   => auth()->id(),
                    'news_id' => $request->input('news_id'),
                    'comment' => $commentText,
                    'stars'     => $stars,
                ]);
                break;

            case 'review':
                $comment = ReviewComment::create([
                    'user_id'   => auth()->id(),
                    'review_id' => $request->input('review_id'),
                    'comment'   => $commentText,
                    'stars'     => $stars,
                ]);
                break;

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid comment model',
                ], 400);
        }

        return back();
    }
}
