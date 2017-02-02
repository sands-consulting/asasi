<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Organization;
use App\DataTables\NewsDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\NewsRequest;
use App\Services\NewsService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request, NewsDataTable $table)
    {
        $table->setUser($request->user());
        return $table->render('admin.news.index');
    }

    public function create(Request $request)
    {
        return view('admin.news.create', ['news' => new News]);
    }

    public function store(NewsRequest $request)
    {
        $inputs = $request->only('title', 'content', 'category_id');

        if($request->user()->hasPermission('news:organization')) {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        } else {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        $news   = NewsService::create(new News, $inputs);
        UserHistoriesService::log($request->user(), 'create', $news, $request->getClientIp());
        return redirect()
            ->route('admin.news.edit', $news->slug)
            ->with('notice', trans('news.notices.created', ['title' => $news->title]));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $inputs = $request->only('title', 'content', 'category_id');

        if($request->user()->hasPermission('news:organization'))
        {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        }
        else
        {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        NewsService::update($news, $inputs);
        UserHistoriesService::log($request->user(), 'update', $news, $request->getClientIp());
        return redirect()
            ->route('admin.news.edit', $news->id)
            ->with('notice', trans('news.notices.updated', ['title' => $news->title]));
    }

    public function destroy(Request $request, News $news)
    {
        NewsService::delete($news);
        UserHistoriesService::log($request->user(), 'delete', $news, $request->getClientIp());
        return redirect()
            ->route('admin.news.index')
            ->with('notice', trans('news.notices.deleted', ['title' => $news->title]));
    }

    public function histories(News $news, UserHistoriesDataTable $table)
    {
        $table->setActionable($news);
        return $table->render('admin.news.histories', compact('news'));
    }

    public function revisions(News $news, RevisionsDataTable $table)
    {
        $table->setRevisionable($news);
        return $table->render('admin.news.revisions', compact('news'));
    }

    public function publish(Request $request, News $news)
    {
        NewsService::publish($news);
        UserHistoriesService::log($request->user(), 'publish', $news, $request->getClientIp());
        return redirect($request->input('redirect_to', route('admin.news.edit', $news->slug)))
                ->with('notice', trans('news.notices.published', ['title' => $news->title]));
    }

    public function unpublish(Request $request, News $news)
    {
        NewsService::unpublish($news);
        UserHistoriesService::log($request->user(), 'unpublish', $news, $request->getClientIp());
        return redirect($request->input('redirect_to', route('admin.news.edit', $news->slug)))
                ->with('notice', trans('news.notices.unpublished', ['title' => $news->title]));
    }
}
