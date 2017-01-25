<?php

namespace App\Http\Controllers\Admin;

use App\Place;
use App\DataTables\PlacesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\PlaceRequest;
use App\Services\PlacesService;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index(PlacesDataTable $table)
    {
        return $table->render('admin.places.index');
    }

    public function create(Request $request)
    {
        return view('admin.places.create', ['place' => new Place]);
    }

    public function store(PlaceRequest $request)
    {
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id');
        $place  = PlacesService::create(new Place, $inputs);
        return redirect()
            ->route('admin.places.show', $place->id)
            ->with('notice', trans('places.notices.created', ['name' => $place->name]));
    }

    public function show(Place $place)
    {
        return view('admin.places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('admin.places.edit', compact('place'));
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id');
        $place  = PlacesService::update($place, $inputs);
        return redirect()
            ->route('admin.places.show', $place->id)
            ->with('notice', trans('places.notices.updated', ['name' => $place->name]));
    }

    public function destroy(Place $place)
    {
        PlacesService::delete($place);
        return redirect()
            ->route('admin.places.index')
            ->with('notice', trans('places.notices.deleted', ['name' => $place->name]));
    }

    public function logs(Place $place, PlaceLogsDataTable $table)
    {
        $table->setActionable($place);
        return $table->render('admin.places.logs', compact('place'));
    }

    public function revisions(Place $place, RevisionsDataTable $table)
    {
        $table->setRevisionable($place);
        return $table->render('admin.places.revisions', compact('place'));
    }

    public function activate(Request $request, Place $place)
    {
        PlacesService::activate($place);
        return redirect()
            ->to($request->input('redirect_to', route('admin.places.show', $place->id)))
            ->with('notice', trans('places.notices.activated', ['name' => $place->name]));
    }

    public function deactivate(Request $request, Place $place)
    {
        PlacesService::deactivate($place);
        return redirect()
            ->to($request->input('redirect_to', route('admin.places.show', $place->id)))
            ->with('notice', trans('places.notices.deactivated', ['name' => $place->name]));
    }
}
