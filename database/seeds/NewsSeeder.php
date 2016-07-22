<?php

use App\Banner;
use App\News;
use App\NewsCategory;
use App\Repositories\BannerRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsCategoryRepository;
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
        DB::table('news')->truncate();
        DB::table('news_category')->truncate();
        DB::table('banners')->truncate();

        $permissions = [
            ['news:index',                  'List all news'],
            ['news:show',                   'View a news'],
            ['news:create',                 'Create new news'],
            ['news:update',                 'Update existing news'],
            ['news:delete',                 'Delete exisiting news'],
            ['news:publish',                'Publish existing news'],
            ['news:unpublish',              'Unpublish existing news'],
            ['news:index:organization',     'List all news by organization'],

            ['news_category:index',         'List all news categories'],
            ['news_category:show',          'View a news category'],
            ['news_category:create',        'Create new news category'],
            ['news_category:update',        'Update existing news category'],
            ['news_category:delete',        'Delete existing news category'],

            ['banner:index',                'List all banners'],
            ['banner:show',                 'View a banner'],
            ['banner:create',               'Create new banner'],
            ['banner:update',               'Update existing banner'],
            ['banner:delete',               'Delete existing banner'],
            ['banner:publish',              'Publish a banner'],
            ['banner:unpublish',            'Unpublish a banner'],
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        $news_categories = [
            [
                'title' => 'News'
            ]
        ];

        foreach($news_categories as $category)
        {
            NewsCategoryRepository::create($category);
        }

        NewsRepository::create([
            'title' => 'PROMPT 1.0',
            'content' => "<p>This is PROMPT 1.0 developed by Sands Consulting",
            'category_id' => NewsCategory::first()->id;
        ]);
    }
}
