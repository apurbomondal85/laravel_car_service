<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Club;
use App\Models\User;
use App\Models\Asset;
use App\Models\Career;
use App\Models\Notice;
use App\Models\Ticket;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Business;
use App\Models\AssetSale;
use App\Models\Committee;
use App\Models\ClubMember;
use App\Models\TicketReply;
use App\Models\Transaction;
use App\Models\TicketAssign;
use App\Models\ClubCommittee;
use App\Models\EmailTemplate;

use App\Models\CommitteeMember;
use App\Observers\BlogObserver;
use App\Observers\ClubObserver;
use App\Observers\UserObserver;
use App\Events\Auth\LoggedEvent;
use App\Observers\AssetObserver;
use App\Observers\CareerObserver;
use App\Observers\NoticeObserver;
use App\Observers\TicketObserver;
use App\Observers\ExpenseObserver;
use App\Observers\PaymentObserver;
use App\Observers\BusinessObserver;
use App\Observers\AssetSaleObserver;
use App\Observers\CommitteeObserver;
use App\Observers\ClubMemberObserver;
use App\Listeners\Auth\LoggedListener;
use App\Observers\TicketReplyObserver;
use App\Observers\TransactionObserver;
use App\Observers\TicketAssignObserver;
use App\Events\Notification\CreateEvent;
use App\Events\Notification\DeleteEvent;
use App\Observers\ClubCommitteeObserver;
use App\Observers\EmailTemplateObserver;
use App\Observers\CommitteeMemberObserver;
use App\Listeners\Notification\CreateListener;
use App\Listeners\Notification\DeleteListener;

use App\Events\Transaction\PaymentEvent;
use App\Listeners\Transaction\PaymentListener;
use App\Events\Transaction\MembershipExpireEvent;
use App\Listeners\Transaction\MembershipExpireListener;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        /*
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        */
        LoggedEvent::class => [
            LoggedListener::class
        ],
        //Notification Create Event
        CreateEvent::class => [
            CreateListener::class
        ],
        //Notification Delete Event
        DeleteEvent::class => [
            DeleteListener::class
        ],

        //Payment Event
        PaymentEvent::class => [
            PaymentListener::class
        ],

        //Membership Expire Event
        MembershipExpireEvent::class => [
            MembershipExpireListener::class
        ],

    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        User::class => [UserObserver::class],
        // Role::class                 => [RoleObserver::class],
        // Permission::class           => [PermissionObserver::class],

        Ticket::class          => [TicketObserver::class],
        EmailTemplate::class   => [EmailTemplateObserver::class],
        TicketAssign::class    => [TicketAssignObserver::class],
        TicketReply::class     => [TicketReplyObserver::class],
        Asset::class           => [AssetObserver::class],
        AssetSale::class       => [AssetSaleObserver::class],
        Blog::class            => [BlogObserver::class],
        Business::class        => [BusinessObserver::class],
        Career::class          => [CareerObserver::class],
        Club::class            => [ClubObserver::class],
        ClubMember::class      => [ClubMemberObserver::class],
        ClubCommittee::class   => [ClubCommitteeObserver::class],
        Committee::class       => [CommitteeObserver::class],
        CommitteeMember::class => [CommitteeMemberObserver::class],
        Expense::class         => [ExpenseObserver::class],
        Notice::class          => [NoticeObserver::class],
        Payment::class         => [PaymentObserver::class],
        Transaction::class     => [TransactionObserver::class],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
