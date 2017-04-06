<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\DataTables\PackagesDataTable;
use App\Http\Requests\PackageRequest;
use App\Services\PackageService;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(PackagesDataTable $table)
    {
        return $table->render('admin.packages.index');
    }

    public function create(Request $request)
    {
        return view('admin.packages.create', ['package' => new Package]);
    }

    public function store(PackageRequest $request)
    {
        $inputs  = $request->all();
        $package = PackageService::create(new Package, $inputs);

        return redirect()
            ->route('admin.packages.edit', $package->id)
            ->with('notice', trans('packages.notices.created', ['name' => $package->name]));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(PackageRequest $request, Package $package)
    {
        $inputs = $request->all();

        $package = PackageService::update($package, $inputs);

        return redirect()
            ->route('admin.packages.edit', $package->id)
            ->with('notice', trans('packages.notices.updated', ['name' => $package->name]));
    }

    public function duplicate(Package $package)
    {
        $package->name = $package->name . '-' . str_random(4);
        $package = PackageService::duplicate($package);
        return redirect()
            ->action('PackagesController@edit', $package->getSlug())
            ->with('success', trans('packages.created', ['name' => $package->name]));
    }

    public function destroy(Package $package)
    {
        PackageService::delete($package);
        return redirect()
            ->route('admin.packages.index')
            ->with('notice', trans('packages.notices.deleted', ['name' => $package->name]));
    }

    public function histories(Package $package, PackageLogsDataTable $table)
    {
        $table->setActionable($package);
        return $table->render('admin.packages.histories', compact('package'));
    }
}
