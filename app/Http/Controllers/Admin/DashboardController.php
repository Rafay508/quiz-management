<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Admin Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $adminCount = Admin::count();
        $userCount = User::count();
        $productCount = 1;
        $blogCount = 5;

        return view('admin.dashboard.index', compact('adminCount', 'userCount', 'productCount', 'blogCount'));
    }

    public function crm()
    {
        return view('admin.crm');
    }

    public function forms()
    {
        return view('admin.forms');
    }
}
