@php
    $curr_route = request()->route()->getName();
    $user = Auth::user();
    $dashboardActive = in_array($curr_route, ['admin.dashboard']) ? 'active' : '';
    $usersActive = in_array($curr_route, ['admin.users.index', 'admin.users.create', 'admin.users.edit']) ? 'active' : '';
    $coachActive = in_array($curr_route, ['admin.coach.index']) ? 'active' : '';
    $playerStatusActive = in_array($curr_route, ['admin.player-status']) ? 'active' : '';
    $trainingScheduleActive = in_array($curr_route, ['admin.training-schedule']) ? 'active' : '';
    $profileActive = in_array($curr_route, ['admin.profile']) ? 'active' : '';
    $sportActivityActive = in_array($curr_route, ['admin.sport_activity']) ? 'active' : '';
    $sportAvailableActive = in_array($curr_route, ['admin.sport_available']) ? 'active' : '';
    $assignCoachActive = in_array($curr_route, ['admin.assigncoach']) ? 'active' : '';
    $welcomeContentActive = in_array($curr_route, ['admin.welcome-content.index', 'admin.welcome-content.edit']) ? 'active' : '';
    $footerLinksActive = in_array($curr_route, ['admin.footer-links.index', 'admin.footer-links.create', 'admin.footer-links.edit']) ? 'active' : '';
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Main Navigation</li>

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $dashboardActive }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ $usersActive }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Users Management</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.coach.index') }}" class="nav-link {{ $coachActive }}">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Coaches</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.player-status') }}" class="nav-link {{ $playerStatusActive }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Player Status</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.training-schedule.index') }}" class="nav-link {{ $trainingScheduleActive }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Training Schedule</p>
            </a>
        </li>

         <li class="nav-item">
            <a href="{{ route('admin.sport_activity.index') }}" class="nav-link {{ $sportActivityActive }}">
                <i class="nav-icon fas fa-running"></i>
                <p>Sport Activity</p>
            </a>
        </li>
       <li class="nav-item">
            <a href="{{ route('admin.sport_available.index') }}" class="nav-link {{ $sportAvailableActive }}">
                <i class="nav-icon fas fa-list"></i>
                <p>Sport Available</p>
            </a>
        </li>

         <li class="nav-item">
            <a href="{{ route('admin.assigncoach.index') }}" class="nav-link {{ $assignCoachActive }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Coach Assign To The Sports</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.welcome-content.index') }}" class="nav-link {{ $welcomeContentActive }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Welcome Page Content</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.footer-links.index') }}" class="nav-link {{ $footerLinksActive }}">
                <i class="nav-icon fas fa-link"></i>
                <p>Footer Links</p>
            </a>
        </li>
        
      <li class="nav-item">
            <a href="{{ route('admin.profile.index') }}" class="nav-link {{ $profileActive }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
            </a>
        </li>

    </ul>
</nav>

