<?php

use App\Permission;
use App\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        $permissions = [
            /* 
             * Access Permissions
             */
            ['access:administration', 'Access administration area'],
            ['access:reports', 'Access reporting module'],
            ['access:settings', 'Access global settings'],
            ['access:vendor', 'Access vendor module'],

            /* 
             * Asasi Permissions
             */

            // News
            ['news:index', 'List all news'],
            ['news:show', 'View a news'],
            ['news:create', 'Create new news'],
            ['news:update', 'Update existing news'],
            ['news:delete', 'Delete exisiting news'],
            ['news:restore', 'Restore deleted news'],
            ['news:revisions', 'View all news revisions'],
            ['news:histories', 'View all news histories'],
            ['news:archives', 'List all deleted news'],
            ['news:duplicate', 'Duplicate existing news'],

            ['news:publish', 'Publish existing news'],
            ['news:unpublish', 'Unpublish existing news'],

            ['news:organization', 'Allow to manage news within user organization'],

            // News Category
            ['news-category:index', 'List all news categories'],
            ['news-category:show', 'View a news category'],
            ['news-category:create', 'Create new news category'],
            ['news-category:update', 'Update existing news categort'],
            ['news-category:delete', 'Delete exisiting news category'],
            ['news-category:restore', 'Restore deleted news category'],
            ['news-category:revisions', 'View all news category revisions'],
            ['news-category:histories', 'View all news category histories'],
            ['news-category:archives', 'List all deleted news categories'],
            ['news-category:duplicate', 'Duplicate existing news category'],

            // Organization
            ['organization:index', 'List all organization'],
            ['organization:show', 'View organization details'],
            ['organization:create', 'Create new organization'],
            ['organization:update', 'Update existing organization'],
            ['organization:delete', 'Delete existing organization'],
            ['organization:restore', 'Restore deleted organization'],
            ['organization:revisions', 'View organization revisions'],
            ['organization:histories', 'View organization histories'],
            ['organization:archives', 'List deleted organziations'],
            ['organization:duplicate', 'Duplicate existing organization'],

            // Package
            ['package:index', 'List all packages'],
            ['package:show', 'View package details'],
            ['package:create', 'Create new package'],
            ['package:update', 'Update existing package'],
            ['package:delete', 'Delete existing package'],
            ['package:restore', 'Restore deleted package'],
            ['package:revisions', 'View all package revisions'],
            ['package:histories', 'View all packages'],
            ['package:archives', 'List delete packages'],
            ['package:duplicate', 'Duplicate existing package'],

            // Permission
            ['permission:index', 'List all permissions'],
            ['permission:show', 'View permission details'],
            ['permission:create', 'Create new permission'],
            ['permission:update', 'Update existing permission'],
            ['permission:delete', 'Delete existing permission'],
            ['permission:restore', 'Restore deleted permission'],
            ['permission:revisions', 'View all permission revisions'],
            ['permission:histories', 'View all permissions'],
            ['permission:archives', 'List delete permissions'],
            ['permission:duplicate', 'Duplicate existing permission'],

            // Place
            ['place:index', 'List all places'],
            ['place:show', 'View place details'],
            ['place:create', 'Create new place'],
            ['place:update', 'Update existing place'],
            ['place:delete', 'Delete existing place'],
            ['place:restore', 'Restore deleted place'],
            ['place:revisions', 'View place revisions'],
            ['place:histories', 'View place histories'],
            ['place:archives', 'List deleted places'],
            ['place:duplicate', 'Duplicate existing place'],

            // Role
            ['role:index', 'List all roles'],
            ['role:show', 'View role details'],
            ['role:create', 'Create new role'],
            ['role:update', 'Update existing role'],
            ['role:delete', 'Delete existing role'],
            ['role:restore', 'Restore deleted role'],
            ['role:revisions', 'View role revisions'],
            ['role:histories', 'View role histories'],
            ['role:archives', 'List deleted roles'],
            ['role:duplicate', 'Duplicate existing role'],

            // Subscription
            ['subscription:index', 'List all subscriptions'],
            ['subscription:show', 'View a subscription'],
            ['subscription:create', 'Create new subscription'],
            ['subscription:update', 'Update existing subscription'],
            ['subscription:delete', 'Delete existing subscription'],
            ['subscription:restore', 'Restore deleted subscription'],
            ['subscription:revisions', 'View subscription revisions'],
            ['subscription:histories', 'View subscription histories'],
            ['subscription:archives', 'List all deleted subscriptions'],
            ['subscription:duplicate', 'Duplicate existing subscription'],
            
            ['subscription:activate', 'Activate existing subscription'],
            ['subscription:cancel', 'Cancel existing subscription'],

            // Tax Code
            ['tax-code:index', 'List all tax codes'],
            ['tax-code:show', 'View tax code details'],
            ['tax-code:create', 'Create new tax code'],
            ['tax-code:update', 'Update existing tax code'],
            ['tax-code:delete', 'Delete existing tax code'],
            ['tax-code:restore', 'Restore deleted tax code'],
            ['tax-code:revisions', 'View tax code revisions'],
            ['tax-code:histories', 'View tax code histories'],
            ['tax-code:archives', 'List deleted tax codes'],
            ['tax-code:duplicate', 'Duplicate tax code'],

            // Transaction
            ['transaction:index', 'List all transactions'],
            ['transaction:show', 'View transaction details'],
            ['transaction:create', 'Create new transaction'],
            ['transaction:update', 'Update existing transaction'],
            ['transaction:delete', 'Delete existing transaction'],
            ['transaction:restore', 'Restore deleted transaction'],
            ['transaction:revisions', 'View transaction revisions'],
            ['transaction:histories', 'View transaction histories'],
            ['transaction:archives', 'List deleted transaction'],
            ['transaction:duplicate', 'Duplicate transaction'],
            
            ['transaction:paid', 'Mark transaction as paid'],
            ['transaction:refund', 'Refund existing transaction'],
            ['transaction:cancel', 'Cancel existing transaction'],
            ['transaction:query', 'Query transaction information'],

            // User
            ['user:index', 'List all users'],
            ['user:show', 'View user details'],
            ['user:create', 'Create new user'],
            ['user:update', 'Update existing user'],
            ['user:delete', 'Delete existing user'],
            ['user:restore', 'Restore deleted user'],
            ['user:revisions', 'View user revisions'],
            ['user:histories', 'View user histories'],
            ['user:archives', 'List deleted users'],
            ['user:duplicate', 'Duplicate existing user'],
            
            ['user:activate', 'Activate a user'],
            ['user:suspend', 'Suspend a user'],
            ['user:assume', 'Login as another user'],

            // User Blacklist
            ['user-blacklist:index', 'List all user blacklists'],
            ['user-blacklist:show', 'View blacklist details'],
            ['user-blacklist:create', 'Blacklist a user'],
            ['user-blacklist:update', 'Update user blacklist'],
            ['user-blacklist:delete', 'Delete existing user blacklist'],
            ['user-blacklist:restore', 'Restore deleted user blacklist'],
            ['user-blacklist:revisions', 'View blacklist revisions'],
            ['user-blacklist:histories', 'View blacklist histories'],
            ['user-blacklist:archives', 'List deleted user blacklists'],
            ['user-blacklist:duplicate', 'Duplicate a blacklist'],

            /* 
             * Application Permissions
             */

            // Allocation
            ['allocation:index', 'List all allocations'],
            ['allocation:show', 'View allocation details'],
            ['allocation:create', 'Create new allocation'],
            ['allocation:update', 'Update existing allocation'],
            ['allocation:delete', 'Delete existing allocation'],
            ['allocation:restore', 'Restore deleted allocation'],
            ['allocation:revisions', 'View allocation revisions'],
            ['allocation:histories', 'View allocation histories'],
            ['allocation:archives', 'List all deleted allocations'],
            
            ['allocation:organization', 'Allow to manage allocation with organization'],

            // Allocation Type
            ['allocation-type:index', 'List all allocation types'],
            ['allocation-type:show', 'View allocation type details'],
            ['allocation-type:create', 'Create new allocation type'],
            ['allocation-type:update', 'Update existing allocation type'],
            ['allocation-type:delete', 'Delete existing allocation type'],
            ['allocation-type:activate', 'Activate allocation type'],
            ['allocation-type:deactivate', 'Deactivate allocation type'],
            ['allocation-type:revisions', 'View allocation type revisions'],
            ['allocation-type:histories', 'View allocation type histories'],

            // Evaluation
            ['evaluation:index', 'View list of notices assigned.'],
            ['evaluation:show', 'View evaluation details'],
            ['evaluation:update', 'Update evaluation details'],

            // Notice
            ['notice:index', 'List all notices'],
            ['notice:show', 'View a notice'],
            ['notice:create', 'Create new notice'],
            ['notice:update', 'Update existing notice'],
            ['notice:duplicate', 'Duplicate existing notice'],
            ['notice:activate', 'Activate existing notice'],
            ['notice:deactivate', 'Deactivate existing notice'],
            ['notice:cancel', 'Cancel existing notice'],
            ['notice:publish', 'Publish existing notice'],
            ['notice:unpublish', 'Unpublish existing notice'],
            ['notice:delete', 'Delete existing notice'],
            ['notice:revisions', 'View notice revisions'],
            ['notice:histories', 'View notice histories'],
            ['notice:purchase', 'Can purchase notice'],

            // Notice Category
            ['notice-category:index', 'List all notice categories'],
            ['notice-category:show', 'View a notice category'],
            ['notice-category:create', 'Create new notice category'],
            ['notice-category:update', 'Update existing notice category'],
            ['notice-category:duplicate', 'Duplicate existing notice category'],
            ['notice-category:activate', 'Activate existing notice category'],
            ['notice-category:deactivate', 'Deactivate existing notice category'],
            ['notice-category:delete', 'Delete existing notice category'],
            ['notice-category:revisions', 'View notice category revisions'],
            ['notice-category:histories', 'View notice category histories'],

            // Notice Event
            ['notice-event:index', 'List all notice events'],
            ['notice-event:show', 'View a notice event'],
            ['notice-event:create', 'Create new notice event'],
            ['notice-event:update', 'Update existing notice event'],
            ['notice-event:duplicate', 'Duplicate existing notice event'],
            ['notice-event:activate', 'Activate existing notice event'],
            ['notice-event:deactivate', 'Deactivate existing notice event'],
            ['notice-event:delete', 'Delete existing notice event'],
            ['notice-event:revisions', 'View notice event revisions'],
            ['notice-event:histories', 'View notice event histories'],

            // Notice Type
            ['notice-type:index', 'List all notice types'],
            ['notice-type:show', 'View a notice type'],
            ['notice-type:create', 'Create new notice type'],
            ['notice-type:update', 'Update existing notice type'],
            ['notice-type:duplicate', 'Duplicate existing notice type'],
            ['notice-type:activate', 'Activate existing notice type'],
            ['notice-type:deactivate', 'Deactivate existing notice type'],
            ['notice-type:delete', 'Delete existing notice type'],
            ['notice-type:revisions', 'View notice type revisions'],
            ['notice-type:histories', 'View notice type histories'],

            // Project
            ['project:index', 'List all projects'],
            ['project:show', 'View project details'],
            ['project:create', 'Create new project'],
            ['project:update', 'Update existing project'],
            ['project:delete', 'Delete existing project'],
            ['project:restore', 'Restore deleted project'],
            ['project:revisions', 'View project revisions'],
            ['project:histories', 'View project histories'],
            ['project:archives', 'List all deleted projects'],
            ['project:activate', 'Activate project'],
            ['project:suspend', 'Suspend project'],
            ['project:organization', 'Allow to manage project with organization'],

            // Project Milestone
            ['project-milestone:index', 'List all project milstones'],
            ['project-milestone:show', 'View project milstone details'],
            ['project-milestone:create', 'Create new project milstone'],
            ['project-milestone:update', 'Update existing project milstone'],
            ['project-milestone:delete', 'Delete existing project milstone'],
            ['project-milestone:activate', 'Activate project milstone'],
            ['project-milestone:deactivate', 'Deactivate project milstone'],
            ['project-milestone:revisions', 'View project milstone revisions'],
            ['project-milestone:histories', 'View project milstone histories'],
            ['project-milestone:organization', 'Allow to manage project milstone with organization'],

            // Qualification Code
            ['qualification-code:index', 'List all qualification codes'],
            ['qualification-code:show', 'View qualification code details'],
            ['qualification-code:create', 'Create new qualification code'],
            ['qualification-code:update', 'Update existing qualification code'],
            ['qualification-code:delete', 'Delete existing qualification code'],
            ['qualification-code:activate', 'Activate qualification code'],
            ['qualification-code:deactivate', 'Deactivate qualification code'],
            ['qualification-code:revisions', 'View qualification code revisions'],
            ['qualification-code:histories', 'View qualification code histories'],

            // Qualification Type
            ['qualification-type:index', 'List all qualification code types'],
            ['qualification-type:show', 'View qualification code type details'],
            ['qualification-type:create', 'Create new qualification code type'],
            ['qualification-type:update', 'Update existing qualification code type'],
            ['qualification-type:delete', 'Delete existing qualification code type'],
            ['qualification-type:activate', 'Activate qualification code type'],
            ['qualification-type:deactivate', 'Deactivate qualification code type'],
            ['qualification-type:revisions', 'View qualification code type revisions'],
            ['qualification-type:histories', 'View qualification code type histories'],

            // Submission
            ['submission:index', 'List all submissions'],
            ['submission:show', 'View submission details'],
            ['submission:create', 'Create new submission'],
            ['submission:update', 'Update existing submission'],
            ['submission:delete', 'Delete existing submission'],
            ['submission:revisions', 'View submission revisions'],
            ['submission:histories', 'View submission histories'],
            ['submission:organization', 'Allow to manage submission with organization'],

            // Vendor
            ['vendor:index', 'List all vendors'],
            ['vendor:show', 'View vendor details'],
            ['vendor:create', 'Create new vendor'],
            ['vendor:update', 'Update existing vendor'],
            ['vendor:duplicate', 'Duplicate existing vendor'],
            ['vendor:approve', 'Approve vendor\'s applications'],
            ['vendor:reject', 'Reject vendor\'s applications'],
            ['vendor:activate', 'Activate suspended vendor'],
            ['vendor:suspend', 'Suspend existing vendor'],
            ['vendor:delete', 'Delete existing vendor'],
            ['vendor:revisions', 'View vendor revisions'],
            ['vendor:histories', 'View vendor histories'],

            // Vendor Type
            ['vendor-type:index', 'List all vendor types'],
            ['vendor-type:show', 'View vendor type details'],
            ['vendor-type:create', 'Create new vendor type'],
            ['vendor-type:update', 'Update existing vendor type'],
            ['vendor-type:duplicate', 'Duplicate existing vendor type'],
            ['vendor-type:activate', 'Activate existing vendor type'],
            ['vendor-type:deactivate', 'Deactivate existing vendor type'],
            ['vendor-type:delete', 'Delete existing vendor type'],
            ['vendor-type:revisions', 'View vendor type revisions'],
            ['vendor-type:histories', 'View vendor type histories'],
        ];

        foreach($permissions as $perm)
        {
            PermissionService::create(new Permission, [
                'name' => $perm[0],
                'description' => $perm[1]
            ]);
        }

        $roles = [
            [
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'System Administrator. Should be able to do everything.',
            ],

            [
                'name'         => 'vendor-user',
                'display_name' => 'Vendor',
                'description'  => 'Access vendor portal.',
            ],
            [
                'name'         => 'vendor-admin',
                'display_name' => 'Vendor Admin',
                'description'  => 'Access vendor portal and manage vendor user',
            ],

            [
                'name'          => 'organization-admin',
                'display_name'  => 'Organization Admin',
                'description'   => 'Able to manage organization allocations, notices, projects and users.'
            ],
            [
                'name'          => 'notice-staff',
                'display_name'  => 'Notice Staff',
                'description'   => 'Manage organization notices.'
            ],
            [
                'name'          => 'finance-staff',
                'display_name'  => 'Finance Staff',
                'description'   => 'Manage organization allocations.'
            ],
            [
                'name'          => 'project-manager',
                'display_name'  => 'Project Manager',
                'description'   => 'Manage organization projects.'
            ],
            [
                'name'          => 'submission-evaluator',
                'display_name'  => 'Submission Evaluator',
                'description'   => 'Evaluation vendor notice submissions.',
            ]
        ];

        foreach ($roles as $roleData) {
            RoleService::create(new Role(), $roleData);
        }

        $admin = Role::whereName('admin')->first();
        $admin->permissions()->attach(Permission::whereNotIn('name', [
            'access:vendor',
            'permission:create',
            'permission:delete',
            'permission:restore',
            'news:organization',
            'allocation:organization',
            'project:organization',
            'project-milestone:organization',
            'submission:organization'
        ])->pluck('id')->toArray());

        $vendorAdmin = Role::whereName('vendor-admin')->first();
        $vendorAdmin->permissions()->attach(Permission::whereIn('name', [
            'access:vendor',
            'access:cart',
            'user:index',
            'user:show',
            'user:create',
            'user:update',
            'user:revisions',
            'user:histories',
            'user:activate',
            'user:suspend',
            'user:assume'
        ])->pluck('id')->toArray());

        $vendor = Role::whereName('vendor-user')->first();
        $vendor->permissions()->attach(Permission::whereIn('name', [
            'access:vendor',
            'access:cart',
        ])->pluck('id')->toArray());

        $evaluator = Role::whereName('submission-evaluator')->first();
        $evaluator->permissions()->attach(Permission::whereIn('name', [
            'access:admin',
            'evaluation:index',
            'evaluation:create',
            'evaluation:update'
        ])->pluck('id')->toArray());
    }
}
