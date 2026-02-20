<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\GoogleController;
use App\Http\Controllers\Front\FacebookController;
use App\Http\Controllers\Front\SiteMapController;
use App\Http\Controllers\Front\RSSController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::get('/', 'HomeController@login')->name('mylogin');
// Route::get('/', 'HomeController@dashboard')->name('dashboard')->middleware('auth');

// sitemap
Route::get('/sitemap.xml', [SiteMapController::class, 'generate'])->name('sitemap');
// rss
Route::get('/sitemap.rss', [RSSController::class, 'generateRSS'])->name('generate.sitemap-rss');

// home
Route::get('/', 'HomeController@index')->name('home');

// product by brand
Route::get('/brand/{slug}', 'HomeController@productByBrand')->name('product-by.brand');

// google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// blogs
Route::get('/blogs', 'HomeController@blogIndex')->name('blogs');
Route::get('/blog/details/{slug}', 'HomeController@blogDetail')->name('blog-details');
Route::post('/blog/post-comments', 'HomeController@blogPostComment')->name('blog.post-comment');

// upcoming
Route::get('/upcoming-mobiles', 'HomeController@upcomingMobile')->name('upcoming.mobiles');

// popular
Route::get('/popular-mobiles', 'HomeController@popularMobile')->name('popular.mobiles');

// latest / trending
Route::get('/latest-mobiles', 'HomeController@latestMobile')->name('latest.mobiles');

// compare
Route::get('/compare/{from?}/{to?}', 'HomeController@compareMobile')
    ->where('from', '[^/]+')  // Matches any character except '/'
    ->where('to', '[^/]+')    // Matches any character except '/'
    ->name('compare-page');
Route::get('/search-product-compare-from', 'HomeController@searchProductCompareFrom')->name('search.product-compare-from');
Route::get('/search-product-compare-to', 'HomeController@searchProductCompareTo')->name('search.product-compare-to');

// phone finder
Route::get('/phone-finder', 'HomeController@phoneFiner')->name('phone-finder');

// filter mobile
Route::get('/filter-mobile', 'HomeController@filterMobile')->name('filter-mobile');

// privacy policy
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');

// terms conditions
Route::get('/terms-conditions', 'HomeController@termCondition')->name('terms-conditions');

// header mobiles search
Route::post('/search-product', 'HomeController@searchProduct')->name('search.product');
Route::get('/search-product-responsive', 'HomeController@searchProductResponsive')->name('search.product-responsive');
Route::get('/search', 'HomeController@searchMobile')->name('search.mobile');

// contact us
Route::get('/contact-us', 'HomeController@contactUs')->name('contact');
Route::post('/contact-store', 'HomeController@contactStore')->name('contact.store');

// saving user's email for notification
Route::post('/notification-email/store', 'HomeController@notificationEmailStore')->name('notification.email.store');

// save for notification
Route::post('/save-subscription', 'NotificationController@saveSubscription')->name('save-subscription');
Route::post('/send-push-notification', 'NotificationController@sendPushNotificationToAll')->name('send-push-notification');

// web stories
Route::get('web-stories', 'HomeController@webStoryIndex')->name('web-stories');
Route::get('web-story/{slug}', 'HomeController@webStory')->name('web-story.detail');

// product detail
Route::get('{slug}/story', 'HomeController@productStory')->name('product.story');
Route::get('{slug}/pictures', 'HomeController@productPictures')->name('product.pictures');
Route::post('/product/post-comments', 'HomeController@productPostComment')->name('product.post-comment');
Route::get('/search-mobile-for-compare', 'HomeController@searchMobileForComparing')->name('search.mobile-for-comparing');
Route::get('/{slug}', 'HomeController@productDetail')->name('product.details');
