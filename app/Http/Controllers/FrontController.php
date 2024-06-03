<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Article;
use App\Models\Bikecheck;
use App\Models\Book;
use App\Models\Distributor;
use App\Models\Faq;
use App\Models\GlobalMember;
use App\Models\History;
use App\Models\HowTo;
use App\Models\Job;
use App\Models\News;
use App\Models\RaceTeamMember;
use App\Models\Recycling;
use App\Models\UsMember;
use App\Models\Video;
use App\Page;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $shop_by_categories = Category::with('parent', 'children')
            ->where('parent_id', '!=', 0)
            ->inRandomOrder()->get()->take(4);

        $featured_products = Product::where('is_featured', 1)
            ->inRandomOrder()->get()->take(8);
//        $page = Page::find(1);
//        $section = DB::table('section')->where('page_id', 1)->get();
//        $banner = DB::table('banners')->get();
//        $blog = DB::table('blogs')->get();
//        $instagram = DB::table('instagrams')->take(5)->get();
//
        $get_product = Product::where('status', '1')
            ->inRandomOrder()
            ->take(6)
            ->with('categorys')
            ->get();

        $featured_product = Product::where('status', '1')
            ->take(8)
            ->get();

//
//        return view('welcome', compact('page', 'section', 'banner', 'blog', 'instagram', 'get_product', 'popular_books'));
        $categories = Category::where('parent_id', 0)->get();
        return view('welcome', compact('categories', 'get_product', 'featured_product', 'shop_by_categories', 'featured_products'));

    }

    public function about()
    {

//        $page = Page::find(2);
//        $section = DB::table('section')->where('page_id', 7)->get();
//
//        return view('about', compact('page', 'section'));
        $categories = Category::where('parent_id', 0)->get();
        return view('about', compact('categories'));
    }

    public function categories(Request $request)
    {
        if ($request->has('category_id')) {
            $category = Category::find($request->get('category_id'));
            if ($category->children->count() == 0) {
                return redirect()->route('front.shop', ['category_id' => $category->id]);
            }
        }

        $categories = Category::with('parent', 'children')
            ->where('parent_id', ($request->has('category_id') ? $request->get('category_id') : 0))
            ->get();

        return view('categories', compact('categories'));
    }

    public function categoryDetail(Request $request, $id)
    {
        if (!$category = Category::find($id)) {
            return redirect()->back();
        }

        $categories = Category::with('parent', 'children')->where('parent_id', 0)->get();

        return view('category_detail', compact('category', 'categories'));
    }

    public function compare()
    {
        return view('compare');
    }

    public function contact()
    {
        $categories = Category::where('parent_id', 0)->get();
//        $page = DB::table('pages')->where('id', 1)->first();
//
//        return view('contact', compact('page'));
        return view('contact', compact('categories'));
    }

    public function productDetail(Request $request, $id)
    {
        if (!$product = Product::find($id)) {
            return redirect()->back();
        }

        $product_images = DB::table('product_imagess')
            ->where('product_id', $id)
            ->get();

        $categories = Category::with('parent', 'children')->where('parent_id', 0)->get();

        return view('product_detail', compact('product', 'product_images', 'categories'));
    }

    public function shop(Request $request)
    {
        $filters = [
            'title' => $request->get('title') ?? null,
            'category_id' => $request->get('category_id') ?? null,
        ];

        $categories = Category::with('parent', 'children')->where('parent_id', 0)->get();

        $category_tree_ids = [];
        if (!is_null($filters['category_id'])) {
            $category = Category::with('parent', 'children')->find($filters['category_id']);
            while ($category->parent_id != 0) {
                $category_tree_ids []= $category->id;
                $category = Category::find($category->parent_id);
            }
            $category_tree_ids []= $category->id;
        }

        $products = Product::when($filters['title'], function ($q) use ($filters) {
            return $q->where('product_title', 'LIKE', '%'.$filters['title'].'%');
        })->when($filters['category_id'], function ($q) use ($filters) {
            return $q->where('category', $filters['category_id'])
                    ->orWhere(function ($q) use ($filters) {
                        return $q->whereHas('categorys', function ($q) use ($filters) {
                            return $q->where('parent_id', $filters['category_id'])
                                    ->orWhere(function ($q) use ($filters) {
                                        return $q->whereHas('parent', function ($q) use ($filters) {
                                            return $q->where('parent_id', $filters['category_id'])
                                                    ->orWhere(function ($q) use ($filters) {
                                                        return $q->whereHas('parent', function ($q) use ($filters) {
                                                            return $q->where('parent_id', $filters['category_id'])
                                                                    ->orWhere(function ($q) use ($filters) {
                                                                        return $q->whereHas('parent', function ($q) use ($filters) {
                                                                            return $q->where('parent_id', $filters['category_id'])
                                                                                    ->orWhere(function ($q) use ($filters) {
                                                                                        return $q->whereHas('parent', function ($q) use ($filters) {
                                                                                            return $q->where('parent_id', $filters['category_id']);
                                                                                        });
                                                                                    });
                                                                        });
                                                                    });
                                                        });
                                                    });
                                        });
                                    });
                            });
                        });
        })->paginate(18);

        $latest_product = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('shop', compact('products', 'filters', 'categories', 'category_tree_ids', 'latest_product'));
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function bio (Request $request)
    {
        return view('bio');
    }

    public function featured (Request $request)
    {
        $page = Page::find(8);
        return view('featured', compact('page'));
    }

    public function featuredDetail (Request $request, $id)
    {
        $page = Page::find(8);
        return view('featured-detail', compact('page'));
    }

    public function books (Request $request)
    {
        $books = Book::paginate(10);

        return view('books', compact('books'));
    }

    public function bookDetail (Request $request, $id)
    {
        $book = Book::find($id);

        return view('book-detail', compact('book'));
    }

    public function articles (Request $request)
    {
        $articles = Article::paginate(10);

        return view('articles', compact('articles'));
    }

    public function articleDetail (Request $request, $id)
    {
        $article = Article::find($id);

        return view('article-detail', compact('article'));
    }

    public function videos (Request $request)
    {
        $videos = Video::all();

        return view('videos', compact('videos'));
    }

    public function blog (Request $request)
    {
        return view('blog');
    }

    public function myAccount (Request $request)
    {
        return view('my-account');
    }

    public function bikeChecks (Request $request)
    {
        $bike_checks = Bikecheck::paginate(10);

        return view('bike-checks', compact('bike_checks'));
    }

    public function bikeCcheckDetail (Request $request, $id)
    {
        $bike_check = Bikecheck::find($id);

        return view('bike-check-detail', compact('bike_check'));
    }

    public function distributors (Request $request)
    {
        $distributors = Distributor::all();

        return view('distributors', compact('distributors'));
    }

    public function factoryRaceTeam (Request $request)
    {
        $race_team_members = RaceTeamMember::all();

        return view('factory-race-team', compact('race_team_members'));
    }

    public function faqs (Request $request)
    {
        $faqs = Faq::all();

        return view('faqs', compact('faqs'));
    }

    public function freestyleGlobalFamily (Request $request)
    {
        $global_members = GlobalMember::all();

        return view('freestyle-global-family', compact('global_members'));
    }

    public function freestyleUsFamily (Request $request)
    {
        $us_members = UsMember::all();

        return view('freestyle-us-family', compact('us_members'));
    }

    public function history (Request $request)
    {
        $histories = History::all();

        return view('history', compact('histories'));
    }

    public function howTos (Request $request)
    {
        $how_tos = HowTo::paginate(10);

        $recent_how_tos = HowTo::orderBy('id', 'ASC')->get();

        return view('how-tos', compact('how_tos', 'recent_how_tos'));
    }

    public function howToDetail (Request $request, $id)
    {
        $how_to = HowTo::find($id);

        return view('how-to-detail', compact('how_to'));
    }

    public function jobs (Request $request)
    {
        $jobs = Job::all();

        return view('jobs', compact('jobs'));
    }

    public function jobDetail (Request $request, $id)
    {
        $job = Job::find($id);

        return view('job-detail', compact('job'));
    }

    public function manufacturing (Request $request)
    {
        $page = Page::where('name', 'Manufacturing')->first();

        return view('manufacturing', compact('page'));
    }

    public function news (Request $request)
    {
        $all_items = News::paginate(20);
        $news_items = News::where('type', 'News')->paginate(20);
        $event_items = News::where('type', 'Event')->paginate(20);
        $video_items = News::where('type', 'Video')->paginate(20);

        return view('news', compact('all_items', 'news_items', 'event_items', 'video_items'));
    }

    public function newsDetail (Request $request, $id)
    {
        $news = News::find($id);

        return view('news-detail', compact('news'));
    }

    public function recycling (Request $request)
    {
        $recyclings = Recycling::all();

        return view('recycling', compact('recyclings'));
    }

    public function returns (Request $request)
    {
        $page = Page::where('name', 'Returns')->first();

        return view('returns', compact('page'));
    }

    public function shipping (Request $request)
    {
        $page = Page::where('name', 'Shipping')->first();

        return view('shipping', compact('page'));
    }

    public function terms (Request $request)
    {
        $page = Page::where('name', 'Terms')->first();

        return view('terms', compact('page'));
    }

    public function privacy (Request $request)
    {
        $page = Page::where('name', 'Privacy')->first();

        return view('privacy', compact('page'));
    }

    public function support (Request $request)
    {
        return view('support');
    }

    public function measurements (Request $request)
    {
        return view('measurements');
    }

    public function warrantyInfo (Request $request)
    {
        $page = Page::where('name', 'Warranty')->first();

        return view('warranty-info', compact('page'));
    }

}
