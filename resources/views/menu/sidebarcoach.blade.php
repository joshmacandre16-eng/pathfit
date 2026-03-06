@php
    use App\Models\Message;
    $curr_route = request()->route()->getName();
    $user = Auth::user();
    $dashboardActive = in_array($curr_route, ['coach.dashboard']) ? 'active' : '';
    $athletesActive = in_array($curr_route, ['coach.list', 'coach.athletes.index', 'coach.athletes.show', 'coach.athletes.edit']) ? 'active' : '';
    $trainingSchedulesActive = in_array($curr_route, ['coach.training-schedules.index', 'coach.training-schedules.create', 'coach.training-schedules.show', 'coach.training-schedules.edit']) ? 'active' : '';
    $sessionSchedulesActive = in_array($curr_route, ['coach.session-schedules.index', 'coach.session-schedules.create', 'coach.session-schedules.show', 'coach.session-schedules.edit']) ? 'active' : '';
    $activityReportsActive = in_array($curr_route, ['coach.activity-reports.index']) ? 'active' : '';
    $sportRequirementsActive = in_array($curr_route, ['coach.sport-requirements.index', 'coach.sport-requirements.create', 'coach.sport-requirements.show', 'coach.sport-requirements.edit']) ? 'active' : '';
    $messagesActive = in_array($curr_route, ['coach.messages.index', 'user.messenger']) ? 'active' : '';
    $unreadMessagesCount = Message::where('receiver_id', $user->id)->where('is_read', false)->count();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header" style="color: rgb(0, 0, 0)">Main Navigation</li>

        <li class="nav-item">
            <a href="{{ route('coach.dashboard') }}" class="nav-link {{ $dashboardActive }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.athletes.index') }}" class="nav-link {{ $athletesActive }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Athletes</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.training-schedules.index') }}" class="nav-link {{ $trainingSchedulesActive }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Training Schedules</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.session-schedules.index') }}" class="nav-link {{ $sessionSchedulesActive }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>Session Schedules</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.activity-reports.index') }}" class="nav-link {{ $activityReportsActive }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Activity Reports</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.sport-requirements.index') }}" class="nav-link {{ $sportRequirementsActive }}">
                <i class="nav-icon fas fa-list-check"></i>
                <p>Sport Requirements</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('coach.messages.index') }}" class="nav-link {{ $messagesActive }}">
                <i class="nav-icon fa-solid fa-comments"></i>
                <p>
                    Messages
                    @if($unreadMessagesCount > 0)
                        <span class="badge bg-primary float-right" id="unread-messages-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </p>
            </a>
        </li>

        <li class="nav-header" style="color: rgb(0, 0, 0)">Account</li>
        
        <li class="nav-item">
            <a href="{{ route('coach.profile.index') }}" class="nav-link {{ in_array($curr_route, ['coach.profile.index']) ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-user"></i>
                <p>Profile</p>
            </a>
        </li>

    </ul>
</nav>
