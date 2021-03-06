<?php

namespace App\Http\Controllers\Admin;

use App\NewsCategory;
use App\DataTables\NewsCategoriesDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\NewsCategoryRequest;
use App\Services\NewsCategoryService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class NewsCategoriesController extends Controller
{
    public function index(Request $request, NewsCategoriesDataTable $table)
    {
        return $table->render('admin.news-categories.index');
    }

    public function create(Request $request)
    {
        return view('admin.news-categories.create', ['category' => new NewsCategory]);
    }

    public function store(NewsCategoryRequest $request)
    {
        $inputs     = $request->only('name', 'status');
        $category = NewsCategoryService::create(new NewsCategory, $inputs);
        UserHistoryService::log($request->user(), 'create', $category, $request->getClientIp());
        return redirect()
            ->route('admin.news-categories.edit', $category->slug)
            ->with('notice', trans('news-categories.notices.created', ['name' => $category->name]));
    }

    public function edit(NewsCategory $category)
    {
        return view('admin.news-categories.edit', compact('category'));
    }

    public function update(NewsCategoryRequest $request, NewsCategory $category)
    {
        $inputs = $request->only('name', 'status');
        NewsCategoryService::update($category, $inputs);
        UserHistoryService::log($request->user(), 'update', $category, $request->getClientIp());
        return redirect()
            ->route('admin.news-categories.edit', $category->slug)
            ->with('notice', trans('news-categories.notices.updated', ['name' => $category->name]));
    }

    public function destroy(Request $request, NewsCategory $category)
    {
        NewsCategoryService::delete($category);
        UserHistoryService::log($request->user(), 'delete', $category, $request->getClientIp());
        return redirect()
            ->route('admin.news-categories.index')
            ->with('notice', trans('news-categories.notices.deleted', ['name' => $category->name]));
    }

    public function histories(NewsCategory $category, UserHistoriesDataTable $table)
    {
        $table->setActionable($category);
        return $table->render('admin.news-categories.histories', compact('category'));
    }

    public function revisions(NewsCategory $category, RevisionsDataTable $table)
    {
        $table->setRevisionable($category);
        return $table->render('admin.news-categories.revisions', compact('category'));
    }
}
