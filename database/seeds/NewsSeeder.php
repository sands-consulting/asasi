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

        $news1 = NewsService::create(new News, [
            'title' => 'ASASI 1.0',
            'content' => "<p>ASASI 1.0 was developed by Sands Consulting.</p>",
            'summary' => 'ASASI is released to the world.',
            'category_id' => NewsCategory::first()->id,
            'organization_id' => Organization::first()->id,
            'status' => 'published'
        ]);

        $news2 = NewsService::create(new News, [
            'title' => 'ASASI 1.1',
            'content' => '<p>ASASI 1.1 was released to address some bugs and adding new features.</p>',
            'summary' => 'ASASI 1.1 seen the lights.',
            'category_id' => NewsCategory::first()->id,
            'organization_id' => Organization::first()->id,
            'status' => 'published'
        ]);
    }
}
