<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Admin Dashboard';
        return view('pages.dashboard.index', compact('page_title', 'page_description'));
    }
}
