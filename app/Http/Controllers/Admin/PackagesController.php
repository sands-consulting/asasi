<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\DataTables\PackagesDataTable;
use App\Http\Requests\PackageRequest;
use App\Services\PackagesService;
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
        $package = PackagesService::create(new Package, $inputs);

        return redirect()
            ->route('admin.packages.show', $package->id)
            ->with('notice', trans('packages.notices.created', ['name' => $package->name]));
    }

    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(PackageRequest $request, Package $package)
    {
        $inputs = $request->all();

        $package = PackagesService::update($package, $inputs);

        if ($roles = $request->get('roles', [])) {
            $package->roles()->sync($roles);
        }

        return redirect()
            ->route('admin.packages.edit', $package->id)
            ->with('notice', trans('packages.notices.updated', ['name' => $package->name]));
    }

    public function duplicate(Package $package)
    {
        $package->name = $package->name . '-' . str_random(4);
        $package = PackagesService::duplicate($package);
        return redirect()
            ->action('PackagesController@edit', $package->getSlug())
            ->with('success', trans('packages.created', ['name' => $package->name]));
    }

    public function destroy(Package $package)
    {
        PackagesService::delete($package);
        return redirect()
            ->route('admin.packages.index')
            ->with('notice', trans('packages.notices.deleted', ['name' => $package->name]));
    }

    public function logs(Package $package, PackageLogsDataTable $table)
    {
        $table->setActionable($package);
        return $table->render('admin.packages.logs', compact('package'));
    }

    public function activate(Request $request, Package $package)
    {
        PackagesService::activate($package);
        return redirect()
            ->to($request->input('redirect_to', route('admin.packages.show', $package->id)))
            ->with('notice', trans('packages.notices.activated', ['name' => $package->name]));
    }

    public function deactivate(Request $request, Package $package)
    {
        PackagesService::deactivate($package);
        return redirect()
            ->to($request->input('redirect_to', route('admin.packages.show', $package->id)))
            ->with('notice', trans('packages.notices.deactivated', ['name' => $package->name]));
    }
}
