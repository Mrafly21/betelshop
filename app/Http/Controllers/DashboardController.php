<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $todayDate = Carbon::now()->format('d-m-Y');
        $timeNow = Carbon::now()->timezone('Asia/Jakarta')->format('H:i');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        return view('admin.index', compact('todayDate', 'timeNow', 'thisMonth', 'thisYear'));
    }
}
