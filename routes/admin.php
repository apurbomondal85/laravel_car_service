<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/dashboard', 'HomeController@dashboard')->name('home.dashboard');

    //Users
    Route::group(['prefix' => 'users', 'as' => 'user.', 'controller' => CommonController::class], function () {

        Route::post('/{user}/update-status-api', 'updateStatusApi')->name('update_status.api');
        Route::post('/{user}/update-password-api', 'updatePasswordApi')->name('update_password.api');
        Route::post('/{user}/delete-api', 'deleteApi')->name('delete.api');
        Route::post('/{id}/restore-api', 'restoreApi')->name('restore.api');
    });

    // Users
    Route::group(['prefix' => 'users', 'as' => 'user.', 'controller' => UserController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:user_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:user_create');
        Route::post('/create', 'create')->middleware('permission:user_create');
        Route::get('/{user}/update', 'showUpdateForm')->name('update')->middleware('permission:user_update');
        Route::post('/{user}/update', 'update')->middleware('permission:user_update');
        Route::get('/{user}/show', 'show')->name('show')->middleware('permission:user_show');
        Route::post('/{user}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:user_update_status');

        Route::get('/{user}/update/address', 'showUpdateAddressForm')->name('update_address')->middleware('permission:user_update');
        Route::post('/{user}/update/address', 'addressUpdate')->middleware('permission:user_update');

        Route::get('/{user}/update/social', 'showSocialLinkUpdateForm')->name('update_social')->middleware('permission:user_update');
        Route::post('/{user}/update/social', 'socialLinkUpdate')->middleware('permission:user_update');
        Route::post('/{user}/change-login-status', 'changeLoginStatus')->name('change_login_status')->middleware('permission:user_update_status');
    });

    // Products
    Route::group(['prefix' => 'products', 'as' => 'product.', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });

    // Bulk Email
    Route::group(['prefix' => 'bulk_emails', 'as' => 'email.', 'controller' => EmailController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:email_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:email_create');
        Route::post('/store', 'store')->name('store')->middleware('permission:email_create');
        // Route::get('/{user}/update', 'showUpdateForm')->name('update');
        // Route::post('/{user}/update', 'update');
        Route::get('/{email}/show', 'show')->name('show')->middleware('permission:email_show');
        Route::get('/{email}/details', 'details')->name('details')->middleware('permission:email_show');
        Route::post('/{recipient}/resend-api', 'resend')->name('resend.api')->middleware('permission:email_recipient');
    });

    //Logins & Activities
    Route::group(['prefix' => 'logs', 'as' => 'log.', 'controller' => LogController::class], function () {

        Route::get('/logins', 'loginHistory')->name('login')->middleware('permission:log_login');
        Route::post('/{log}/delete-api', 'deleteLoginHIstoryApi')->name('delete_login.api')->middleware('permission:log_delete_login');
    });

    Route::group(['prefix' => 'logs', 'as' => 'log.activity.', 'controller' => ActivityLogController::class], function () {
        Route::get('/activity', 'activityLog')->name('index')->middleware('permission:activity_log_index');
        Route::get('/{activity}/details', 'activityLogDetails')->name('show')->middleware('permission:activity_log_details');
        Route::post('/{activity}/delete', 'deleteActivityLog')->name('delete')->middleware('permission:activity_log_delete');
    });

    //Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'controller' => ProfileController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:profile_index');
        Route::get('/update', 'showUpdateForm')->name('update')->middleware('permission:profile_update');
        Route::post('/update', 'update')->middleware('permission:profile_update');
        Route::post('/update-password-api', 'updatePasswordApi')->name('update_password.api')->middleware('permission:profile_update_password');

        Route::get('/update/address', 'showUpdateAddressForm')->name('update_address')->middleware('permission:profile_update');
        Route::post('/update/address', 'addressUpdate')->middleware('permission:profile_update');

        Route::get('/update/social', 'showSocialLinkUpdateForm')->name('update_social')->middleware('permission:profile_update');
        Route::post('/update/social', 'socialLinkUpdate')->middleware('permission:profile_update');
    });

    // Payment
    Route::group(['prefix' => 'payments', 'as' => 'payment.', 'controller' => PaymentController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:payment_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:payment_create');
        Route::post('/create', 'create')->middleware('permission:payment_create');
    });

    // Config
    Route::group(['prefix' => 'configs', 'as' => 'config.', 'controller' => ConfigController::class], function () {
        // Roles & Permissions
        Route::group(['prefix' => 'roles', 'as' => 'role.', 'controller' => RoleController::class], function () {
            Route::get('/', 'index')->name('index')->middleware('permission:role_index');
            Route::get('/{role}/show-api', 'showApi')->name('show.api')->middleware('permission:role_show');
            Route::get('/slug', 'slugApi')->name('slug.api')->middleware('permission:role_create');
            Route::post('/create', 'createApi')->name('create.api')->middleware('permission:role_create');
            Route::post('/{role}/update-api', 'updateApi')->name('update.api')->middleware('permission:role_update');
            Route::post('/{role}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:role_delete');
            Route::get('/{role}/permissions', 'permissions')->name('permission')->middleware('permission:role_permission');
            Route::post('/{role}/permissions/update', 'updatePermissions')->name('permission.update')->middleware('permission:role_permission_update');
        });

        // Dropdown
        Route::group(['prefix' => 'dropdowns', 'as' => 'dropdown.'], function () {
            Route::get('/', 'getDropdownList')->name('list')->middleware('permission:dropdown_index');
            Route::get('/{dropdown}', 'dropdownIndex')->name('index')->middleware('permission:dropdown_index');
            Route::get('/{dropdown}/{id}/show-api', 'showDropdownApi')->name('show.api')->middleware('permission:dropdown_index');
            Route::post('/{dropdown}/create', 'createDropdownApi')->name('create.api')->middleware('permission:dropdown_create');
            Route::post('/{dropdown}/{id}/update-api', 'updateDropdownApi')->name('update.api')->middleware('permission:dropdown_update');
            Route::post('/{dropdown}/{id}/delete-api', 'deleteDropdownApi')->name('delete.api')->middleware('permission:dropdown_delete');
        });

        // Dropdown
        Route::group(['prefix' => 'membership', 'as' => 'membership.'], function () {
            Route::get('/membership-type', 'membershipPlan')->name('type')->middleware('permission:membership_type_update');
            Route::post('/membership-type', 'updatemembershipPlan')->name('type.update')->middleware('permission:membership_type_update');
        });

        // email template
        Route::group(['prefix' => 'emails', 'as' => 'email.', 'controller' => EmailTemplateController::class], function () {
            Route::get('/email', 'emailTemplate')->name('index')->middleware('permission:setting_email');
            Route::get('/email/{email_setting}/update', 'updateEmailTemplateForm')->name('update')->middleware('permission:setting_email_update');
            Route::post('/email/{email_setting}/update', 'updateEmailTemplate')->middleware('permission:setting_email_update');
        });

        Route::get('/general', 'general')->name('general.settings')->middleware('permission:general_settings_show');
        Route::post('/general', 'updateGeneralSettings')->name('general.settings.update')->middleware('permission:general_settings_update');
    });

    //Notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notification.', 'controller' => NotificationController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:notification_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:notification_create');
        Route::post('/create', 'create')->middleware('permission:notification_create');
        Route::post('/{notification}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:notification_delete');
    });

    // Start Asset Module
    Route::group(['prefix' => 'assets', 'as' => 'asset.', 'controller' => AssetController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:asset_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:asset_create');
        Route::post('/create', 'create')->middleware('permission:asset_create');
        Route::get('/{asset}/update', 'showUpdateForm')->name('update')->middleware('permission:asset_update');
        Route::post('/{asset}/update', 'update')->middleware('permission:asset_update');
        Route::get('/{asset}/show', 'show')->name('show')->middleware('permission:asset_show');
        Route::post('/{asset}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:asset_delete');

        // Asset Sale
        Route::get('/sale/index', 'saleIndex')->name('sale.index')->middleware('permission:asset_sale_index');
        Route::get('/{asset}/sale/create', 'showCreateSaleForm')->name('sale.create')->middleware('permission:asset_sale_create');
        Route::post('/{asset}/sale/create', 'saleCreate')->middleware('permission:asset_sale_create');
        Route::get('/{asset}/sale/{assetSale}/update', 'saleShowUpdateForm')->name('sale.update')->middleware('permission:asset_sale_update');
        Route::post('/{asset}/sale/{assetSale}/update', 'updateAssetSale')->middleware('permission:asset_sale_update');
        Route::get('/{asset}/sale/{assetSale}/show', 'saleShow')->name('sale.show')->middleware('permission:asset_sale_show');
    });
    // End Asset Module

    // Start Website/Frontend Module

    // Blog Module
    Route::group(['prefix' => 'blogs', 'as' => 'blog.', 'controller' => BlogController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:blog_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:blog_create');
        Route::post('/create', 'create')->middleware('permission:blog_create');
        Route::get('/{blog}/update', 'showUpdateForm')->name('update')->middleware('permission:blog_update');
        Route::post('/{blog}/update', 'update')->middleware('permission:blog_update');
        Route::get('/{blog}/show', 'show')->name('show')->middleware('permission:blog_show');
        Route::post('/{blog}/change-status', 'changeStatus')->name('change_status')->middleware('permission:blog_update_status');
        Route::post('/{blog}/change-featured', 'changeFeatured')->name('change_featured')->middleware('permission:blog_update_status');
        Route::post('/{blog}/delete', 'delete')->name('delete')->middleware('permission:blog_delete');
    });

    // Career Module
    Route::group(['prefix' => 'careers', 'as' => 'career.', 'controller' => CareerController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:career_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:career_create');
        Route::post('/create', 'create')->middleware('permission:career_create');
        Route::get('/{career}/update', 'showUpdateForm')->name('update')->middleware('permission:career_update');
        Route::post('/{career}/update', 'update')->middleware('permission:career_update');
        Route::get('/{career}/show', 'show')->name('show')->middleware('permission:career_show');
        Route::post('/{career}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:career_delete');
    });

    // Business Module
    Route::group(['prefix' => 'business', 'as' => 'business.', 'controller' => BusinessController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:business_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:business_create');
        Route::post('/create', 'create')->middleware('permission:business_create');
        Route::get('/{business}/update', 'showUpdateForm')->name('update')->middleware('permission:business_update');
        Route::post('/{business}/update', 'update')->middleware('permission:business_update');
        Route::get('/{business}/show', 'show')->name('show')->middleware('permission:business_show');
        Route::post('/{business}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:business_change_status');
        Route::post('/{business}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:business_delete');

        Route::post('/{business}/confirm-payment-api', 'confirmPaymentApi')->name('payment.api')->middleware('permission:business_confirm_payment');
    });

    // Event Module
    Route::group(['prefix' => 'events', 'as' => 'event.', 'controller' => EventController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:event_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:event_create');
        Route::post('/create', 'create')->middleware('permission:event_create');
        Route::get('/{event}/update', 'showUpdateForm')->name('update')->middleware('permission:event_update');
        Route::post('/{event}/update', 'update')->middleware('permission:event_update');
        Route::get('/{event}/show', 'show')->name('show')->middleware('permission:event_show');
        Route::post('/{event}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:event_status');
        Route::post('/{event}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:event_delete');
    });

    // Notice Module
    Route::group(['prefix' => 'notices', 'as' => 'notice.', 'controller' => NoticeController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:notice_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:notice_create');
        Route::post('/create', 'create')->middleware('permission:notice_create');
        Route::get('/{notice}/update', 'showUpdateForm')->name('update')->middleware('permission:notice_update');
        Route::post('/{notice}/update', 'update')->middleware('permission:notice_update');
        Route::get('/{notice}/show', 'show')->name('show')->middleware('permission:notice_show');
        Route::post('/{notice}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:notice_update_status');
        Route::post('/{notice}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:notice_delete');
    });

    // News Module
    Route::group(['prefix' => 'news', 'as' => 'news.', 'controller' => NewsController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:news_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:news_create');
        Route::post('/create', 'create')->middleware('permission:news_create');
        Route::get('/{news}/update', 'showUpdateForm')->name('update')->middleware('permission:news_update');
        Route::post('/{news}/update', 'update')->middleware('permission:news_update');
        Route::get('/{news}/show', 'show')->name('show')->middleware('permission:news_show');
        Route::post('/{news}/change-status', 'changeStatus')->name('change_status');
        Route::post('/{news}/change-featured', 'changeFeatured')->name('change_featured');
        Route::post('/{news}/delete', 'delete')->name('delete')->middleware('permission:news_delete');
    });

    // Faq Module
    Route::group(['prefix' => 'faqs', 'as' => 'faqs.', 'controller' => FaqController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:faqs_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:faqs_create');
        Route::post('/create', 'create')->middleware('permission:faqs_create');
        Route::get('/{faq}/update', 'showUpdateForm')->name('update')->middleware('permission:faqs_update');
        Route::post('/{faq}/update', 'update')->middleware('permission:faqs_update');
        Route::get('/{faq}/show', 'show')->name('show')->middleware('permission:faqs_show');
        Route::post('/{faq}/change-status', 'changeStatus')->name('change_status');
        Route::post('/{faq}/delete', 'delete')->name('delete')->middleware('permission:faqs_delete');
    });

    // Team Module
    Route::group(['prefix' => 'teams', 'as' => 'team.', 'controller' => TeamController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:team_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:team_create');
        Route::post('/create', 'create')->middleware('permission:team_create');
        Route::get('/{team}/update', 'showUpdateForm')->name('update')->middleware('permission:team_update');
        Route::post('/{team}/update', 'update')->middleware('permission:team_update');
        Route::get('/{team}/show', 'show')->name('show')->middleware('permission:team_show');
        Route::post('/{team}/change/active-status', 'changeActiveStatus')->name('update_active_status')->middleware('permission:team_update_status');
        Route::post('/{team}/change/feature-status', 'changeFeatureStatus')->name('update_feature_status')->middleware('permission:team_update_status');
        Route::post('/{team}/delete', 'delete')->name('delete')->middleware('permission:team_delete');

        Route::get('/{team}/member/create', 'showCreateMemberForm')->name('member.create')->middleware('permission:committee_member_create');
        Route::post('/{team}/member/create', 'createMember')->middleware('permission:committee_member_create');
        Route::get('/members/{member}/update', 'showUpdateMemberForm')->name('member.update')->middleware('permission:committee_member_update');
        Route::post('/members/{member}/update', 'updateMember')->middleware('permission:committee_member_update');
        Route::post('/members/{member}/change/active-status', 'changeMemberActiveStatus')->name('member.update_active_status')->middleware('permission:team_update_status');
        Route::post('/members/{member}/change/feature-status', 'changeMemberFeatureStatus')->name('member.update_feature_status')->middleware('permission:team_update_status');
        Route::post('/members/{member}/delete-api', 'memberDeleteApi')->name('member.delete.api')->middleware('permission:committee_member_delete');

    });
    // End Website/Frontend Module

    // Subscribers Module
    Route::group(['prefix' => 'subscribers', 'as' => 'subscribers.', 'controller' => SubscriberController::class], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:subscribers_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:subscribers_create');
        Route::post('/create', 'store')->middleware('permission:subscribers_create');
        Route::get('/{subscriber}/update', 'edit')->name('update')->middleware('permission:subscribers_update');
        Route::post('/{subscriber}/update', 'update')->middleware('permission:subscribers_update');
        Route::get('/{subscriber}/show', 'show')->name('show')->middleware('permission:subscribers_show');
        Route::post('/{subscriber}/change-status', 'changeStatus')->name('change_status')->middleware('permission:subscribers_update');
        Route::post('/{subscriber}/delete', 'destroy')->name('delete')->middleware('permission:subscribers_delete');
    });
    // End Subscribers Module

    // Start Accounts Module

    // General Expense
    Route::group(['prefix' => 'expenses', 'as' => 'expense.', 'controller' => ExpenseController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:general_expense_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:general_expense_create');
        Route::post('/create', 'create')->middleware('permission:general_expense_create');
        Route::get('/{expense}/update', 'showUpdateForm')->name('update')->middleware('permission:general_expense_update');
        Route::post('/{expense}/update', 'update')->middleware('permission:general_expense_update');
        Route::get('/{expense}/show', 'show')->name('show')->middleware('permission:general_expense_show');
        Route::post('/{expense}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:general_expense_delete');
    });

    // Transaction
    Route::group(['prefix' => 'transactions', 'as' => 'transaction.', 'controller' => TransactionController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:transaction_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:transaction_create');
        Route::post('/create', 'create')->middleware('permission:transaction_create');
        Route::get('/{transaction}/show', 'show')->name('show')->middleware('permission:transaction_show');
        Route::post('/{transaction}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:transaction_delete');
        Route::post('/{transaction}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:transaction_update_status');
    });

    // End Accounts Module


    // Comittee Module
    Route::group(['prefix' => 'committees', 'as' => 'committee.', 'controller' => CommitteeController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:committee_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:committee_create');
        Route::post('/create', 'create')->middleware('permission:committee_create');
        Route::get('/{committee}/update', 'showUpdateForm')->name('update')->middleware('permission:committee_update');
        Route::post('/{committee}/update', 'update')->middleware('permission:committee_update');
        Route::get('/{committee}/show', 'show')->name('show')->middleware('permission:committee_show');
        Route::post('/{committee}/change-status-api', 'changeStatusApi')->name('change_status.api')->middleware('permission:committee_change_status');
        Route::post('/{committee}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:committee_delete');
        Route::post('/{committee}/set-current', 'setCurrent')->name('set_current')->middleware('permission:committee_set_current');

        Route::get('/{committee}/members/create', 'showCreatememberForm')->name('member.create')->middleware('permission:committee_member_create');
        Route::post('/{committee}/members/create', 'createMember')->middleware('permission:committee_member_create');
        Route::get('/{committee}/members/{member}/update', 'showUpdateMemberForm')->name('member.update')->middleware('permission:committee_member_update');
        Route::post('/{committee}/members/{member}/update', 'updateMember')->middleware('permission:committee_member_update');
        Route::post('/members/{member}/delete-api', 'memberDeleteApi')->name('member.delete.api')->middleware('permission:committee_member_delete');
    });

    // Club Module
    Route::group(['prefix' => 'clubs', 'as' => 'club.', 'controller' => ClubController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:club_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:club_create');
        Route::post('/create', 'create')->middleware('permission:club_create');
        Route::get('/{club}/update', 'showUpdateForm')->name('update')->middleware('permission:club_update');
        Route::post('/{club}/update', 'update')->middleware('permission:club_update');
        Route::get('/{club}/show', 'show')->name('show')->middleware('permission:club_show');
        Route::post('/{club}/change-status-api', 'changeStatusApi')->name('change_status.api');
        Route::post('/{club}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:club_delete');

        Route::get('/{club}/members/create', 'showCreatememberForm')->name('member.create')->middleware('permission:club_member_create');
        Route::post('/{club}/members/create', 'createMember')->middleware('permission:club_member_create');
        Route::get('/{club}/members/{member}/update', 'showUpdateMemberForm')->name('member.update')->middleware('permission:club_member_update');
        Route::post('/{club}/members/{member}/update', 'updateMember')->middleware('permission:club_member_update');
        Route::post('/members/{member}/delete-api', 'memberDeleteApi')->name('member.delete.api')->middleware('permission:club_member_delete');
    });

    //===============--------------- Advance Analytics ---============================//
    Route::group(['prefix' => 'reports', 'as' => 'report.', 'controller' => ReportController::class], function () {

        Route::get('/asset-reports', 'assetIndex')->name('asset')->middleware('permission:report_assets');
        Route::get('/transaction-reports', 'transactionIndex')->name('transaction')->middleware('permission:report_transactions');
        Route::get('/members-status', 'memberStatusIndex')->name('memberStatus')->middleware('permission:report_member_status');
        Route::get('/members-signup', 'memberSignupIndex')->name('memberSignup')->middleware('permission:report_member_signup');
    });

    // Pricing Plan Module
    Route::group(['prefix' => 'pricing-plans', 'as' => 'pricing_plan.', 'controller' => PricingPlanController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:pricing_plan_index');
        Route::get('/create', 'showCreateForm')->name('create')->middleware('permission:pricing_plan_create');
        Route::post('/create', 'create')->middleware('permission:pricing_plan_create');
        Route::get('/{pricingPlan}/update', 'showUpdateForm')->name('update')->middleware('permission:pricing_plan_update');
        Route::post('/{pricingPlan}/update', 'update')->middleware('permission:pricing_plan_update');
        Route::get('/{pricingPlan}/show', 'show')->name('show')->middleware('permission:pricing_plan_show');
        Route::post('/{pricingPlan}/change-status-api/{type}', 'changeStatusApi')->name('change_status.api')->middleware('permission:pricing_plan_change_status');
        Route::post('/{pricingPlan}/delete-api', 'deleteApi')->name('delete.api')->middleware('permission:pricing_plan_delete');
    });


    // Project Module
    Route::group(['prefix' => 'projects', 'as' => 'project.', 'controller' => ProjectController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:project_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:project_create');
        Route::post('/create', 'store')->middleware('permission:project_create');
        Route::get('/{project}/update', 'edit')->name('update')->middleware('permission:project_update');
        Route::post('/{project}/update', 'update')->middleware('permission:project_update');
        Route::get('/{project}/show', 'show')->name('show')->middleware('permission:project_show');
        Route::post('/{project}/change-status/{type}', 'changeStatus')->name('change_status')->middleware('permission:project_update_status');
        Route::post('/{project}/delete', 'destroy')->name('delete')->middleware('permission:project_delete');

        Route::get('/{project}/create-project-image', 'createProjectImage')->name('createProjectImage')->middleware('permission:project_image_create');
        Route::post('/{project}/store-project-image', 'storeProjectImage')->name('storeProjectImage')->middleware('permission:project_image_create');
        Route::post('/{projectImage}/delete-project-image', 'destroyProjectImage')->name('deleteProjectImage')->middleware('permission:project_image_delete');
    });

    // Project Module
    Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'controller' => GalleryController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:gallery_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:gallery_create');
        Route::post('/create', 'store')->middleware('permission:gallery_create');
        Route::get('/{gallery}/update', 'edit')->name('update')->middleware('permission:gallery_update');
        Route::post('/{gallery}/update', 'update')->middleware('permission:gallery_update');
        Route::get('/{gallery}/show', 'show')->name('show')->middleware('permission:gallery_show');
        Route::post('/{gallery}/change-status/{type}', 'changeStatus')->name('change_status')->middleware('permission:gallery_update_status');
        Route::post('/{gallery}/delete', 'destroy')->name('delete')->middleware('permission:gallery_delete');

        Route::get('/{gallery}/create-gallery-image', 'createGalleryImage')->name('createGalleryImage')->middleware('permission:gallery_image_create');
        Route::post('/{gallery}/store-gallery-image', 'storeGalleryImage')->name('storeGalleryImage')->middleware('permission:gallery_image_create');
        Route::post('/{galleryImage}/delete-gallery-image', 'destroyGalleryImage')->name('deleteGalleryImage')->middleware('permission:gallery_image_delete');
    });

    // Testimonial Module
    Route::group(['prefix' => 'testimonials', 'as' => 'testimonial.', 'controller' => TestimonialController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:testimonial_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:testimonial_create');
        Route::post('/create', 'store')->middleware('permission:testimonial_create');
        Route::get('/{testimonial}/update', 'edit')->name('update')->middleware('permission:testimonial_update');
        Route::post('/{testimonial}/update', 'update')->middleware('permission:testimonial_update');
        Route::get('/{testimonial}/show', 'show')->name('show')->middleware('permission:testimonial_show');
        Route::post('/{testimonial}/change-status-api/{type}', 'changeStatusApi')->name('change_status.api')->middleware('permission:testimonial_update_status');
        Route::post('/{testimonial}/delete-api', 'destroy')->name('delete.api')->middleware('permission:testimonial_delete');
    });

    // Client Module
    Route::group(['prefix' => 'client', 'as' => 'client.', 'controller' => ClientPartnerController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:client_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:client_create');
        Route::post('/create', 'store')->middleware('permission:client_create');
        Route::get('/{client}/update', 'edit')->name('update')->middleware('permission:client_update');
        Route::post('/{client}/update', 'update')->middleware('permission:client_update');
        Route::get('/{client}/show', 'show')->name('show')->middleware('permission:client_show');
        Route::post('/{client}/change-status-api/{type}', 'changeStatusApi')->name('change_status.api')->middleware('permission:client_update_status');
        Route::post('/{client}/delete-api', 'destroy')->name('delete.api')->middleware('permission:client_delete');
    });

    // Client Module
    Route::group(['prefix' => 'partner', 'as' => 'partner.', 'controller' => ClientPartnerController::class], function () {

        Route::get('/', 'index')->name('index')->middleware('permission:partner_index');
        Route::get('/create', 'create')->name('create')->middleware('permission:partner_create');
        Route::post('/create', 'store')->middleware('permission:partner_create');
        Route::get('/{client}/update', 'edit')->name('update')->middleware('permission:partner_update');
        Route::post('/{client}/update', 'update')->middleware('permission:partner_update');
        Route::get('/{client}/show', 'show')->name('show')->middleware('permission:partner_show');
        Route::post('/{client}/change-status-api/{type}', 'changeStatusApi')->name('change_status.api')->middleware('permission:partner_update_status');
        Route::post('/{client}/delete-api', 'destroy')->name('delete.api')->middleware('permission:partner_delete');
    });
});
