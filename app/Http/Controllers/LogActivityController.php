<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(LogActivity::select('*'))
                ->make(true);
        }
        return view('log_activity.index');
    }
}
