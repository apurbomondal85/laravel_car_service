<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public const GROUP_ROLE = 'role';

    public const GROUP_MEMBER = 'user';

    public const GROUP_LOG = 'log';
    public const GROUP_PROFILE = 'profile';
    public const GROUP_PAYMENT = 'payment';
    public const GROUP_TRANSACTION = 'transaction';
    // const GROUP_TICKET = 'ticket';
    public const GROUP_SETTING = 'setting';
    public const GROUP_NOTIFICATION = 'notification';
    public const GROUP_ACTIVITY_LOG = 'activity_log';
    public const GROUP_BLOG = 'blog';
    public const GROUP_NEWS = 'news';
    public const GROUP_FAQS = 'faqs';
    public const GROUP_SUBSCRIBERS = 'subscribers';
    public const GROUP_EVENT = 'event';
    public const GROUP_NOTICE = 'notice';
    public const GROUP_ASSET = 'asset';
    public const GROUP_ASSET_SALE = 'asset_sale';
    public const GROUP_COMMITTEE = 'committee';
    public const GROUP_COMMITTEE_MEMBER = 'committee_member';
    public const GROUP_CAREER = 'career';
    public const GROUP_BUSINESS = 'business';
    // const GROUP_THANK_YOU = 'thank_you';
    public const GROUP_CLUB = 'club';
    public const GROUP_CLUB_MEMBER = 'club_member';
    public const GROUP_CLUB_COMMITTEE = 'club_committee';
    public const GROUP_GENERAL_EXPENSE = 'general_expense';
    public const GROUP_SUBSCRIPTION = 'subscription';
    public const GROUP_REPORT = 'report';

    public const GROUP_BULK_EMAIL = 'email';
    public const GROUP_DROPDOWN = 'dropdown';
    public const GROUP_PRICING_PLAN = 'pricing_plan';
    public const GROUP_GENERAL_SETTINGS = 'general_settings';
    public const GROUP_REPORTS = 'report';
    public const GROUP_PROJECT = 'project';
    public const GROUP_GALLERY = 'gallery';
    public const GROUP_TESTIMONIAL = 'testimonial';
    public const GROUP_CLIENT = 'client';
    public const GROUP_PARTNER = 'partner';
    public const GROUP_TEAM = 'team';
    public const GROUP_MENU = 'menu';


    public function run()
    {
        Permission::whereNotNull('id')->delete();

        $admin_role = Role::where('slug', 'super-admin')->first();
        $admin_user = User::where('email', env('ADMIN_EMAIL'))->first();

        foreach($this->permissions() as $p) {
            $permission = new Permission();
            $permission->name = $p['name'];
            $permission->slug = $p['slug'];
            $permission->group = $p['group'];
            $permission->save();

            if($admin_role) {
                $admin_role->permissions()->attach($permission);
            }

            if($admin_user) {
                $admin_user->permissions()->attach($permission);
            }
        }
    }



    private function permissions()
    {
        return [

            // Role Permissions
            [
                'name'  => 'List',
                'slug'  => self::GROUP_ROLE . '_index',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_ROLE . '_create',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_ROLE . '_show',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_ROLE . '_update',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_ROLE . '_delete',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Permission',
                'slug'  => self::GROUP_ROLE . '_permission',
                'group' => self::GROUP_ROLE
            ],
            [
                'name'  => 'Permission Update',
                'slug'  => self::GROUP_ROLE . '_permission_update',
                'group' => self::GROUP_ROLE
            ],

            //Dropdown
            [
                'name'  => 'List',
                'slug'  => self::GROUP_DROPDOWN . '_index',
                'group' => self::GROUP_DROPDOWN
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_DROPDOWN . '_create',
                'group' => self::GROUP_DROPDOWN
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_DROPDOWN . '_show',
                'group' => self::GROUP_DROPDOWN
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_DROPDOWN . '_update',
                'group' => self::GROUP_DROPDOWN
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_DROPDOWN . '_delete',
                'group' => self::GROUP_DROPDOWN
            ],

            //General Settings
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_GENERAL_SETTINGS . '_show',
                'group' => self::GROUP_GENERAL_SETTINGS
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_GENERAL_SETTINGS . '_update',
                'group' => self::GROUP_GENERAL_SETTINGS
            ],

            // Member
            [
                'name'  => 'List',
                'slug'  => self::GROUP_MEMBER . '_index',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_MEMBER . '_create',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_MEMBER . '_update',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_MEMBER . '_delete',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_MEMBER . '_show',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Restore',
                'slug'  => self::GROUP_MEMBER . '_restore',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_MEMBER . '_update_status',
                'group' => self::GROUP_MEMBER
            ],
            [
                'name'  => 'Update Password',
                'slug'  => self::GROUP_MEMBER . '_update_password',
                'group' => self::GROUP_MEMBER
            ],

            // Blog
            [
                'name'  => 'List',
                'slug'  => self::GROUP_BLOG . '_index',
                'group' => self::GROUP_BLOG
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_BLOG . '_create',
                'group' => self::GROUP_BLOG
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_BLOG . '_update',
                'group' => self::GROUP_BLOG
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_BLOG . '_delete',
                'group' => self::GROUP_BLOG
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_BLOG . '_update_status',
                'group' => self::GROUP_BLOG
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_BLOG . '_show',
                'group' => self::GROUP_BLOG
            ],

            // Notice
            [
                'name'  => 'List',
                'slug'  => self::GROUP_NOTICE . '_index',
                'group' => self::GROUP_NOTICE
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_NOTICE . '_create',
                'group' => self::GROUP_NOTICE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_NOTICE . '_update',
                'group' => self::GROUP_NOTICE
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_NOTICE . '_delete',
                'group' => self::GROUP_NOTICE
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_NOTICE . '_show',
                'group' => self::GROUP_NOTICE
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_NOTICE . '_update_status',
                'group' => self::GROUP_NOTICE
            ],

            // News
            [
                'name'  => 'List',
                'slug'  => self::GROUP_NEWS . '_index',
                'group' => self::GROUP_NEWS
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_NEWS . '_create',
                'group' => self::GROUP_NEWS
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_NEWS . '_update',
                'group' => self::GROUP_NEWS
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_NEWS . '_delete',
                'group' => self::GROUP_NEWS
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_NEWS . '_show',
                'group' => self::GROUP_NEWS
            ],


            // Faqs
            [
                'name'  => 'List',
                'slug'  => self::GROUP_FAQS . '_index',
                'group' => self::GROUP_FAQS
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_FAQS . '_create',
                'group' => self::GROUP_FAQS
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_FAQS . '_update',
                'group' => self::GROUP_FAQS
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_FAQS . '_delete',
                'group' => self::GROUP_FAQS
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_FAQS . '_show',
                'group' => self::GROUP_FAQS
            ],

            // Subscribers
            [
                'name'  => 'List',
                'slug'  => self::GROUP_SUBSCRIBERS . '_index',
                'group' => self::GROUP_SUBSCRIBERS
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_SUBSCRIBERS . '_create',
                'group' => self::GROUP_SUBSCRIBERS
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_SUBSCRIBERS . '_update',
                'group' => self::GROUP_SUBSCRIBERS
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_SUBSCRIBERS . '_delete',
                'group' => self::GROUP_SUBSCRIBERS
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_SUBSCRIBERS . '_show',
                'group' => self::GROUP_SUBSCRIBERS
            ],

            // Event
            [
                'name'  => 'List',
                'slug'  => self::GROUP_EVENT . '_index',
                'group' => self::GROUP_EVENT
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_EVENT . '_create',
                'group' => self::GROUP_EVENT
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_EVENT . '_update',
                'group' => self::GROUP_EVENT
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_EVENT . '_delete',
                'group' => self::GROUP_EVENT
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_EVENT . '_show',
                'group' => self::GROUP_EVENT
            ],

            [
                'name'  => 'Status Update',
                'slug'  => self::GROUP_EVENT . '_status',
                'group' => self::GROUP_EVENT
            ],

            // Asset
            [
                'name'  => 'List',
                'slug'  => self::GROUP_ASSET . '_index',
                'group' => self::GROUP_ASSET
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_ASSET . '_create',
                'group' => self::GROUP_ASSET
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_ASSET . '_update',
                'group' => self::GROUP_ASSET
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_ASSET . '_delete',
                'group' => self::GROUP_ASSET
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_ASSET . '_show',
                'group' => self::GROUP_ASSET
            ],

            // Asset Sale
            [
                'name'  => 'List',
                'slug'  => self::GROUP_ASSET_SALE . '_index',
                'group' => self::GROUP_ASSET_SALE
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_ASSET_SALE . '_create',
                'group' => self::GROUP_ASSET_SALE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_ASSET_SALE . '_update',
                'group' => self::GROUP_ASSET_SALE
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_ASSET_SALE . '_delete',
                'group' => self::GROUP_ASSET_SALE
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_ASSET_SALE . '_show',
                'group' => self::GROUP_ASSET_SALE
            ],

            // Committee
            [
                'name'  => 'List',
                'slug'  => self::GROUP_COMMITTEE . '_index',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_COMMITTEE . '_create',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_COMMITTEE . '_update',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_COMMITTEE . '_delete',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_COMMITTEE . '_show',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_COMMITTEE . '_change_status',
                'group' => self::GROUP_COMMITTEE
            ],
            [
                'name'  => 'Set Current',
                'slug'  => self::GROUP_COMMITTEE . '_set_current',
                'group' => self::GROUP_COMMITTEE
            ],

            // Committee member
            [
                'name'  => 'List',
                'slug'  => self::GROUP_COMMITTEE_MEMBER . '_index',
                'group' => self::GROUP_COMMITTEE_MEMBER
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_COMMITTEE_MEMBER . '_create',
                'group' => self::GROUP_COMMITTEE_MEMBER
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_COMMITTEE_MEMBER . '_update',
                'group' => self::GROUP_COMMITTEE_MEMBER
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_COMMITTEE_MEMBER . '_delete',
                'group' => self::GROUP_COMMITTEE_MEMBER
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_COMMITTEE_MEMBER . '_show',
                'group' => self::GROUP_COMMITTEE_MEMBER
            ],

            // Club
            [
                'name'  => 'List',
                'slug'  => self::GROUP_CLUB . '_index',
                'group' => self::GROUP_CLUB
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_CLUB . '_create',
                'group' => self::GROUP_CLUB
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_CLUB . '_update',
                'group' => self::GROUP_CLUB
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_CLUB . '_delete',
                'group' => self::GROUP_CLUB
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_CLUB . '_show',
                'group' => self::GROUP_CLUB
            ],

            // Club committee
            [
                'name'  => 'List',
                'slug'  => self::GROUP_CLUB_COMMITTEE . '_index',
                'group' => self::GROUP_CLUB_COMMITTEE
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_CLUB_COMMITTEE . '_create',
                'group' => self::GROUP_CLUB_COMMITTEE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_CLUB_COMMITTEE . '_update',
                'group' => self::GROUP_CLUB_COMMITTEE
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_CLUB_COMMITTEE . '_delete',
                'group' => self::GROUP_CLUB_COMMITTEE
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_CLUB_COMMITTEE . '_show',
                'group' => self::GROUP_CLUB_COMMITTEE
            ],

            // Club member
            [
                'name'  => 'List',
                'slug'  => self::GROUP_CLUB_MEMBER . '_index',
                'group' => self::GROUP_CLUB_MEMBER
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_CLUB_MEMBER . '_create',
                'group' => self::GROUP_CLUB_MEMBER
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_CLUB_MEMBER . '_update',
                'group' => self::GROUP_CLUB_MEMBER
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_CLUB_MEMBER . '_delete',
                'group' => self::GROUP_CLUB_MEMBER
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_CLUB_MEMBER . '_show',
                'group' => self::GROUP_CLUB_MEMBER
            ],

            // Business
            [
                'name'  => 'List',
                'slug'  => self::GROUP_BUSINESS . '_index',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_BUSINESS . '_create',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_BUSINESS . '_update',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_BUSINESS . '_delete',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_BUSINESS . '_show',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Change Status',
                'slug'  => self::GROUP_BUSINESS . '_change_status',
                'group' => self::GROUP_BUSINESS
            ],
            [
                'name'  => 'Confirm Payment',
                'slug'  => self::GROUP_BUSINESS . '_confirm_payment',
                'group' => self::GROUP_BUSINESS
            ],

            // Thank You
            // [
            //     'name' => 'List',
            //     'slug' => self::GROUP_THANK_YOU . '_index',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Create',
            //     'slug' => self::GROUP_THANK_YOU . '_create',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Update',
            //     'slug' => self::GROUP_THANK_YOU . '_update',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Delete',
            //     'slug' => self::GROUP_THANK_YOU . '_delete',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Show',
            //     'slug' => self::GROUP_THANK_YOU . '_show',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Change Status',
            //     'slug' => self::GROUP_THANK_YOU . '_change_status',
            //     'group' => self::GROUP_THANK_YOU
            // ],
            // [
            //     'name' => 'Confirm Payment',
            //     'slug' => self::GROUP_THANK_YOU . '_confirm_payment',
            //     'group' => self::GROUP_THANK_YOU
            // ],

            // Career
            [
                'name'  => 'List',
                'slug'  => self::GROUP_CAREER . '_index',
                'group' => self::GROUP_CAREER
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_CAREER . '_create',
                'group' => self::GROUP_CAREER
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_CAREER . '_update',
                'group' => self::GROUP_CAREER
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_CAREER . '_delete',
                'group' => self::GROUP_CAREER
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_CAREER . '_show',
                'group' => self::GROUP_CAREER
            ],

            // Transaction
            [
                'name'  => 'List',
                'slug'  => self::GROUP_TRANSACTION . '_index',
                'group' => self::GROUP_TRANSACTION
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_TRANSACTION . '_create',
                'group' => self::GROUP_TRANSACTION
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_TRANSACTION . '_update_status',
                'group' => self::GROUP_TRANSACTION
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_TRANSACTION . '_delete',
                'group' => self::GROUP_TRANSACTION
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_TRANSACTION . '_show',
                'group' => self::GROUP_TRANSACTION
            ],

            // Subscription
            [
                'name'  => 'List',
                'slug'  => self::GROUP_SUBSCRIPTION . '_index',
                'group' => self::GROUP_SUBSCRIPTION
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_SUBSCRIPTION . '_create',
                'group' => self::GROUP_SUBSCRIPTION
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_SUBSCRIPTION . '_update',
                'group' => self::GROUP_SUBSCRIPTION
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_SUBSCRIPTION . '_delete',
                'group' => self::GROUP_SUBSCRIPTION
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_SUBSCRIPTION . '_show',
                'group' => self::GROUP_SUBSCRIPTION
            ],

            // Report
            [
                'name'  => 'List',
                'slug'  => self::GROUP_REPORT . '_login',
                'group' => self::GROUP_LOG
            ],

            //Log
            [
                'name'  => 'List',
                'slug'  => self::GROUP_LOG . '_login',
                'group' => self::GROUP_LOG
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_LOG . '_delete_login',
                'group' => self::GROUP_LOG
            ],

            //Profile
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_PROFILE . '_index',
                'group' => self::GROUP_PROFILE
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_PROFILE . '_update',
                'group' => self::GROUP_PROFILE
            ],
            [
                'name'  => 'Update Password',
                'slug'  => self::GROUP_PROFILE . '_update_password',
                'group' => self::GROUP_PROFILE
            ],

            //Payment
            [
                'name'  => 'List',
                'slug'  => self::GROUP_PAYMENT . '_index',
                'group' => self::GROUP_PAYMENT
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_PAYMENT . '_create',
                'group' => self::GROUP_PAYMENT
            ],

            //Ticket
            // [
            //     'name' => 'List',
            //     'slug' => self::GROUP_TICKET . '_index',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Create',
            //     'slug' => self::GROUP_TICKET . '_create',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Show',
            //     'slug' => self::GROUP_TICKET . '_show',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Reply',
            //     'slug' => self::GROUP_TICKET . '_reply',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Assignee',
            //     'slug' => self::GROUP_TICKET . '_assignee',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Change Status',
            //     'slug' => self::GROUP_TICKET . '_change_status',
            //     'group' => self::GROUP_TICKET
            // ],
            // [
            //     'name' => 'Re-Open',
            //     'slug' => self::GROUP_TICKET . '_reopen',
            //     'group' => self::GROUP_TICKET
            // ],

            //Setting
            [
                'name'  => 'Email Setting List',
                'slug'  => self::GROUP_SETTING . '_email',
                'group' => self::GROUP_SETTING
            ],
            [
                'name'  => 'Email Setting Update',
                'slug'  => self::GROUP_SETTING . '_email_update',
                'group' => self::GROUP_SETTING
            ],

            // Notification
            [
                'name'  => 'List',
                'slug'  => self::GROUP_NOTIFICATION . '_index',
                'group' => self::GROUP_NOTIFICATION
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_NOTIFICATION . '_create',
                'group' => self::GROUP_NOTIFICATION
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_NOTIFICATION . '_delete',
                'group' => self::GROUP_NOTIFICATION
            ],

            // Activity Log
            [
                'name'  => 'List',
                'slug'  => self::GROUP_ACTIVITY_LOG . '_index',
                'group' => self::GROUP_ACTIVITY_LOG
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_ACTIVITY_LOG . '_details',
                'group' => self::GROUP_ACTIVITY_LOG
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_ACTIVITY_LOG . '_delete',
                'group' => self::GROUP_ACTIVITY_LOG

            ],

            //Bulk Email
            [
                'name'  => 'List',
                'slug'  => self::GROUP_BULK_EMAIL . '_index',
                'group' => self::GROUP_BULK_EMAIL
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_BULK_EMAIL . '_create',
                'group' => self::GROUP_BULK_EMAIL
            ],
            [
                'name'  => 'Recipent',
                'slug'  => self::GROUP_BULK_EMAIL . '_recipient',
                'group' => self::GROUP_BULK_EMAIL
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_BULK_EMAIL . '_show',
                'group' => self::GROUP_BULK_EMAIL
            ],

            // Reports
            [
                'name'  => 'Asset Reports',
                'slug'  => self::GROUP_REPORTS . '_assets',
                'group' => self::GROUP_REPORTS
            ],
            [
                'name'  => 'Transaction Reports',
                'slug'  => self::GROUP_REPORTS . '_transactions',
                'group' => self::GROUP_REPORTS
            ],
            [
                'name'  => 'Member Status Report',
                'slug'  => self::GROUP_REPORTS . '_member_status',
                'group' => self::GROUP_REPORTS
            ],
            [
                'name'  => 'Member Signup Report',
                'slug'  => self::GROUP_REPORTS . '_member_signup',
                'group' => self::GROUP_REPORTS
            ],

            //Membership Type
            [
                'name'  => 'List',
                'slug'  => self::GROUP_PRICING_PLAN . '_index',
                'group' => self::GROUP_PRICING_PLAN
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_PRICING_PLAN . '_create',
                'group' => self::GROUP_PRICING_PLAN
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_PRICING_PLAN . '_update',
                'group' => self::GROUP_PRICING_PLAN
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_PRICING_PLAN . '_delete',
                'group' => self::GROUP_PRICING_PLAN
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_PRICING_PLAN . '_show',
                'group' => self::GROUP_PRICING_PLAN
            ],
            [
                'name'  => 'Change Status',
                'slug'  => self::GROUP_PRICING_PLAN . '_change_status',
                'group' => self::GROUP_PRICING_PLAN
            ],

            // Project
            [
                'name'  => 'List',
                'slug'  => self::GROUP_PROJECT . '_index',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_PROJECT . '_create',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_PROJECT . '_update',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_PROJECT . '_delete',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_PROJECT . '_update_status',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_PROJECT . '_show',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Create Project Image',
                'slug'  => self::GROUP_PROJECT . '_image_create',
                'group' => self::GROUP_PROJECT
            ],
            [
                'name'  => 'Delete Project Image',
                'slug'  => self::GROUP_PROJECT . '_image_delete',
                'group' => self::GROUP_PROJECT
            ],

            // Gallery
            [
                'name'  => 'List',
                'slug'  => self::GROUP_GALLERY . '_index',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_GALLERY . '_create',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_GALLERY . '_update',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_GALLERY . '_delete',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_GALLERY . '_update_status',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_GALLERY . '_show',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Create Gallery Image',
                'slug'  => self::GROUP_GALLERY . '_image_create',
                'group' => self::GROUP_GALLERY
            ],
            [
                'name'  => 'Delete Gallery Image',
                'slug'  => self::GROUP_GALLERY . '_image_delete',
                'group' => self::GROUP_GALLERY
            ],

            // Testimonial
            [
                'name'  => 'List',
                'slug'  => self::GROUP_TESTIMONIAL . '_index',
                'group' => self::GROUP_TESTIMONIAL
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_TESTIMONIAL . '_create',
                'group' => self::GROUP_TESTIMONIAL
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_TESTIMONIAL . '_update',
                'group' => self::GROUP_TESTIMONIAL
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_TESTIMONIAL . '_delete',
                'group' => self::GROUP_TESTIMONIAL
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_TESTIMONIAL . '_update_status',
                'group' => self::GROUP_TESTIMONIAL
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_TESTIMONIAL . '_show',
                'group' => self::GROUP_TESTIMONIAL
            ],

            // Client
            [
                'name'  => 'List',
                'slug'  => self::GROUP_CLIENT . '_index',
                'group' => self::GROUP_CLIENT
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_CLIENT . '_create',
                'group' => self::GROUP_CLIENT
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_CLIENT . '_update',
                'group' => self::GROUP_CLIENT
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_CLIENT . '_delete',
                'group' => self::GROUP_CLIENT
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_CLIENT . '_update_status',
                'group' => self::GROUP_CLIENT
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_CLIENT . '_show',
                'group' => self::GROUP_CLIENT
            ],

            // Partner
            [
                'name'  => 'List',
                'slug'  => self::GROUP_PARTNER . '_index',
                'group' => self::GROUP_PARTNER
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_PARTNER . '_create',
                'group' => self::GROUP_PARTNER
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_PARTNER . '_update',
                'group' => self::GROUP_PARTNER
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_PARTNER . '_delete',
                'group' => self::GROUP_PARTNER
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_PARTNER . '_update_status',
                'group' => self::GROUP_PARTNER
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_PARTNER . '_show',
                'group' => self::GROUP_PARTNER
            ],

            // Team
            [
                'name'  => 'List',
                'slug'  => self::GROUP_TEAM . '_index',
                'group' => self::GROUP_TEAM
            ],
            [
                'name'  => 'Create',
                'slug'  => self::GROUP_TEAM . '_create',
                'group' => self::GROUP_TEAM
            ],
            [
                'name'  => 'Update',
                'slug'  => self::GROUP_TEAM . '_update',
                'group' => self::GROUP_TEAM
            ],
            [
                'name'  => 'Delete',
                'slug'  => self::GROUP_TEAM . '_delete',
                'group' => self::GROUP_TEAM
            ],
            [
                'name'  => 'Update Status',
                'slug'  => self::GROUP_TEAM . '_update_status',
                'group' => self::GROUP_TEAM
            ],
            [
                'name'  => 'Show',
                'slug'  => self::GROUP_TEAM . '_show',
                'group' => self::GROUP_TEAM
            ],

            // Menu
            [
                'name'  => 'Manage People',
                'slug'  => self::GROUP_MENU . '_manage_people',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Manage Post',
                'slug'  => self::GROUP_MENU . '_manage_post',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Manage User',
                'slug'  => self::GROUP_MENU . '_manage_user',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Bulk Email',
                'slug'  => self::GROUP_MENU . '_bulk_email',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Asset',
                'slug'  => self::GROUP_MENU . '_asset',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Footprint',
                'slug'  => self::GROUP_MENU . '_footprint',
                'group' => self::GROUP_MENU
            ],
            [
                'name'  => 'Configuration',
                'slug'  => self::GROUP_MENU . '_configuration',
                'group' => self::GROUP_MENU
            ],
        ];
    }
}
