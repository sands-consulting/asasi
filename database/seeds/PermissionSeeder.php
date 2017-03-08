<?php

use App\Permission;
use App\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'System Administrator. Should be able to do everything.',
            ]
        ];

        foreach ($roles as $roleData) {
            RoleService::create(new Role(), $roleData);
        }

        $users = [
            [
                'name'      => 'Super Admin',
                'email'     => 'admin@example.com',
                'password'  => 'admin123',
                'status'    => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            UserService::create(new User(), $userData);
        }

        DB::table('permissions')->truncate();

        $permissions = [
            // Access
            ['access', 'access:portal', 'Access portal'],
            ['access', 'access:admin', 'Access admin area'],
            ['access', 'access:report', 'Access reporting module'],
            ['access', 'access:vendor', 'Access vendor module'],

            // Allocation
            ['allocation', 'allocation:index', 'List all allocations'],
            ['allocation', 'allocation:show', 'View allocation details'],
            ['allocation', 'allocation:create', 'Create new allocation'],
            ['allocation', 'allocation:update', 'Update existing allocation'],
            ['allocation', 'allocation:delete', 'Delete existing allocation'],
            ['allocation', 'allocation:activate', 'Activate allocation'],
            ['allocation', 'allocation:deactivate', 'Deactivate allocation'],
            ['allocation', 'allocation:revisions', 'View allocation revisions'],
            ['allocation', 'allocation:logs', 'View allocation logs'],
            ['allocation', 'allocation:organization', 'Allow to manage allocation with organization'],

            // Allocation Type
            ['allocation-type', 'allocation-type:index', 'List all allocation types'],
            ['allocation-type', 'allocation-type:show', 'View allocation type details'],
            ['allocation-type', 'allocation-type:create', 'Create new allocation type'],
            ['allocation-type', 'allocation-type:update', 'Update existing allocation type'],
            ['allocation-type', 'allocation-type:delete', 'Delete existing allocation type'],
            ['allocation-type', 'allocation-type:activate', 'Activate allocation type'],
            ['allocation-type', 'allocation-type:deactivate', 'Deactivate allocation type'],
            ['allocation-type', 'allocation-type:revisions', 'View allocation type revisions'],
            ['allocation-type', 'allocation-type:logs', 'View allocation type logs'],

            // Banner
            ['banner', 'banner:index', 'List all banners'],
            ['banner', 'banner:show', 'View a banner'],
            ['banner', 'banner:create', 'Create new banner'],
            ['banner', 'banner:update', 'Update existing banner'],
            ['banner', 'banner:delete', 'Delete existing banner'],
            ['banner', 'banner:publish', 'Publish a banner'],
            ['banner', 'banner:unpublish', 'Unpublish a banner'],
            ['banner', 'banner:revisions', 'View banner revisions'],
            ['banner', 'banner:logs', 'View banner logs'],

            // Evaluator
            ['evaluator', 'evaluator:index', 'List of evaluator\'s.'],
            ['evaluator', 'evaluator:create', 'Assign evaluator to notice.'],
            ['evaluator', 'evaluator:edit', 'Assign evaluator to notice.'],
            ['evaluator', 'evaluator:delete', "Delete notice evaluator."],
            ['evaluator', 'evaluator:assign', 'Assign evaluator to submission.'],
            ['evaluator', 'evaluator:revisions', 'View evaluator revisions'],
            ['evaluator', 'evaluator:logs', 'View evaluator logs'],

            // News
            ['news', 'news:index', 'List all news'],
            ['news', 'news:show', 'View a news'],
            ['news', 'news:create', 'Create new news'],
            ['news', 'news:update', 'Update existing news'],
            ['news', 'news:delete', 'Delete exisiting news'],
            ['news', 'news:publish', 'Publish existing news'],
            ['news', 'news:unpublish', 'Unpublish existing news'],
            ['news', 'news:revisions', 'View news revisions'],
            ['news', 'news:logs', 'View news logs'],
            ['news', 'news:organization', 'Allow to manage news within user organization'],
            // News Category
            ['news-category', 'news-category:index', 'List all news categories'],
            ['news-category', 'news-category:show', 'View a news category'],
            ['news-category', 'news-category:create', 'Create new news category'],
            ['news-category', 'news-category:update', 'Update existing news category'],
            ['news-category', 'news-category:duplicate', 'Duplicate existing new category'],
            ['news-category', 'news-category:delete', 'Delete existing news category'],
            ['news-category', 'news-category:activate', 'Activate news category'],
            ['news-category', 'news-category:deactivate', 'Deactivate news category'],
            ['news-category', 'news-category:revisions', 'View news category revisions'],
            ['news-category', 'news-category:logs', 'View news category logs'],

            // Notice
            ['notice', 'notice:index', 'List all notices'],
            ['notice', 'notice:show', 'View a notice'],
            ['notice', 'notice:create', 'Create new notice'],
            ['notice', 'notice:update', 'Update existing notice'],
            ['notice', 'notice:duplicate', 'Duplicate existing notice'],
            ['notice', 'notice:activate', 'Activate existing notice'],
            ['notice', 'notice:deactivate', 'Deactivate existing notice'],
            ['notice', 'notice:cancel', 'Cancel existing notice'],
            ['notice', 'notice:publish', 'Publish existing notice'],
            ['notice', 'notice:unpublish', 'Unpublish existing notice'],
            ['notice', 'notice:delete', 'Delete existing notice'],
            ['notice', 'notice:revisions', 'View notice revisions'],
            ['notice', 'notice:logs', 'View notice logs'],

            // Notice Category
            ['notice-category', 'notice-category:index', 'List all notice categories'],
            ['notice-category', 'notice-category:show', 'View a notice category'],
            ['notice-category', 'notice-category:create', 'Create new notice category'],
            ['notice-category', 'notice-category:update', 'Update existing notice category'],
            ['notice-category', 'notice-category:duplicate', 'Duplicate existing notice category'],
            ['notice-category', 'notice-category:activate', 'Activate existing notice category'],
            ['notice-category', 'notice-category:deactivate', 'Deactivate existing notice category'],
            ['notice-category', 'notice-category:delete', 'Delete existing notice category'],
            ['notice-category', 'notice-category:revisions', 'View notice category revisions'],
            ['notice-category', 'notice-category:logs', 'View notice category logs'],

            // Notice Event
            ['notice-event', 'notice-event:index', 'List all notice events'],
            ['notice-event', 'notice-event:show', 'View a notice event'],
            ['notice-event', 'notice-event:create', 'Create new notice event'],
            ['notice-event', 'notice-event:update', 'Update existing notice event'],
            ['notice-event', 'notice-event:duplicate', 'Duplicate existing notice event'],
            ['notice-event', 'notice-event:activate', 'Activate existing notice event'],
            ['notice-event', 'notice-event:deactivate', 'Deactivate existing notice event'],
            ['notice-event', 'notice-event:delete', 'Delete existing notice event'],
            ['notice-event', 'notice-event:revisions', 'View notice event revisions'],
            ['notice-event', 'notice-event:logs', 'View notice event logs'],

            // Notice Event Type
            ['notice-event-type', 'notice-event-type:index', 'List all notice event types'],
            ['notice-event-type', 'notice-event-type:show', 'View a notice event type'],
            ['notice-event-type', 'notice-event-type:create', 'Create new notice event type'],
            ['notice-event-type', 'notice-event-type:update', 'Update existing notice event type'],
            ['notice-event-type', 'notice-event-type:duplicate', 'Duplicate existing notice event type'],
            ['notice-event-type', 'notice-event-type:activate', 'Activate existing notice event type'],
            ['notice-event-type', 'notice-event-type:deactivate', 'Deactivate existing notice event type'],
            ['notice-event-type', 'notice-event-type:delete', 'Delete existing notice event type'],
            ['notice-event-type', 'notice-event-type:revisions', 'View notice event type revisions'],
            ['notice-event-type', 'notice-event-type:logs', 'View notice event type logs'],

            // Notice Type
            ['notice-type', 'notice-type:index', 'List all notice types'],
            ['notice-type', 'notice-type:show', 'View a notice type'],
            ['notice-type', 'notice-type:create', 'Create new notice type'],
            ['notice-type', 'notice-type:update', 'Update existing notice type'],
            ['notice-type', 'notice-type:duplicate', 'Duplicate existing notice type'],
            ['notice-type', 'notice-type:activate', 'Activate existing notice type'],
            ['notice-type', 'notice-type:deactivate', 'Deactivate existing notice type'],
            ['notice-type', 'notice-type:delete', 'Delete existing notice type'],
            ['notice-type', 'notice-type:revisions', 'View notice type revisions'],
            ['notice-type', 'notice-type:logs', 'View notice type logs'],

            // Organization
            ['organization', 'organization:index', 'List all organization'],
            ['organization', 'organization:show', 'View organization details'],
            ['organization', 'organization:create', 'Create new organization'],
            ['organization', 'organization:update', 'Update existing organization'],
            ['organization', 'organization:duplicate', 'Duplicate existing organization'],
            ['organization', 'organization:activate', 'Activate an organization'],
            ['organization', 'organization:deactivate', 'Deactivate an organization'],
            ['organization', 'organization:suspend', 'Suspend an organization'],
            ['organization', 'organization:delete', 'Delete existing organization'],
            ['organization', 'organization:revisions', 'View organization revisions'],
            ['organization', 'organization:logs', 'View organization logs'],

            // Package
            ['package', 'package:index', 'List all packages'],
            ['package', 'package:show', 'View a package'],
            ['package', 'package:create', 'Create new package'],
            ['package', 'package:update', 'Update existing package'],
            ['package', 'package:duplicate', 'Duplicate existing package'],
            ['package', 'package:activate', 'Activate existing package'],
            ['package', 'package:deactivate', 'Deactivate existing package'],
            ['package', 'package:delete', 'Delete existing package'],
            ['package', 'package:revisions', 'View package revisions'],
            ['package', 'package:logs', 'View package logs'],

            // Payment Gateway
            ['payment-gateway', 'payment-gateway:index', 'List all payment gateways'],
            ['payment-gateway', 'payment-gateway:show', 'View payment gateway details'],
            ['payment-gateway', 'payment-gateway:create', 'Create new payment gateway'],
            ['payment-gateway', 'payment-gateway:update', 'Update existing payment gateway'],
            ['payment-gateway', 'payment-gateway:delete', 'Delete existing payment gateway'],
            ['payment-gateway', 'payment-gateway:activate', 'Activate payment gateway'],
            ['payment-gateway', 'payment-gateway:deactivate', 'Deactivate payment gateway'],
            ['payment-gateway', 'payment-gateway:revisions', 'View payment gateway revisions'],
            ['payment-gateway', 'payment-gateway:logs', 'View payment gateway logs'],

            // Permission
            ['permission', 'permission:index', 'List all permissions'],
            ['permission', 'permission:show', 'View permission details'],
            ['permission', 'permission:create', 'Create new permission'],
            ['permission', 'permission:update', 'Update existing permission'],
            ['permission', 'permission:delete', 'Delete existing permission'],
            ['permission', 'permission:revisions', 'View all permissions'],
            ['permission', 'permission:histories', 'View all permissions'],

            // Place
            ['place', 'place:index', 'List all places'],
            ['place', 'place:show', 'View place details'],
            ['place', 'place:create', 'Create new place'],
            ['place', 'place:update', 'Update existing place'],
            ['place', 'place:duplicate', 'Duplicate existing place'],
            ['place', 'place:activate', 'Activate existing place'],
            ['place', 'place:deactivate', 'Deactivate existing place'],
            ['place', 'place:delete', 'Delete existing place'],
            ['place', 'place:revisions', 'View place revisions'],
            ['place', 'place:logs', 'View place logs'],
            // Project
            ['project', 'project:index', 'List all projects'],
            ['project', 'project:show', 'View project details'],
            ['project', 'project:create', 'Create new project'],
            ['project', 'project:update', 'Update existing project'],
            ['project', 'project:delete', 'Delete existing project'],
            ['project', 'project:activate', 'Activate project'],
            ['project', 'project:deactivate', 'Deactivate project'],
            ['project', 'project:revisions', 'View project revisions'],
            ['project', 'project:logs', 'View project logs'],
            ['project', 'project:organization', 'Allow to manage project with organization'],
            // Project Milestone
            ['project-milestone', 'project-milestone:index', 'List all project milstones'],
            ['project-milestone', 'project-milestone:show', 'View project milstone details'],
            ['project-milestone', 'project-milestone:create', 'Create new project milstone'],
            ['project-milestone', 'project-milestone:update', 'Update existing project milstone'],
            ['project-milestone', 'project-milestone:delete', 'Delete existing project milstone'],
            ['project-milestone', 'project-milestone:activate', 'Activate project milstone'],
            ['project-milestone', 'project-milestone:deactivate', 'Deactivate project milstone'],
            ['project-milestone', 'project-milestone:revisions', 'View project milstone revisions'],
            ['project-milestone', 'project-milestone:logs', 'View project milstone logs'],
            [
                'project-milestone',
                'project-milestone:organization',
                'Allow to manage project milstone with organization',
            ],

            // Qualification Code
            ['qualification-code', 'qualification-code:index', 'List all qualification codes'],
            ['qualification-code', 'qualification-code:show', 'View qualification code details'],
            ['qualification-code', 'qualification-code:create', 'Create new qualification code'],
            ['qualification-code', 'qualification-code:update', 'Update existing qualification code'],
            ['qualification-code', 'qualification-code:delete', 'Delete existing qualification code'],
            ['qualification-code', 'qualification-code:activate', 'Activate qualification code'],
            ['qualification-code', 'qualification-code:deactivate', 'Deactivate qualification code'],
            ['qualification-code', 'qualification-code:revisions', 'View qualification code revisions'],
            ['qualification-code', 'qualification-code:logs', 'View qualification code logs'],

            // Qualification Type
            ['qualification-type', 'qualification-type:index', 'List all qualification code types'],
            ['qualification-type', 'qualification-type:show', 'View qualification code type details'],
            ['qualification-type', 'qualification-type:create', 'Create new qualification code type'],
            ['qualification-type', 'qualification-type:update', 'Update existing qualification code type'],
            ['qualification-type', 'qualification-type:delete', 'Delete existing qualification code type'],
            ['qualification-type', 'qualification-type:activate', 'Activate qualification code type'],
            ['qualification-type', 'qualification-type:deactivate', 'Deactivate qualification code type'],
            ['qualification-type', 'qualification-type:revisions', 'View qualification code type revisions'],
            ['qualification-type', 'qualification-type:logs', 'View qualification code type logs'],

            // Role
            ['role', 'role:index', 'List all roles'],
            ['role', 'role:show', 'View role details'],
            ['role', 'role:create', 'Create new role'],
            ['role', 'role:update', 'Update existing role'],
            ['role', 'role:delete', 'Delete existing role'],
            ['role', 'role:revisions', 'View role revisions'],
            ['role', 'role:histories', 'View role histories'],

            // Settings
            ['setting', 'setting:index', 'List all settings'],
            ['setting', 'setting:show', 'View a setting'],
            ['setting', 'setting:create', 'Create new setting'],
            ['setting', 'setting:update', 'Update existing setting'],
            ['setting', 'setting:delete', 'Delete existing setting'],
            ['setting', 'setting:revisions', 'View setting revisions'],
            ['setting', 'setting:logs', 'View setting logs'],

            // Submission Requirement
            ['submission-requirement', 'submission-requirement:index', 'List all submission requirements'],
            ['submission-requirement', 'submission-requirement:show', 'View submission requirement details'],
            ['submission-requirement', 'submission-requirement:create', 'Create new submission requirement'],
            ['submission-requirement', 'submission-requirement:update', 'Update existing submission requirement'],
            ['submission-requirement', 'submission-requirement:delete', 'Delete existing submission requirement'],
            ['submission-requirement', 'submission-requirement:revisions', 'View submission requirement revisions'],
            ['submission-requirement', 'submission-requirement:logs', 'View submission requirement logs'],
            [
                'submission-requirement',
                'submission-requirement:organization',
                'Allow to manage submission requirement with organization',
            ],

            // submission
            ['submission', 'submission:index', 'List all submissions'],
            ['submission', 'submission:show', 'View submission details'],
            ['submission', 'submission:create', 'Create new submission'],
            ['submission', 'submission:update', 'Update existing submission'],
            ['submission', 'submission:delete', 'Delete existing submission'],
            ['submission', 'submission:revisions', 'View submission revisions'],
            ['submission', 'submission:logs', 'View submission logs'],
            ['submission', 'submission:organization', 'Allow to manage submission with organization'],

            // submission-detail
            ['submission-detail', 'submission-detail:show', 'View submission details'],
            ['submission-detail', 'submission-detail:create', 'Create new submission details'],
            ['submission-detail', 'submission-detail:update', 'Update existing submission details'],
            ['submission-detail', 'submission-detail:delete', 'Delete existing submission details'],
            ['submission-detail', 'submission-detail:activate', 'Activate submission details'],
            ['submission-detail', 'submission-detail:deactivate', 'Deactivate submission details'],
            ['submission-detail', 'submission-detail:revisions', 'View submission details revisions'],
            ['submission-detail', 'submission-detail:logs', 'View submission details logs'],

            // Subscription
            ['subscription', 'subscription:index', 'List all subscriptions'],
            ['subscription', 'subscription:show', 'View a subscription'],
            ['subscription', 'subscription:create', 'Create new subscription'],
            ['subscription', 'subscription:update', 'Update existing subscription'],
            ['subscription', 'subscription:duplicate', 'Duplicate existing subscription'],
            ['subscription', 'subscription:activate', 'Activate existing subscription'],
            ['subscription', 'subscription:deactivate', 'Deactivate existing subscription'],
            ['subscription', 'subscription:cancel', 'Cancel existing subscription'],
            ['subscription', 'subscription:delete', 'Delete existing subscription'],
            ['subscription', 'subscription:revisions', 'View subscription revisions'],
            ['subscription', 'subscription:logs', 'View subscription logs'],

            // User
            ['user', 'user:index', 'List all users'],
            ['user', 'user:show', 'View user details'],
            ['user', 'user:create', 'Create new user'],
            ['user', 'user:update', 'Update existing user'],
            ['user', 'user:delete', 'Delete existing user'],
            ['user', 'user:restore', 'Restore deleted user'],
            ['user', 'user:revisions', 'View user revisions'],
            ['user', 'user:histories', 'View user histories'],
            ['user', 'user:duplicate', 'Duplicate existing user'],
            ['user', 'user:activate', 'Activate a user'],
            ['user', 'user:suspend', 'Suspend a user'],
            ['user', 'user:assume', 'Login as another user'],
            ['user-blacklist', 'user-blacklist:index', 'List all user blacklist'],
            ['user-blacklist', 'user-blacklist:show', 'View blacklist details'],
            ['user-blacklist', 'user-blacklist:create', 'Blacklist a user'],
            ['user-blacklist', 'user-blacklist:update', 'Update user blacklist'],
            ['user-blacklist', 'user-blacklist:delete', 'Delete existing user blacklist'],
            ['user-blacklist', 'user-blacklist:duplicate', 'Duplicate a blacklist'],
            ['user-blacklist', 'user-blacklist:revisions', 'View blacklist revisions'],
            ['user-blacklist', 'user-blacklist:histories', 'View blacklist histories'],

            // Vendor
            ['vendor', 'vendor:index', 'List all vendors'],
            ['vendor', 'vendor:show', 'View vendor details'],
            ['vendor', 'vendor:create', 'Create new vendor'],
            ['vendor', 'vendor:update', 'Update existing vendor'],
            ['vendor', 'vendor:duplicate', 'Duplicate existing vendor'],
            ['vendor', 'vendor:approve', 'Approve vendor\'s applications'],
            ['vendor', 'vendor:reject', 'Reject vendor\'s applications'],
            ['vendor', 'vendor:activate', 'Activate suspended vendor'],
            ['vendor', 'vendor:suspend', 'Suspend existing vendor'],
            ['vendor', 'vendor:blacklist', 'Blacklist existing vendor'],
            ['vendor', 'vendor:unblacklist', 'Unblacklist existing vendor'],
            ['vendor', 'vendor:delete', 'Delete existing vendor'],
            ['vendor', 'vendor:revisions', 'View vendor revisions'],
            ['vendor', 'vendor:logs', 'View vendor logs'],

            // Vendor Type
            ['vendor-type', 'vendor-type:index', 'List all vendor types'],
            ['vendor-type', 'vendor-type:show', 'View vendor type details'],
            ['vendor-type', 'vendor-type:create', 'Create new vendor type'],
            ['vendor-type', 'vendor-type:update', 'Update existing vendor type'],
            ['vendor-type', 'vendor-type:duplicate', 'Duplicate existing vendor type'],
            ['vendor-type', 'vendor-type:activate', 'Activate existing vendor type'],
            ['vendor-type', 'vendor-type:deactivate', 'Deactivate existing vendor type'],
            ['vendor-type', 'vendor-type:delete', 'Delete existing vendor type'],
            ['vendor-type', 'vendor-type:revisions', 'View vendor type revisions'],
            ['vendor-type', 'vendor-type:logs', 'View vendor type logs'],
        ];


        $roles = [
            [
                'name'         => 'vendor',
                'display_name' => 'Vendor',
                'description'  => 'Vendor.',
            ],
            [
                'name'         => 'vendor-admin',
                'display_name' => 'Vendor Admin',
                'description'  => 'Vendor Admin.',
            ],
        ];

        foreach ($roles as $roleData) {
            $role = RoleService::create(new Role(), $roleData);
            $role->permissions()->attach(Permission::where('name', 'access:portal')->first()->id);
            $role->permissions()->attach(Permission::where('name', 'access:cart')->first()->id);
        }

        foreach ($permissions as $permission) {
            $perm = PermissionService::create(new Permission, [
                'group'       => $permission[0],
                'name'        => $permission[1],
                'description' => $permission[2],
            ]);
            if ($action != 'organization') {
                $perm->roles()->attach(Role::first());
            }
        }

        User::find(1)->roles()->attach(Role::first());
    }
}
