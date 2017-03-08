<?php

use App\Banner;
use App\Organization;
use App\News;
use App\NewsCategory;
use App\Permission;
use App\Role;
use App\Services\BannerRepository;
use App\Services\NewsService;
use App\Services\NewsCategoryService;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_categories')->truncate();
        DB::table('banners')->truncate();
        DB::table('news')->truncate();

        $news_categories = [
            [
                'name' => 'Announcement'
            ]
        ];

        foreach($news_categories as $category)
        {
            NewsCategoryService::create(new NewsCategory, $category);
        }

        $news = NewsService::create(new News, [
            'title' => 'PROMPT 1.0',
            'content' => "<p>This is PROMPT 1.0 developed by Sands Consulting",
            'category_id' => NewsCategory::first()->id,
            'organization_id' => Organization::first()->id,
            'status' => 'published'
        ]);
    }
}
