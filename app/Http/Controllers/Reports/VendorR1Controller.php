<?php

namespace App\Http\Controllers\Reports;

use App\Vendor;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorR1Controller extends Controller
{
    public function index()
    {
        return view('reports.vendor.r1.index');
    }

    public function view(Request $request)
    {
        $data = $this->query($request->input('date_start'), $request->input('date_end'));
        $data->total = $this->querySum($request->input('date_start'), $request->input('date_end'));
        $params = $request->only('date_start', 'date_end');
        $date_start = Carbon::parse($request->input('date_start'))->startOfDay();
        $date_end = $request->input('date_end') ? Carbon::parse($request->input('date_end'))->startOfDay() : null;
        return view('reports.vendor.r1.view', compact('data', 'params', 'date_start', 'date_end'));
    }

    public function excel(Request $request)
    {
        $data = $this->query($request->input('date_start'), $request->input('date_end'));
        $data->total = $this->querySum($request->input('date_start'), $request->input('date_end'));
        \Excel::create('Vendor Masterdata', function ($excel) use ($data) {
            $excel->sheet('Report', function ($sheet) use ($data) {
                $sheet->loadView('reports.vendor.r1.excel')
                        ->with('data', $data);
            });
        })->export('xlsx');
    }

    public function query($start, $end)
    {
        $start  = Carbon::parse($start)->startOfDay()->toDateTimeString();
        $end    = !empty($end) ? Carbon::parse($end)->endOfDay()->toDateTimeString() : Carbon::parse($start)->endOfDay()->toDateTimeString();

        return Vendor::whereBetween('created_at', [$start, $end])
            ->select('status', \DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();
    }

    public function querySum($start, $end)
    {
        $start  = Carbon::parse($start)->startOfDay()->toDateTimeString();
        $end    = !empty($end) ? Carbon::parse($end)->endOfDay()->toDateTimeString() : Carbon::parse($start)->endOfDay()->toDateTimeString();

        $vendor = Vendor::whereBetween('created_at', [$start, $end])
            ->select('status', \DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        return $vendor->sum('count');
    }
}
