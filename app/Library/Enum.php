<?php

namespace App\Library;

class Enum
{
    //============ * Default Images *===============//
    public const LOGO_PATH = 'resources/images/logo.png';
    public const LOGO_WHITE_PATH = 'resources/images/logowhhite.png';
    public const NO_AVATAR_PATH = 'resources/images/no_avatar.png';
    public const NO_IMAGE_PATH = 'resources/images/noimage.jpg';
    public const LOGIN_BACKGROUND_PATH = 'resources/images/Background.jpg';
    public const MARK_CHECK_IMAGE_PATH = 'resources/images/mark.jpg';
    //============ * End *===============//

    public const ROLE_ADMIN_SLUG = 'super-admin';
    public const CONFIG_IMAGE_DIR = 'storage/config';

    public const USER_PROFILE_IMAGE = 'storage/user/profile';
    public const USER_PHOTO_ID = 'storage/user/photo_id';
    public const USER_DOCUMENTS = 'storage/user/documents';
    public const COMMITTEE_MEMBER = 'storage/committee/member';
    public const CLUB = 'storage/club';
    public const CLUB_MEMBER = 'storage/club/member';

    public const TICKET_ATTACHMENT_DIR = 'storage/ticket';
    public const ASSET_DOCUMENTS = 'storage/asset';
    public const BLOG_FEATURE_IMAGE = 'storage/blog';
    public const BUSINESS_FEATURE_IMAGE = 'storage/business';
    public const EVENT_FEATURE_IMAGE = 'storage/event';
    public const NOTICE_FEATURE_IMAGE = 'storage/notice';
    public const CLUB_FEATURE_IMAGE = 'storage/club';
    public const NEWS_FEATURE_IMAGE = 'storage/news';
    public const PROJECT_FEATURE_IMAGE = 'storage/project';
    public const ATTACHMENT_FILE_DIR = 'storage/attachment';
    public const TESTIMONIAL_AVATAR_DIR = 'storage/testimonial';
    public const CLIENT_PARTNER_LOGO_DIR = 'storage/client_partner';

    //Email Settings
    public const EMAIL_TICKET_CREATE = 'ticket_create';
    public const EMAIL_TICKET_ASSIGN = 'ticket_assign';

    public const POST_TYPE_BLOG = 'blog';
    public const POST_TYPE_NEWS = 'news';

    public static function getPostType(string $type = null)
    {
        $types = [
            self::POST_TYPE_BLOG => 'Blog',
            self::POST_TYPE_NEWS => 'News',
        ];

        return $type ? $types[$type] : $types;
    }

    public const CLIENT_TYPE_CLIENT = 'client';
    public const CLIENT_TYPE_PARTNER = 'partner';

    public static function getClientType(string $type = null)
    {
        $types = [
            self::CLIENT_TYPE_CLIENT  => 'Client',
            self::CLIENT_TYPE_PARTNER => 'Partner',
        ];

        return $type ? $types[$type] : $types;
    }


    /* ============== USER MODULE ===================*/

    public const USER_TYPE_ADMIN = 'admin';
    public const USER_TYPE_CUSTOMER = 'customer';

    public static function getUserType(string $type = null)
    {
        $types = [
            self::USER_TYPE_ADMIN     => 'Admin',
            self::USER_TYPE_CUSTOMER => 'Customer',
        ];

        return $type ? $types[$type] : $types;
    }


    public const MEMBER_TYPE_GENERAL = 'general';
    public const MEMBER_TYPE_PREMIUM = 'premium';
    public const MEMBER_TYPE_LIFETIME = 'lifetime';

    public static function getMemberType(string $type = null)
    {
        $types = [
            self::MEMBER_TYPE_GENERAL  => 'General',
            self::MEMBER_TYPE_PREMIUM  => 'Premium',
            self::MEMBER_TYPE_LIFETIME => 'Lifetime',
        ];

        return $type ? $types[$type] : $types;
    }

    public const USER_STATUS_PENDING = 1;
    public const USER_STATUS_ACTIVE = 2;
    public const USER_STATUS_INACTIVE = 3;

    public static function getUserStatus(int $type = null)
    {
        $types = [
            self::USER_STATUS_PENDING  => "Pending",
            self::USER_STATUS_ACTIVE   => "Active",
            self::USER_STATUS_INACTIVE => "Inactive"
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    
    public const PRODUCT_STATUS_ACTIVE = 1;
    public const PRODUCT_STATUS_INACTIVE = 2;
    public const PRODUCT_STATUS_OUT_OF_STOCK = 3;

    public static function getProductStatus(int $type = null)
    {
        $types = [
            self::PRODUCT_STATUS_ACTIVE  => "Active",
            self::PRODUCT_STATUS_INACTIVE   => "Inactive",
            self::PRODUCT_STATUS_OUT_OF_STOCK => "Out Of Stock"
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    public const CATEGORY_STATUS_ACTIVE = 1;
    public const CATEGORY_STATUS_INACTIVE = 2;

    public static function getCategoryStatus(int $type = null)
    {
        $types = [
            self::CATEGORY_STATUS_ACTIVE  => "Active",
            self::CATEGORY_STATUS_INACTIVE   => "Inactive",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    public const BRAND_STATUS_ACTIVE = 1;
    public const BRAND_STATUS_INACTIVE = 2;

    public static function getBrandStatus(int $type = null)
    {
        $types = [
            self::BRAND_STATUS_ACTIVE  => "Active",
            self::BRAND_STATUS_INACTIVE   => "Inactive",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    /* ============== END ===================*/

    /* ============== EMPLOYEE MODULE ===================*/

    public const EMPLOYEE_TYPE_PART_TIME = 'part_time';
    public const EMPLOYEE_TYPE_FULL_TIME = 'full_time';

    public static function getEmployeeType(string $type = null)
    {
        $types = [
            self::EMPLOYEE_TYPE_PART_TIME => "Part Time",
            self::EMPLOYEE_TYPE_FULL_TIME => "Full Time"
        ];

        return $type ? $types[$type] : $types;
    }

    /* ============== END ===================*/


    /* ============== TICKET MODULE ===================*/

    public const TICKET_STATUS_OPEN = 1;
    public const TICKET_STATUS_HOLD = 2;
    public const TICKET_STATUS_CLOSED = 3;

    public static function getTicketStatus(string $status = null)
    {
        $status_arr = [
            self::TICKET_STATUS_OPEN   => 'Open',
            self::TICKET_STATUS_HOLD   => 'Hold',
            self::TICKET_STATUS_CLOSED => 'Closed',
        ];

        return $status ? $status_arr[$status] : $status_arr;
    }

    public const TICKET_PRIORITY_LOW = 1;
    public const TICKET_PRIORITY_MEDIUM = 2;
    public const TICKET_PRIORITY_HIGH = 3;

    public static function getTicketPriority(int $priority = 0)
    {
        $priority_arr = [
            self::TICKET_PRIORITY_LOW    => "Low",
            self::TICKET_PRIORITY_MEDIUM => "Medium",
            self::TICKET_PRIORITY_HIGH   => 'High'
        ];

        return $priority ? $priority_arr[$priority] : $priority_arr;
    }

    /* ============== END ===================*/

    /* ============== CONFIG MODULE ===================*/

    public const CONFIG_DROPDOWN_MEMBER_DESIGNATION = 'designation';
    public const CONFIG_DROPDOWN_TICKET_DEPARTMENT = 'ticket_department';
    public const CONFIG_DROPDOWN_NOTIFICATION_TYPE = 'notification_type';
    public const CONFIG_DROPDOWN_ASSET_TYPE = 'asset_type';
    public const CONFIG_DROPDOWN_BLOG_TYPE = 'blog_type';
    public const CONFIG_DROPDOWN_JOB_TYPE = 'job_type';
    public const CONFIG_DROPDOWN_JOB_LOCATION = 'job_location';
    public const CONFIG_DROPDOWN_BUSINESS_TYPE = 'business_type';
    public const CONFIG_DROPDOWN_EXPENSE_TYPE = 'expense_type';
    public const CONFIG_DROPDOWN_EVENT_TYPE = 'event_type';
    public const CONFIG_DROPDOWN_NOTICE_TYPE = 'notice_type';
    public const CONFIG_DROPDOWN_SEASON = 'team_season';
    // public const CONFIG_DROPDOWN_PROJECT_CATEGORY = 'project_category';
    public const CONFIG_DROPDOWN_GENDER = 'gender';
    public const CONFIG_DROPDOWN_PRONOUN = 'pronoun';
    public const CONFIG_DROPDOWN_USER_TITLE = 'user_title';
    public const CONFIG_DROPDOWN_GALLERY_CATEGORY = 'gallery_category';
    public const CONFIG_DROPDOWN_NEWS_CATEGORY = 'news_category';
    public const CONFIG_DROPDOWN_BLOG_TAG = 'blog_tag';
    public const CONFIG_DROPDOWN_TEAM_DESIGNATION = 'team_designation';

    public static function getConfigDropdown(string $key = null)
    {
        $dropdowns = [
            self::CONFIG_DROPDOWN_MEMBER_DESIGNATION => "Designation",
            self::CONFIG_DROPDOWN_TICKET_DEPARTMENT  => "Ticket Department",
            self::CONFIG_DROPDOWN_NOTIFICATION_TYPE  => "Notification Type",
            self::CONFIG_DROPDOWN_ASSET_TYPE         => "Asset Type",
            self::CONFIG_DROPDOWN_BLOG_TYPE          => "Blog Type",
            self::CONFIG_DROPDOWN_JOB_TYPE           => "Job Type",
            self::CONFIG_DROPDOWN_JOB_LOCATION       => "Job Location",
            self::CONFIG_DROPDOWN_BUSINESS_TYPE      => "Business Type",
            self::CONFIG_DROPDOWN_EXPENSE_TYPE       => "Expense Type",
            self::CONFIG_DROPDOWN_EVENT_TYPE         => "Event Type",
            self::CONFIG_DROPDOWN_NOTICE_TYPE        => "Notice Type",
            self::CONFIG_DROPDOWN_SEASON             => "Team Season",
            // self::CONFIG_DROPDOWN_PROJECT_CATEGORY   => "Project Category",
            self::CONFIG_DROPDOWN_GENDER           => "Gender",
            self::CONFIG_DROPDOWN_PRONOUN          => "Pronoun",
            self::CONFIG_DROPDOWN_USER_TITLE       => "User Title (Ex: Mr. , Mrs. ...)",
            self::CONFIG_DROPDOWN_GALLERY_CATEGORY => "Gallery Category",
            self::CONFIG_DROPDOWN_NEWS_CATEGORY    => "News Category",
            self::CONFIG_DROPDOWN_BLOG_TAG         => "Blog Tags",
            self::CONFIG_DROPDOWN_TEAM_DESIGNATION => "Team Designation",
        ];

        return $key ? $dropdowns[$key] : $dropdowns;
    }

    /* ============== END ===================*/

    public static function systemShortcodesWithValues()
    {
        return [
            'current_date'     => now()->format('Y-m-d'),
            'current_datetime' => '',
            'current_time'     => '',
            'system_url'       => '',
            'app_name'         => ''
        ];
    }

    public static function createUniqueId($lastId, $uniqueKey)
    {
        if ($lastId) {
            $id = $lastId->id;
            // $id = $lastId->id + 1;
        } else {
            $id = 1;
        }

        $id = $id > 9 ? $id : 0 . $id;
        $uniqueId = $uniqueKey . $id;

        return $uniqueId;
    }

    public static function updateUniqueId($userId, $uniqueKey)
    {
        if ($userId) {
            $id = $userId->id;
        } else {
            $id = 1;
        }

        $id = $id > 9 ? $id : 0 . $id;
        $uniqueId = $uniqueKey . $id;

        return $uniqueId;
    }

    public const USER_DETAILS = 1;
    public const USER_ACCOUNTS = 2;

    public static function getUserDetailsFilter(string $type = null)
    {
        $types = [
            self::USER_DETAILS  => "Details",
            self::USER_ACCOUNTS => "Accounts",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    // Asset Module Start
    public const ASSET_GOOD = 0;
    public const ASSET_DAMAGE = 1;
    public const ASSET_LOST = 2;

    public static function getAssetStatus(string $type = null)
    {
        $types = [
            self::ASSET_GOOD   => "Good",
            self::ASSET_DAMAGE => "Damage",
            self::ASSET_LOST   => "Lost",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // Asset Module End

    // Start General Status
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public static function getStatus(string $type = null)
    {
        $types = [
            self::STATUS_ACTIVE   => "Active",
            self::STATUS_INACTIVE => "Inactive",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // End General Status

    // Blog Module Start
    public const BLOG_ACTIVE = 1;
    public const BLOG_INACTIVE = 0;

    public static function getBlogStatus(string $type = null)
    {
        $types = [
            self::BLOG_ACTIVE   => "Active",
            self::BLOG_INACTIVE => "Inactive",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // Blog Module End

    // Business Module Start
    public const BUSINESS_RANKING_PLATINUM = 1;
    public const BUSINESS_RANKING_DIAMOND = 2;
    public const BUSINESS_RANKING_GOLD = 3;
    public const BUSINESS_RANKING_SILVER = 4;
    public const BUSINESS_RANKING_BRONGE = 5;

    public static function getBusinessRanking(string $type = null)
    {
        $types = [
            self::BUSINESS_RANKING_PLATINUM => "Platinum",
            self::BUSINESS_RANKING_DIAMOND  => "Diamond",
            self::BUSINESS_RANKING_GOLD     => "Gold",
            self::BUSINESS_RANKING_SILVER   => "Silver",
            self::BUSINESS_RANKING_BRONGE   => "Bronge",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // Business Module End

    // Blog Module Start
    public const PAYMENT_METHOD_STRIPE = 1;
    public const PAYMENT_METHOD_MANUAL = 2;

    public static function getPaymentMethod(string $type = null)
    {
        $types = [
            self::PAYMENT_METHOD_STRIPE => "Stripe",
            self::PAYMENT_METHOD_MANUAL => "Manual",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    // Committee Designation Start
    public const COMMITTEE_PRESIDENT = 'president';
    public const COMMITTEE_VICE_PRESIDENT = 'vice_president';
    public const COMMITTEE_GENERAL_SECRETARY = 'general_secretary';
    public const COMMITTEE_ASSISTANT_GENERAL_SECRETARY = 'assistant_general_secretary';
    public const COMMITTEE_CULTURAL_SECRETARY = 'cultural_secretary';
    public const COMMITTEE_TREASURER = 'treasurer';
    public const COMMITTEE_RELIGIOUS_MEMBERSHIP_SECRETARY = 'religious';
    public const COMMITTEE_EC_MEMBER = 'ec_member';

    public static function getCommitteeDesignation(string $type = null)
    {
        $types = [
            self::COMMITTEE_PRESIDENT                      => 'President',
            self::COMMITTEE_VICE_PRESIDENT                 => 'Vice President',
            self::COMMITTEE_GENERAL_SECRETARY              => 'General Secretary',
            self::COMMITTEE_ASSISTANT_GENERAL_SECRETARY    => 'Assistant General Secretary',
            self::COMMITTEE_CULTURAL_SECRETARY             => 'Cultural Secretary',
            self::COMMITTEE_TREASURER                      => 'Treasurer',
            self::COMMITTEE_RELIGIOUS_MEMBERSHIP_SECRETARY => 'Religious & Membership Secretary',
            self::COMMITTEE_EC_MEMBER                      => 'EC Member',
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    //==========-- Club ---====================//
    public const CLUB_MEMBER_TYPE_GENERAL = 'general';
    public const CLUB_MEMBER_TYPE_COMMITTEE = 'committee';
    public const CLUB_MEMBER_TYPE_FIXED = 'fixed';

    public static function getClubMemberType(string $type = null)
    {
        $types = [
            self::CLUB_MEMBER_TYPE_GENERAL   => 'General',
            self::CLUB_MEMBER_TYPE_COMMITTEE => 'Committee',
            self::CLUB_MEMBER_TYPE_FIXED     => 'Fixed',
        ];

        return $type ? $types[$type] : $types;
    }

    // Club Committee Designation Start
    public const CLUB_COMMITTEE_PRESIDENT = 'president';
    public const CLUB_COMMITTEE_VICE_PRESIDENT = 'vice_president';
    public const CLUB_COMMITTEE_GENERAL_SECRETARY = 'general_secretary';
    public const CLUB_COMMITTEE_ASSISTANT_GENERAL_SECRETARY = 'assistant_general_secretary';
    public const CLUB_COMMITTEE_CULTURAL_SECRETARY = 'cultural_secretary';

    public static function getClubCommitteeDesignation(string $type = null)
    {
        $types = [
            self::CLUB_COMMITTEE_PRESIDENT                   => 'President',
            self::CLUB_COMMITTEE_VICE_PRESIDENT              => 'Vice President',
            self::CLUB_COMMITTEE_GENERAL_SECRETARY           => 'General Secretary',
            self::CLUB_COMMITTEE_ASSISTANT_GENERAL_SECRETARY => 'Assistant General Secretary',
            self::CLUB_COMMITTEE_CULTURAL_SECRETARY          => 'Cultural Secretary',
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    //==========-- Club End ---====================//


    // Payment Status
    public const PAYMENT_METHOD_PENDING = 1;
    public const PAYMENT_METHOD_PROCESSING = 2;
    public const PAYMENT_METHOD_HOLD = 3;
    public const PAYMENT_METHOD_COMPLETED = 4;
    public const PAYMENT_METHOD_DECLINED = 5;

    public static function getPaymentStatus(string $status = null)
    {
        $status_arr = [
            self::PAYMENT_METHOD_PENDING    => "Pending",
            self::PAYMENT_METHOD_PROCESSING => "Processing",
            self::PAYMENT_METHOD_HOLD       => "Hold",
            self::PAYMENT_METHOD_COMPLETED  => "Completed",
            self::PAYMENT_METHOD_DECLINED   => "Declined",
        ];

        return $status ? $status_arr[$status] : $status_arr;
    }

    //=================--- News ---------=============//
    public const NEWS_PUBLISHED = 1;
    public const NEWS_DRAFT = 0;

    public static function getNewsStatus(string $type = null)
    {
        $types = [
            self::NEWS_PUBLISHED => "PUBLISHED",
            self::NEWS_DRAFT     => "DRAFT",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // Blog Module End

    public const PAYMENT_TYPE_BUSINESS = 1;
    public const PAYMENT_TYPE_SUBSCRIPTION = 2;
    public const PAYMENT_TYPE_THANK_YOU = 3;

    public static function getPaymentType(string $type = null)
    {
        $types = [
            self::PAYMENT_TYPE_BUSINESS     => "Business",
            self::PAYMENT_TYPE_SUBSCRIPTION => "Subscriptions",
            self::PAYMENT_TYPE_THANK_YOU    => "Thank You",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }

    // Testimonial Module Start
    public const TESTIMONIAL_ACTIVE = 1;
    public const TESTIMONIAL_INACTIVE = 0;

    public static function getTestimonialStatus(string $type = null)
    {
        $types = [
            self::TESTIMONIAL_ACTIVE   => "Active",
            self::TESTIMONIAL_INACTIVE => "Inactive",
        ];

        if (isset($type) && $type == 0) {
            return $types[$type];
        }

        return $type ? $types[$type] : $types;
    }
    // Testimonial Module End
}
