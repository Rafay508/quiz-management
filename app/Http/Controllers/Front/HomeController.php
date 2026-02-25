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
        return view('front.index');
    }

    public function quizIndex()
    {
        return view('front.quizzes');
    }
}
