<ul class="dashboard-menu">
    @if(auth()->user()->role == 'designer')
        <a href="{{ route('management.project') }}">
            <li class="{{ Request::is('project-management') ? 'active' : '' }} {{ Request::is('project-management/*') ? 'active' : '' }}"><span>
                <i class="fa fa-cogs" aria-hidden="true"></i> Project Management
            </span></li>
        </a>
        <a href="{{ route('show.profile', auth()->user()->profile->profile_slug) }}">
            <li class="{{ Request::is('designers/*') ? 'active' : '' }}"><span>
                <i class="fa fa-id-card-o" aria-hidden="true"></i> My Profile
            </span></li>
        </a>
    @else
        <a href="{{ route('index.project') }}">
            <li class="sidemenu-section {{ Request::is('your-app-design') ? 'active' : '' }}"><span>
                <i class="fa fa-cogs" aria-hidden="true"></i> Your App Design
            </span></li>
        </a>

        <a href="{{ route('index.businessinfo') }}">
            <li class="{{ Request::is('business-information') ? 'active' : '' }}"><span>
                <i class="fa fa-info-circle" aria-hidden="true"></i> Business Information
            </span></li>
        </a>

        <a href="{{ route('index.times') }}">
            <li class="{{ Request::is('opening-times') ? 'active' : '' }}"><span>
                <i class="fa fa-clock-o" aria-hidden="true"></i> Opening Times
            </span></li>
        </a>

        <a href="{{ route('index.menu') }}">
            <li class="{{ Request::is('menus') ? 'active' : '' }} {{ Request::is('menus/*') ? 'active' : '' }}"><span>
                <i class="fa fa-cutlery" aria-hidden="true"></i> Food & Drink Menus
            </span></li>
        </a>

        <a href="{{ route('index.gallery') }}">
            <li class="{{ Request::is('image-galleries') ? 'active' : '' }} {{ Request::is('image-galleries/*') ? 'active' : '' }}"><span>
                <i class="fa fa-camera" aria-hidden="true"></i> Image Galleries
            </span></li>
        </a>

        <a href="{{ route('index.deals') }}">
            <li class="{{ Request::is('offers') ? 'active' : '' }} {{ Request::is('offers/*') ? 'active' : '' }}"><span>
                <i class="fa fa-ticket" aria-hidden="true"></i> Special Offers
            </span></li>
        </a>

        <a href="{{ route('index.events') }}">
            <li class="{{ Request::is('events') ? 'active' : '' }} {{ Request::is('events/*') ? 'active' : '' }}"><span>
                <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Events
            </span></li>
        </a>

        <a href="{{ route('index.notifications') }}">
            <li class="sidemenu-section {{ Request::is('push-notifications') ? 'active' : '' }}"><span>
                <i class="fa fa-bell-o" aria-hidden="true"></i> Push Notifications
            </span></li>
        </a>

        <a href="{{ route('index.reservations') }}">
            <li class="{{ Request::is('reservations') ? 'active' : '' }} {{ Request::is('reservations/*') ? 'active' : '' }}"><span>
                <i class="fa fa-users" aria-hidden="true"></i> Reservation Enquiries
            </span></li>
        </a>

        <a href="{{ route('index.reviews') }}">
            <li class="{{ Request::is('reviews') ? 'active' : '' }}"><span>
                <i class="fa fa-star-half-o" aria-hidden="true"></i> Customer Reviews
            </span></li>
        </a>

        <a href="{{ route('index.customers') }}">
            <li class="sidemenu-section {{ Request::is('subscribers') ? 'active' : '' }}"><span>
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Subscribers
            </span></li>
        </a>

        <a href="{{ route('account.subscribe') }}">
            <li class="{{ Request::is('account') ? 'active' : '' }}"><span>
                <i class="fa fa-id-card-o" aria-hidden="true"></i> Your Account
            </span></li>
        </a>
    @endif

</ul>
