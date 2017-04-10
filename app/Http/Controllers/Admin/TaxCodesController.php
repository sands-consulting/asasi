<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TaxCodesDataTable;
use App\Services\TaxCodeService;
use App\TaxCode;
use Illuminate\Http\Request;

class TaxCodesController extends Controller
{
    public function index(TaxCodesDataTable $table)
    {
        return $table->render('admin.tax-codes.index');
    }

    public function create()
    {
        $tax_code = new TaxCode;

        return view('admin.tax-codes.create', compact('tax_code'));
    }

    public function store(Request $request)
    {
        $input = $request->only('name', 'code', 'rate');
        $tax_code = TaxCodeService::create(new TaxCode, $input);

        return redirect()
            ->route('admin.tax-codes.edit', $tax_code->id)
            ->with('notice', trans('tax-codes.notices.stored'));
    }

    public function edit(TaxCode $tax_code)
    {
        return view('admin.tax-codes.edit', compact('tax_code'));
    }

    public function update(Request $request, TaxCode $tax_code)
    {
        $input = $request->only('name', 'code', 'rate');
        TaxCodeService::update($tax_code, $input);

        return redirect()
            ->back()
            ->with('notice', trans('tax-codes.notices.updated'));
    }
}
