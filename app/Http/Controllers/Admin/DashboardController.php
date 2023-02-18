<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.dashboard');
    }
    public function page1()
    {
        return view('admin.page1');
    }
    public function myprofile()
    {
        return view('admin.myprofile');
    }
    public function setting()
    {
        return view('admin.setting');
    }
}
