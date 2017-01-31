<?php

namespace App\Http\Controllers;

use App\Notice;
use App\DataTables\Portal\NoticesDataTable;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index(Request $request, NoticesDataTable $table)
    {
        return $table->render('notices.index');
    }

    public function show(Notice $notice)
    {
        $vendorAwarded = $notice->vendors()->awarded()->first();
        return view('notices.show', compact('notice', 'vendorAwarded'));
    }
}
