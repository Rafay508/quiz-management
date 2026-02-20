<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Blog;
use App\Models\WebStoryCategory;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use DB;
use Illuminate\Support\Facades\Cache;

class SiteMapController extends Controller
{
    public function generate()
    {
        $cacheKey = 'sitemap_index';

        // Check if the sitemap is already cached
        if (Cache::has($cacheKey)) {
            return response(Cache::get($cacheKey))->header('Content-Type', 'text/xml');
        }

        $sitemapUrls = [];

        // Sitemap for General
        $generalSitemap = Sitemap::create();

        $urls = [
            env('APP_URL'),
            env('APP_URL') . 'blogs',
            env('APP_URL') . 'upcoming-mobiles',
            env('APP_URL') . 'popular-mobiles',
            env('APP_URL') . 'phone-finder',
            env('APP_URL') . 'contact-us',
            env('APP_URL') . 'compare',
            env('APP_URL') . 'privacy-policy',
            env('APP_URL') . 'terms-conditions',
            env('APP_URL') . 'browse-by-budget',
            env('APP_URL') . 'web-stories',
        ];

        foreach ($urls as $url) {
            $generalSitemap->add(Url::create($url));
        }

        $generalSitemap->writeToFile(public_path('general_sitemap.xml'));
        $sitemapUrls[] = url('/general_sitemap.xml');

        // Create a sitemap for products
        $productSitemap = Sitemap::create();
        $products = Product::all();
        foreach ($products as $product) {
            $url = url(env('APP_URL') . $product->slug);
            $productSitemap->add(Url::create($url)->setLastModificationDate($product->updated_at)); 
            // Canonical URL
        }
        $productSitemap->writeToFile(public_path('product_sitemap.xml'));
        $sitemapUrls[] = url('/product_sitemap.xml');

        // Create a sitemap for brands
        $brandSitemap = Sitemap::create();
        $brands = Brand::all();
        foreach ($brands as $brand) {
            $url = url(env('APP_URL') . "brand/{$brand->slug}");
            $brandSitemap->add(Url::create($url)->setLastModificationDate($brand->updated_at)); // Canonical URL
        }
        $brandSitemap->writeToFile(public_path('brand_sitemap.xml'));
        $sitemapUrls[] = url('/brand_sitemap.xml');

        // sitemap for blogs
        $blogsSitemap = Sitemap::create();
        $bloges = Blog::all();
        foreach ($bloges as $blog) {
            $url = url(env('APP_URL') . "blog/details/{$blog->slug}");
            $blogsSitemap->add(Url::create($url)->setLastModificationDate($blog->updated_at));
        }
        $blogsSitemap->writeToFile(public_path('news_sitemap.xml'));
        $sitemapUrls[] = url('/news_sitemap.xml');

        // Sitemap for Comparisons
        $comparisonSitemap = Sitemap::create();
        $comparisonProducts = Product::latest()->get();

        foreach ($comparisonProducts as $product1) {
            foreach ($comparisonProducts->shuffle()->take(30) as $product2) {
                // Skip comparison with itself
                if ($product1->id != $product2->id) {
                    $url = url("compare/{$product1->slug}/{$product2->slug}");
                    $comparisonSitemap->add(Url::create($url)->setLastModificationDate($product1->updated_at));
                }
            }
        }

        // Sitemap for browse by budget
        $budgetSitemap = Sitemap::create();
        $budgets = [10000, 15000, 25000, 35000, 45000, 65000, 85000];

        foreach ($budgets as $budget) {
            $url = url(env('APP_URL') . "filter-mobile?budget={$budget}");
            $budgetSitemap->add(Url::create($url)->setLastModificationDate(now()));
        }

        $budgetSitemap->writeToFile(public_path('budget_sitemap.xml'));
        $sitemapUrls[] = url('/budget_sitemap.xml');

        $comparisonSitemap->writeToFile(public_path('comparisons_sitemap.xml'));
        $sitemapUrls[] = url('/comparisons_sitemap.xml');

        // Gallery Sitemap with custom format
        // Fetch images from the products, blogs, and brands tables
        $productImages = DB::table('products')->pluck('image')->toArray();
        $blogImages = DB::table('blogs')->pluck('image')->toArray();
        $brandImages = DB::table('brands')->pluck('image')->toArray();

        // Combine all images into a single array, with source information
        $galleryImagesNew = [];

        // Add 'products' images with correct directory path
        foreach ($productImages as $image) {
            if ($image != '') {
                $galleryImagesNew[] = 'uploads/products/' . basename($image);  // Prepend the 'uploads/products/' for product images
            }
        }

        // Add 'blogs' images with correct directory path
        foreach ($blogImages as $image) {
            if ($image != '') {
                $galleryImagesNew[] = 'uploads/blogs/' . basename($image);  // Prepend the 'uploads/blogs/' for blog images
            }
        }

        // Add 'brands' images with correct directory path
        foreach ($brandImages as $image) {
            if ($image != '') {
                $galleryImagesNew[] = 'uploads/brands/' . basename($image);  // Prepend the 'uploads/blogs/' for blog images
            }
        }

        // Start the XML for the sitemap
        $gallerySitemapXML = '<?xml version="1.0" encoding="UTF-8"?>';
        $gallerySitemapXML .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $gallerySitemapXML .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Loop through the images and add them to the sitemap
        foreach ($galleryImagesNew as $image) {
            // Correct URL concatenation: Use rtrim() to remove any trailing slashes from the base URL
            // and ltrim() to remove any leading slashes from the relative image path
            $imageUrl = url(rtrim(env('APP_URL'), '/') . '/' . ltrim($image, '/'));

            // Add image details to the XML
            $gallerySitemapXML .= '<url>';
            $gallerySitemapXML .= '<loc>' . htmlspecialchars($imageUrl) . '</loc>';
            $gallerySitemapXML .= '<image:image>';
            $gallerySitemapXML .= '<image:loc>' . htmlspecialchars($imageUrl) . '</image:loc>';
            $gallerySitemapXML .= '</image:image>';
            $gallerySitemapXML .= '</url>';
        }

        // Close the XML tags
        $gallerySitemapXML .= '</urlset>';

        // Write the gallery sitemap to file
        file_put_contents(public_path('gallery_sitemap.xml'), $gallerySitemapXML);

        // Add the sitemap URL to the sitemap URLs array (optional)
        $sitemapUrls[] = url('/gallery_sitemap.xml');

        // Create a sitemap for web stories
        $webStorySitemap = Sitemap::create();
        $web_stories = WebStoryCategory::whereHas('webStories')->get();
        foreach ($web_stories as $story) {
            $url = url(env('APP_URL') . "web-story/{$story->slug}");
            $webStorySitemap->add(Url::create($url)->setLastModificationDate($story->updated_at)); // Canonical URL
        }
        $webStorySitemap->writeToFile(public_path('web_story_sitemap.xml'));
        $sitemapUrls[] = url('/web_story_sitemap.xml');

        // Create the sitemap index XML
        $sitemapIndexXML = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapIndexXML .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($sitemapUrls as $sitemapUrl) {
            $sitemapIndexXML .= '<sitemap>';
            $sitemapIndexXML .= '<loc>' . $sitemapUrl . '</loc>';
            $sitemapIndexXML .= '</sitemap>';
        }
        $sitemapIndexXML .= '</sitemapindex>';

        // Cache the sitemap index for 6 hours
        Cache::put($cacheKey, $sitemapIndexXML, now()->addHours(6));

        return response($sitemapIndexXML)->header('Content-Type', 'text/xml');
    }
}
