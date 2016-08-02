<?php

use App\Banner;
use App\Organization;
use App\News;
use App\NewsCategory;
use App\Permission;
use App\Role;
use App\Repositories\BannerRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\PermissionsRepository;
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

        $permissions = [
            ['news:index',                  'List all news'],
            ['news:show',                   'View a news'],
            ['news:create',                 'Create new news'],
            ['news:update',                 'Update existing news'],
            ['news:delete',                 'Delete exisiting news'],
            ['news:publish',                'Publish existing news'],
            ['news:unpublish',              'Unpublish existing news'],
            ['news:revisions',               'View news revisions'],
            ['news:logs',                   'View news logs'],
            ['news:organization',           'Allow to manage news within user organization'],

            ['news_category:index',         'List all news categories'],
            ['news_category:show',          'View a news category'],
            ['news_category:create',        'Create new news category'],
            ['news_category:update',        'Update existing news category'],
            ['news_category:duplicate',     'Duplicate existing new category'],
            ['news_category:delete',        'Delete existing news category'],
            ['news_category:activate',      'Activate news category'],
            ['news_category:deactivate',    'Deactivate news category'],
            ['news_category:revisions',     'View news category revisions'],
            ['news_category:logs',          'View news category logs'],

            ['banner:index',                'List all banners'],
            ['banner:show',                 'View a banner'],
            ['banner:create',               'Create new banner'],
            ['banner:update',               'Update existing banner'],
            ['banner:delete',               'Delete existing banner'],
            ['banner:publish',              'Publish a banner'],
            ['banner:unpublish',            'Unpublish a banner'],
            ['banner:revisions',            'View banner revisions'],
            ['banner:logs',                 'View banner logs']
        ];

        foreach ($permissions as $permissionData) {
            $perm = PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);

            if($perm->name != 'news:organization')
            {
                $perm->roles()->attach(Role::first());
            }
        }

        $news_categories = [
            [
                'name' => 'Announcement'
            ]
        ];

        foreach($news_categories as $category)
        {
            NewsCategoryRepository::create(new NewsCategory, $category);
        }

        $news = NewsRepository::create(new News, [
            'title' => 'PROMPT 1.0',
            'content' => "<p>This is PROMPT 1.0 developed by Sands Consulting",
            'category_id' => NewsCategory::first()->id,
            'organization_id' => Organization::first()->id,
            'status' => 'published'
        ]);
    }
}
