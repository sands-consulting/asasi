<?php

namespace App\Http\Controllers\Admin;

use App\Place;
use App\DataTables\PlacesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\PlaceRequest;
use App\Services\PlaceService;
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
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id', 'status');
        $place = PlaceService::create(new Place, $inputs);
        return redirect()
            ->route('admin.places.edit', $place->id)
            ->with('notice', trans('places.notices.created', ['name' => $place->name]));
    }

    public function edit(Place $place)
    {
        return view('admin.places.edit', compact('place'));
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id', 'status');
        $place = PlaceService::update($place, $inputs);
        return redirect()
            ->route('admin.places.edit', $place->id)
            ->with('notice', trans('places.notices.updated', ['name' => $place->name]));
    }

    public function destroy(Place $place)
    {
        PlaceService::delete($place);
        return redirect()
            ->route('admin.places.index')
            ->with('notice', trans('places.notices.deleted', ['name' => $place->name]));
    }

    public function histories(Place $place, PlaceLogsDataTable $table)
    {
        $table->setActionable($place);
        return $table->render('admin.places.histories', compact('place'));
    }

    public function revisions(Place $place, RevisionsDataTable $table)
    {
        $table->setRevisionable($place);
        return $table->render('admin.places.revisions', compact('place'));
    }
}
