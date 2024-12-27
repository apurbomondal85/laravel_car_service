@php
    $user_role = App\Models\User::getAuthUserRole();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @if( $user_role->hasPermission('notification_index'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.notification.index') }}">
                <i class="icon-bell menu-icon"></i>
                <span class="menu-title">Notifications</span>
            </a>
        </li>
        @endif
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product.index') }}">
                <i class="fas fa-server menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>

        @if( $user_role->hasPermission('menu_manage_people'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#managePeople" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-users menu-icon"></i>
                <span class="menu-title">Manage People</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="managePeople">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('client_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.client.index', ['type' => \App\Library\Enum::CLIENT_TYPE_CLIENT]) }}">
                            Client
                        </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('partner_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.partner.index', ['type' => \App\Library\Enum::CLIENT_TYPE_PARTNER]) }}">
                            Partner
                        </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('testimonial_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.testimonial.index') }}">Testimonial</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('team_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.team.index') }}">Team</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('club_index') && false)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.club.index') }}">Club</a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_manage_post'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#website" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-globe menu-icon"></i>
                <span class="menu-title">Manage Post</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="website">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('blog_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.blog.index') }}">Blog</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('career_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.career.index') }}">Career</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('notice_index') && false)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.notice.index') }}">Notice</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('event_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.event.index') }}">Event</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('news_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.news.index') }}">News</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('faqs_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.faqs.index') }}">FAQs</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('gallery_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.gallery.index') }}">
                            Gallery
                        </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('project_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.project.index') }}">
                            Projects
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_manage_user'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manage-user" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-users menu-icon"></i>
                <span class="menu-title">Manage User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manage-user">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('committee_index') && false)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.committee.index') }}">
                            Committee
                        </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('user_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.index') }}">
                            Member
                        </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('subscribers_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.subscribers.index') }}">
                            Subscriber
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_bulk_email') && $user_role->hasPermission('email_index'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.email.index') }}">
                <i class="fas fa-user-shield menu-icon"></i>
                <span class="menu-title">Bulk Email</span>
            </a>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_asset'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#asset" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-computer menu-icon"></i>
                <span class="menu-title">Asset</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="asset">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('asset_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.asset.index') }}">Asset</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('asset_sale_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.asset.sale.index') }}">Asset Sold</a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if(false)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#accounts" aria-expanded="false" aria-controls="tables">
            <i class="fas fa-money-bill-1 menu-icon"></i>
                <span class="menu-title">Accounts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="accounts">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('general_expense_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.expense.index') }}">General Expense</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('transaction_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.transaction.index') }}">Transactions</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('payment_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.payment.index') }}">Payments</a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if(false)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#analyticssss" aria-expanded="false" aria-controls="tables">
                <i class="fa-solid fa-chart-simple menu-icon"></i>
                <span class="menu-title">Analytics</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="analyticssss">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('report_assets'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.report.asset') }}"> Asset Report </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('report_transactions'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.report.transaction') }}"> Transaction Report </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('report_member_status'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.report.memberStatus') }}"> Member Status </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('report_member_signup'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.report.memberSignup') }}"> Member Signup </a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if( $user_role->hasPermission('ticket_index') && false)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                <i class="far fa-envelope menu-icon"></i>
                <span class="menu-title">Tickets</span>
            </a>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_footprint'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-shoe-prints menu-icon"></i>
                <span class="menu-title">Foot Print</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('log_login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.log.login') }}">Login History</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('activity_log_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.log.activity.index') }}">Activity Logs</a>
                    </li>
                    @endif

                </ul>
            </div>
        </li>
        @endif

        @if( $user_role->hasPermission('menu_configuration'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-cogs menu-icon"></i>
                <span class="menu-title">Configuration</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">

                    @if( $user_role->hasPermission('role_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.config.role.index') }}"> Manage Roles </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('dropdown_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.config.dropdown.list') }}"> Dropdown List</a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('pricing_plan_index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pricing_plan.index') }}">Pricing Plan</a>
                    </li>
                     @endif

                    @if( $user_role->hasPermission('setting_email'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.config.email.index') }}"> Email Templates </a>
                    </li>
                    @endif

                    @if( $user_role->hasPermission('general_settings_show'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.config.general.settings') }}"> General Settings </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        @endif

        @if(false)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
        @endif

    </ul>
</nav>


<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>
