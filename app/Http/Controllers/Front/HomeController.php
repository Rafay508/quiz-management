<?php

namespace App\Http\Controllers\Front;

use Mail;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\ProductComment;
use App\Models\ProductCommentReply;
use App\Models\ProductCommentLike;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogComment;
use App\Models\BlogCommentReply;
use App\Models\BlogCommentLike;
use App\Models\Admin;
use App\Models\MetaDetail;
use App\Models\SiteSetting;
use App\Models\ProductGallery;
use App\Models\ContactMessage;
use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactFormMail;
use App\Models\PhoneFinderCustomization;
use App\Models\NotificationEmail;
use App\Models\WebStoryCategory;
use App\Models\WebStory;
use App\Models\BlogGallery;

class HomeController extends Controller
{
    /**
     * Public Web
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function login()
    {
        return redirect()->route('login');
    }

    public function index()
    {
        // popular products
        $popular_products = Product::whereStatus(1)
            ->with('galleries')
            ->orderByRaw('CAST(clicks AS UNSIGNED) DESC')
            ->limit(8)
            ->latest()
            ->get();

        // trending products
        $trending_products = Product::whereStatus(1)
            ->whereHas('trendingCategory', function($query) {
                $query->where('name', 'Trending');
            })
            ->with('trendingCategory', 'galleries')
            ->orderBy('publish_date', 'desc')
            ->limit(8)
            ->latest()
            ->get();

        // upcoming products
        $upcoming_products = Product::whereStatus(1)
            ->whereHas('upcomingCategory', function($query) {
                $query->where('name', 'Upcoming');
            })
            ->with('upcomingCategory', 'galleries')
            ->orderBy('publish_date', 'desc')
            ->limit(8)
            ->latest()
            ->get();

        $web_story_categories = WebStoryCategory::whereHas('webStories')->withCount('webStories')->latest()->get();
        $comparing_products = Product::whereStatus(1)->inRandomOrder()->take(8)->get(['name', 'slug', 'image', 'original_price']);
        $blogs = Blog::latest()->limit(6)->get();
        $brands = Brand::whereIsShow(1)->latest()->limit(15)->get();
        $meta = MetaDetail::wherePage('home')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.index', compact('popular_products', 'trending_products', 'upcoming_products', 'blogs', 'brands', 'comparing_products', 'web_story_categories', 'seoData'));
    }

    public function productByBrand($slug)
    {
        $brand = Brand::whereSlug($slug)->first();

        if (!$brand) {
            return redirect()->back()->with('info', 'Brand not found!');
        }

        $products = Product::whereStatus(1)
            ->whereHas('brand', function($query) use ($slug) {
                $query->whereSlug($slug);
            })
            ->with('galleries')
            ->orderBy('publish_date', 'desc')
            ->paginate(12);

        $seoData = [
            'title' => $brand->meta_title ?? 'Default Title',
            'description' => $brand->meta_description ?? 'Default description',
            'keywords' => $brand->meta_keywords ?? 'Default, Keywords',
            'h1' => $brand->h1 ?? 'Default H1',
        ];

        return view('front.products-by-brand', compact('products', 'brand', 'seoData'));
    }

    public function upcomingMobile()
    {
        $products = Product::whereStatus(1)
            ->whereHas('upcomingCategory')
            ->with('galleries')
            ->orderBy('publish_date', 'desc')
            ->paginate(12);

        $meta = MetaDetail::wherePage('upcomming_mobiles')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.upcoming-mobiles', compact('products', 'seoData'));
    }

    public function popularMobile()
    {
        $products = Product::where('status', 1)
            ->orderByRaw('CAST(clicks AS UNSIGNED) DESC')
            ->take(12)
            ->get();

        $meta = MetaDetail::wherePage('popular_mobiles')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.popular-mobiles', compact('products', 'seoData'));
    }

    public function latestMobile()
    {
        $products = Product::where('status', 1)
            ->orderByRaw('CAST(clicks AS UNSIGNED) DESC')
            ->whereHas('trendingCategory')
            ->take(12)
            ->get();

        $meta = MetaDetail::wherePage('trending_mobiles')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.latest-mobiles', compact('products', 'seoData'));
    }

    public function productDetail($slug)
    {
        $product = Product::whereStatus(1)->whereSlug($slug)->with('attributes', 'comments')->first();

        if (!$product) {
            return redirect()->back()->with('info', 'Product not found!');
        }

        // update clicks count
        if ($product->clicks == '') {
            $product->update(['clicks' => 1]);
        } else {
            $product->increment('clicks');
        }

        $more_mobiles = Product::whereStatus(1)
            ->where('slug', '!=', $slug)
            ->whereBrandId($product->brand_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $latest_mobiles = Product::whereStatus(1)
            ->where('slug', '!=', $slug)
            ->where('brand_id', '=', $product->brand_id)
            ->whereHas('upcomingCategory')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $compare_to_products = Product::whereStatus(1)
            ->where('slug', '!=', $slug)
            ->whereBrandId($product->brand_id)
            ->take(10)->latest()->get();

        // comparing products
        $comparing_products = Product::whereStatus(1)
            ->where('slug', '!=', $slug)
            ->inRandomOrder()
            ->take(6)
            ->get(['name', 'slug', 'image', 'original_price']);

        $seoData = [
            'title' => $product->meta_title ?? 'Default Title',
            'description' => $product->meta_description ?? 'Default description',
            'keywords' => $product->meta_keywords ?? 'Default, Keywords',
            'h1' => $product->h1 ?? 'Default H1',
        ];

        $searchableProducts = Product::where('id', '!=', $product->id)->whereStatus(1)->latest()->get(['id', 'name', 'slug', 'image', 'alt_image']);

        return view('front.product-detail', compact('product', 'seoData', 'more_mobiles', 'latest_mobiles', 'compare_to_products', 'comparing_products', 'searchableProducts'));
    }

    public function productPostComment(Request $request)
    {
        $user = Auth::user();

        // check user is authenticated
        if (!$user || $user->id == '') {
            return response()->json(['status' => 2, 'message' => 'Please sign-in first then post a review!']);
        }

        // comment field validation
        if ($request->type == 'comment' && $request->comment == '') {
            return response()->json(['status' => 0, 'message' => 'Write a review then post.']);
        } else if ($request->type == 'reply' && $request->comment == '') {
            return response()->json(['status' => 0, 'message' => 'Write a reply then post.']);
        }

        // store comments, replies & comments likes/dislikes
        if ($request->type == 'comment') {
            ProductComment::create([
                'product_id' => $request->product_id,
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);

            // product comments and replies
            $product = Product::with('comments')->find($request->product_id);
            $product_comments_and_replies = view('front.product-comments-and-replies', compact('product'))->render();

            return response()->json([
                'status' => 1, 
                'product_comments_and_replies' => $product_comments_and_replies, 
                'message' => 'Review has been posted successfully.'
            ]);
        } else if ($request->type == 'reply') {
            ProductCommentReply::create([
                'product_comment_id' => $request->product_comment_id,
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);

            // product comments and replies
            $product = Product::with('comments')->find($request->product_id);
            $product_comments_and_replies = view('front.product-comments-and-replies', compact('product'))->render();

            return response()->json([
                'status' => 1, 
                'product_comments_and_replies' => $product_comments_and_replies,
                'message' => 'Reply has been posted successfully.'
            ]);
        } else if ($request->type == 'comment_like' || $request->type == 'comment_dislike') {
            ProductCommentLike::updateOrCreate(
                [
                    'product_comment_id' => $request->product_comment_id,
                    'user_id' => $user->id,
                ],
                [
                    'like' => $request->type == 'comment_like' ? 1 : 0,
                    'dislike' => $request->type == 'comment_dislike' ? 1 : 0,
                ]
            );

            // product comments and replies
            $product = Product::with('comments')->find($request->product_id);
            $product_comments_and_replies = view('front.product-comments-and-replies', compact('product'))->render();

            return response()->json([
                'status' => 1, 
                'product_comments_and_replies' => $product_comments_and_replies,
                'message' => ''
            ]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong please try again later.']);
        }
    }

    public function blogIndex()
    {
        $blogs = Blog::latest()->paginate(7);
        $products = Product::whereStatus(1)->latest()->limit(4)->get();

        $meta = MetaDetail::wherePage('blogs')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.blogs', compact('blogs', 'products', 'seoData'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::with('comments')->whereSlug($slug)->first();

        if (!$blog) {
            return redirect()->back()->with('info', 'Tech news not found!');
        }

        // update clicks count
        if ($blog->clicks == '') {
            $blog->update(['clicks' => 1]);
        } else {
            $blog->increment('clicks');
        }

        $admin = Admin::whereIsSystemAdmin(1)->first();
        $blogs = Blog::latest()->limit(6)->get();
        $blog_gallery = BlogGallery::whereBlogId($blog->id)->get();
        $products = Product::whereStatus(1)
            ->orderByRaw('CAST(clicks AS UNSIGNED) DESC')
            ->with('galleries')
            ->limit(4)
            ->get();

        $seoData = [
            'title' => $blog->meta_title ?? 'Default Title',
            'description' => $blog->meta_description ?? 'Default description',
            'keywords' => $blog->meta_keywords ?? 'Default, Keywords',
            'h1' => $blog->h1 ?? 'Default H1',
        ];

        return view('front.blog-details', compact('blog', 'blogs', 'products', 'admin', 'blog_gallery', 'seoData'));
    }

    public function blogPostComment(Request $request)
    {
        $user = Auth::user();

        // check user is authenticated
        if (!$user || $user->id == '') {
            return response()->json(['status' => 2, 'message' => 'Please sign-in first then post a review!']);
        }

        // comment field validation
        if ($request->type == 'comment' && $request->comment == '') {
            return response()->json(['status' => 0, 'message' => 'Write a review then post.']);
        } else if ($request->type == 'reply' && $request->comment == '') {
            return response()->json(['status' => 0, 'message' => 'Write a reply then post.']);
        }

        // store comments, replies & comments likes/dislikes
        if ($request->type == 'comment') {

            BlogComment::create([
                'blog_id' => $request->blog_id,
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);

            // blog comments and replies
            $blog = Blog::with('comments')->find($request->blog_id);
            $blog_comments_and_replies = view('front.blog-comments-and-replies', compact('blog'))->render();

            return response()->json([
                'status' => 1, 
                'blog_comments_and_replies' => $blog_comments_and_replies, 
                'message' => 'Review has been posted successfully.'
            ]);
        } else if ($request->type == 'reply') {
            BlogCommentReply::create([
                'blog_comment_id' => $request->blog_comment_id,
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);

            // blog comments and replies
            $blog = Blog::with('comments')->find($request->blog_id);
            $blog_comments_and_replies = view('front.blog-comments-and-replies', compact('blog'))->render();

            return response()->json([
                'status' => 1, 
                'blog_comments_and_replies' => $blog_comments_and_replies,
                'message' => 'Reply has been posted successfully.'
            ]);
        } else if ($request->type == 'comment_like' || $request->type == 'comment_dislike') {
            BlogCommentLike::updateOrCreate(
                [
                    'blog_comment_id' => $request->blog_comment_id,
                    'user_id' => $user->id,
                ],
                [
                    'like' => $request->type == 'comment_like' ? 1 : 0,
                    'dislike' => $request->type == 'comment_dislike' ? 1 : 0,
                ]
            );

            // blog comments and replies
            $blog = Blog::with('comments')->find($request->blog_id);
            $blog_comments_and_replies = view('front.blog-comments-and-replies', compact('blog'))->render();

            return response()->json([
                'status' => 1, 
                'blog_comments_and_replies' => $blog_comments_and_replies,
                'message' => ''
            ]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong please try again later.']);
        }
    }

    public function compareMobile($from='', $to='')
    {
        if ($from != '') {
            $from_mobile = Product::whereStatus(1)->whereSlug($from)->with('attributes', 'comments')->first();
        } else {
            $from_mobile = '';
        }

        if ($to != '') {
            $to_mobile = Product::whereStatus(1)->whereSlug($to)->with('attributes', 'comments')->first();
        } else {
            $to_mobile = '';
        }

        // trending products
        $trending_products = Product::whereStatus(1)
            ->whereHas('trendingCategory', function($query) {
                $query->where('name', 'Trending');
            })
            ->with('trendingCategory', 'galleries')
            ->latest()
            ->get();

        $compare_from_products = Product::whereStatus(1)->latest()->get();
        $compare_to_products = Product::whereStatus(1)->latest()->get();

        if ($from) {
            $compare_to_products = $compare_to_products->where('slug', '!=', $from);
            $compareFromProductName = Product::whereSlug($from)->whereStatus(1)->first('name');
        } else {
            $compareFromProductName = '';
        }

        if ($to) {
            $compare_from_products = $compare_from_products->where('slug', '!=', $to);
            $compareToProductName = Product::whereSlug($to)->whereStatus(1)->first('name');
        } else {
            $compareToProductName = '';
        }

        $meta = MetaDetail::wherePage('compare_mobiles')->first();

        if ($meta) {
            $seoData = [
                'title' => ($from_mobile->meta_title ?? 'Mobile 1') . ' vs ' . ($to_mobile->meta_title ?? 'Mobile 2'),
                'description' => ($from_mobile->meta_description ?? 'Mobile 1') . ' vs ' . ($to_mobile->meta_description ?? 'Mobile 2'),
                'keywords' => ($from_mobile->meta_keywords ?? 'Mobile 1') . ' vs ' . ($to_mobile->meta_keywords ?? 'Mobile 2'),
                'h1' => ($from_mobile->h1 ?? 'Mobile 1') . ' vs ' . ($from_mobile->h1 ?? 'Mobile 2'),
            ];
        } else {
            $seoData = [];
        }

        return view('front.compare-page', compact('from_mobile', 'to_mobile', 'compare_from_products', 'compare_to_products', 'from', 'to', 'trending_products', 'seoData', 'compareFromProductName', 'compareToProductName'));
    }

    public function phoneFiner()
    {
        $brands = Brand::latest()->get(['id', 'name']);
        $meta = MetaDetail::wherePage('phone_finder')->first();
        $phoneFinerCustomization = PhoneFinderCustomization::find(1);

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.phone-finder', compact('brands', 'seoData', 'phoneFinerCustomization'));
    }

    public function filterMobile(Request $request)
    {
        $products = Product::query();

        if ($request->min_price != '' && $request->max_price != '') {
            $products->whereBetween('original_price', [(int) $request->min_price, (int) $request->max_price]);
        }

        if ($request->brand != '') {
            $products->where('brand_id', $request->brand);
        }

        if ($request->status != '') {
            $products->where('availability_status', $request->status);
        }

        if ($request->ram != '') {
            $products->where('ram', 'like', '%' . $request->ram . '%');
        }

        if ($request->processor != '') {
            $products->where('processor', 'like', '%' . $request->processor . '%');
        }

        if ($request->main_camera != '') {
            $products->where('main_camera', 'like', '%' . $request->main_camera . '%');
        }

        if ($request->front_camera != '') {
            $products->where('front_camera', 'like', '%' . $request->front_camera . '%');
        }

        if ($request->battery != '') {
            $products->where('battery', 'like', '%' . $request->battery . '%');
        }

        if ($request->storage != '') {
            $products->where('storage', 'like', '%' . $request->storage . '%');
        }

        if ($request->budget != '') {
            $products->where('original_price', '<=', (int) $request->budget);

            // meta details by budget
            $meta = MetaDetail::wherePage($request->budget)->first();

            if ($meta) {
                $seoData = [
                    'title' => $meta->meta_title ?? 'Default Title',
                    'description' => $meta->meta_description ?? 'Default description',
                    'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                    'h1' => $meta->h1 ?? 'Default H1',
                ];
            } else {
                $seoData = [];
            }
        } else {
            $seoData = [];
        }

        $products = $products->whereStatus(1)
        ->with('galleries')
        ->orderBy('publish_date', 'desc')
        ->paginate(12); // Pagination with 15 items per page


        return view('front.filter-mobile', compact('products', 'seoData'));
    }

    public function searchMobile(Request $request)
    {
        if ($request->name != '') {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->name . '%')
                ->whereStatus(1)
                ->with('galleries')
                ->orderBy('publish_date', 'desc')
                ->latest()
                ->limit(30)
                ->get();

            $search = $request->name;

            return view('front.search-mobile', compact('products', 'search'));
        } else {
            return redirect()->back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function searchProduct(Request $request)
    {
        if (!empty($request->search)) {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->search . '%')->limit(8)->latest()->get();
            if ($products && count($products) > 0) {
                $productsHtml = '';
                foreach ($products as $product) {
                    $imageUrl = '';
                    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                        $imageUrl = asset('uploads/products/' . $product->image);
                    } else {
                        $imageUrl = 'https://via.placeholder.com/300x100.png?text=No+Image';
                    }
                    $productsHtml .= '<a href="' . route('product.details', $product->slug) . '" class="card text-center mb-0 px-0 text-decoration-none  border border-1 border-black border-opacity-25" style="width: 130px; height: 160px;">';
                    $productsHtml .= '<img class="card-img-top p-2 mb-0" style="object-fit: contain; height: 100px;" src="' . $imageUrl . '" alt="' . ($product->alt_image ?: 'placeholder image') . '" width="4vw">';
                    $productsHtml .= '<div class="card-body">';
                    $productsHtml .= '<p class="card-title fw-bold mb-0 footer-link-size text-dark  ">' . ucfirst($product->name) . '</p>';
                    $productsHtml .= '</div>';
                    $productsHtml .= '</a>';
                }
                return response()->json(['status' => 1, 'products' => $productsHtml]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return response()->json(['status' => 2]);
        }
    }
    
    public function searchProductResponsive(Request $request)
    {
        if (!empty($request->search)) {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->search . '%')->limit(5)->latest()->get();
            if ($products && count($products) > 0) {
                $productsHtml = '';
                foreach ($products as $product) {
                    $imageUrl = '';
                    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                        $imageUrl = asset('uploads/products/' . $product->image);
                    } else {
                        $imageUrl = 'https://via.placeholder.com/300x100.png?text=No+Image';
                    }
                    $productsHtml .= '<a href="' . route('product.details', $product->slug) . '" class="text-decoration-none row p-2 border border-black border-opacity-75">';
                    $productsHtml .= '<div class="col-3 d-flex justify-content-center">';
                    $productsHtml .= '<img src="' . $imageUrl . '" style="width:60%;">';
                    $productsHtml .= '</div>';
                    $productsHtml .= '<div class="col-9 d-flex align-items-center">';
                    $productsHtml .= '<p class="fw-semibold text-dark form-placeholder">' . ucfirst($product->name) . '</p>';
                    $productsHtml .= '</div>';
                    $productsHtml .= '</a>';
                }
                return response()->json(['status' => 1, 'products' => $productsHtml]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return response()->json(['status' => 2]);
        }
    }
    
    public function searchProductCompareFrom(Request $request)
    {
        if (!empty($request->search)) {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->search . '%')->where('slug', '!=', $request->compare_to)->limit(5)->latest()->get();
            if ($products && count($products) > 0) {
                $productsHtml = '';
                foreach ($products as $product) {
                    $imageUrl = '';
                    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                        $imageUrl = asset('uploads/products/' . $product->image);
                    } else {
                        $imageUrl = 'https://via.placeholder.com/300x100.png?text=No+Image';
                    }
                    $productsHtml .= '<a href="'. route('compare-page', ['from' => $product->slug, 'to' => $request->compare_to]) .'" class="row p-2 border border-black border-opacity-75 text-decoration-none">';
                    $productsHtml .= '<div class="col-3 d-flex justify-content-center">';
                    $productsHtml .= '<img src="' . $imageUrl . '" style="width:40%;">';
                    $productsHtml .= '</div>';
                    $productsHtml .= '<div class="col-9 d-flex align-items-center">';
                    $productsHtml .= '<p class="fw-semibold text-dark form-placeholder">' . ucfirst($product->name) . '</p>';
                    $productsHtml .= '</div>';
                    $productsHtml .= '</a>';
                }
                return response()->json(['status' => 1, 'products' => $productsHtml]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return response()->json(['status' => 2]);
        }
    }
    
    public function searchProductCompareTo(Request $request)
    {
        if (!empty($request->search)) {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->search . '%')->where('slug', '!=', $request->compare_from)->limit(5)->latest()->get();
            if ($products && count($products) > 0) {
                $productsHtml = '';
                foreach ($products as $product) {
                    $imageUrl = '';
                    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                        $imageUrl = asset('uploads/products/' . $product->image);
                    } else {
                        $imageUrl = 'https://via.placeholder.com/300x100.png?text=No+Image';
                    }
                    $productsHtml .= '<a href="'. route('compare-page', ['from' => $request->compare_from, 'to' => $product->slug]) .'" class="row p-2 border border-black border-opacity-75 text-decoration-none">';
                    $productsHtml .= '<div class="col-3 d-flex justify-content-center">';
                    $productsHtml .= '<img src="' . $imageUrl . '" style="width:40%;">';
                    $productsHtml .= '</div>';
                    $productsHtml .= '<div class="col-9 d-flex align-items-center">';
                    $productsHtml .= '<p class="fw-semibold text-dark form-placeholder">' . ucfirst($product->name) . '</p>';
                    $productsHtml .= '</div>';
                    $productsHtml .= '</a>';
                }
                return response()->json(['status' => 1, 'products' => $productsHtml]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return response()->json(['status' => 2]);
        }
    }
    
    public function searchMobileForComparing(Request $request)
    {
        if (!empty($request->search)) {
            $products = Product::whereStatus(1)->where('name', 'like', '%' . $request->search . '%')->where('slug', '!=', $request->compare_from)->limit(5)->latest()->get();
            if ($products && count($products) > 0) {
                $productsHtml = '';
                foreach ($products as $product) {
                    $imageUrl = '';
                    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                        $imageUrl = asset('uploads/products/' . $product->image);
                    } else {
                        $imageUrl = 'https://via.placeholder.com/300x100.png?text=No+Image';
                    }
                    $productsHtml .= '<a target="_blank" href="'. route('compare-page', ['from' => $request->compare_from, 'to' => $product->slug]) .'" class="row p-2 border border-black border-opacity-75 text-decoration-none">';
                    $productsHtml .= '<div class="col-3 d-flex justify-content-center">';
                    $productsHtml .= '<img src="' . $imageUrl . '" style="width:40%;">';
                    $productsHtml .= '</div>';
                    $productsHtml .= '<div class="col-9 d-flex align-items-center">';
                    $productsHtml .= '<p class="fw-semibold text-dark form-placeholder">' . ucfirst($product->name) . '</p>';
                    $productsHtml .= '</div>';
                    $productsHtml .= '</a>';
                }
                return response()->json(['status' => 1, 'products' => $productsHtml]);
            } else {
                return response()->json(['status' => 0]);
            }
        } else {
            return response()->json(['status' => 2]);
        }
    }

    public function privacyPolicy()
    {
        $meta = MetaDetail::wherePage('privacy_policy')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.privacy-policy', compact('seoData'));
    }

    public function termCondition()
    {
        $meta = MetaDetail::wherePage('terms_and_conditions')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.term-condition', compact('seoData'));
    }

    public function contactUs()
    {
        $meta = MetaDetail::wherePage('contact_us')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.contact-us', compact('seoData'));
    }

    public function contactStore(StoreContactMessageRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        // send email to website owner
        $website = SiteSetting::first('contact_email');

        $data['subject']    = $request->subject;
        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;
        $data['message']    = $request->message;

        if ($website) {
            Mail::to($website->contact_email)->send(new ContactFormMail($data));
            
        }

        ContactMessage::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Email has been sent successfully.',
        ]);
    }

    public function productPictures($slug)
    {
        $product = Product::whereStatus(1)->whereSlug($slug)->first();

        if (!$product) {
            return redirect()->back()->with('info', 'Product not found!');
        }

        $pictures = ProductGallery::whereProductId($product->id)->get();

        $seoData = [
            'title' => 'Pictures - ' . $product->meta_title ?? 'Default Title',
            'description' => 'Pictures - ' . $product->meta_description ?? 'Default description',
            'keywords' => 'Pictures - ' . $product->meta_keywords ?? 'Default, Keywords',
            'h1' => 'Pictures - ' . $product->h1 ?? 'Default H1',
        ];

        return view('front.product-pictures', compact('pictures', 'seoData', 'product'));
    }

    public function notificationEmailStore(Request $request)
    {
        $emailExist = NotificationEmail::where('email', $request->email)->exists();

        if (!$emailExist) {
            NotificationEmail::create(['email' => $request->email]);
        }

        return response()->json(['message' => 'Email stored successfully!']);
    }

    public function webStoryIndex()
    {
        $web_story_categories = WebStoryCategory::whereHas('webStories')->withCount('webStories')->latest()->get();

        $meta = MetaDetail::wherePage('web_stories')->first();

        if ($meta) {
            $seoData = [
                'title' => $meta->meta_title ?? 'Default Title',
                'description' => $meta->meta_description ?? 'Default description',
                'keywords' => $meta->meta_keywords ?? 'Default, Keywords',
                'h1' => $meta->h1 ?? 'Default H1',
            ];
        } else {
            $seoData = [];
        }

        return view('front.web-stories.index', compact('web_story_categories', 'seoData'));
    }

    public function webStory($slug)
    {
        $category = WebStoryCategory::whereSlug($slug)->first();

        if (!$category) {
            return redirect()->back()->with('info', 'Story not found!');
        }
        $stories = WebStory::whereWebStoryCategoryId($category->id)->get();

        $seoData = [
            'title' => $category->meta_title ?? 'Default Title',
            'description' => $category->meta_description ?? 'Default description',
            'keywords' => $category->meta_keywords ?? 'Default, Keywords',
            'h1' => $category->h1 ?? 'Default H1',
        ];

        return view('front.web-stories.detail', compact('stories', 'seoData', 'category'));
    }

    public function productStory($slug)
    {
        $product = Product::whereStatus(1)->whereSlug($slug)->with('galleries')->first();

        if (!$product) {
            return redirect()->back()->with('info', 'Story not found!');
        }

        return view('front.product-story', compact('product'));
    }
}
