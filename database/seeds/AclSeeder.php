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
            ['access:portal', 'Access portal'],


            // Data Association
            ['has:organization', 'User has an organization data'],

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

            // Payment Gateways
            ['payment-gateway:index', 'List all payment gateways'],
            ['payment-gateway:show', 'View a payment gateway'],
            ['payment-gateway:create', 'Create new payment gateway'],
            ['payment-gateway:update', 'Update existing payment gateway'],
            ['payment-gateway:delete', 'Delete existing payment gateway'],
            ['payment-gateway:restore', 'Restore deleted payment gateway'],
            ['payment-gateway:revisions', 'View payment gateway revisions'],
            ['payment-gateway:histories', 'View payment gateway histories'],
            ['payment-gateway:archives', 'List all deleted payment gateways'],
            ['payment-gateway:duplicate', 'Duplicate existing payment gateway'],

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
                'name'         => 'user',
                'display_name' => 'User',
                'description'  => 'Normal user.',
            ],
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

        $vendor = Role::whereName('user')->first();
        $vendor->permissions()->attach(Permission::whereIn('name', [
            'access:portal',
        ])->pluck('id')->toArray());
    }
}
