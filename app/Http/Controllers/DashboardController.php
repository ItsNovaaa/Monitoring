<?php

namespace App\Http\Controllers;

use App\Models\RequestKendaraan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return RequestKendaraan::DashboardRequestKendaraan()->get();
        }
        return view('dashboard.index');
    }
}
