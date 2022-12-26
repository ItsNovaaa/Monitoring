<?php

namespace App\Http\Controllers;

use App\Models\RequestKendaraan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonitoringController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(RequestKendaraan::RequestKendaraan())
                ->editColumn('status', function($data) {
                    $html = "";
                    if ($data->status == 1) {
                        $html = '<button type="button" class="badge badge-success">Ready</button>';
                    } else if ($data->status == 0) {
                        $html = '<button type="button" class="badge badge-warning">Booking</button>';
                    }
                    return $html;
                })
                ->editColumn('status_unit', function($data) {
                    $html = "";
                    if ($data->status == 1) {
                        $html = '<button type="button" class="badge badge-success">Ready</button>';
                    } else if ($data->status == 0) {
                        $html = '<button type="button" class="badge badge-warning">Use</button>';
                    } else {
                        $html = '<button type="button" class="badge badge-danger">Broken</button>';
                    }
                    return $html;
                })
                ->rawColumns(['_', 'status', 'status_unit'])
                ->make(true);
        }
        return view('monitoring.index');
    }
}
