@php
    use App\Models\Message;
    $curr_route = request()->route()->getName();
    $user = Auth::user();
    $dashboardActive = in_array($curr_route, ['athlete.dashboard']) ? 'active' : '';
    $trainingScheduleActive = in_array($curr_route, ['user.training-schedule']) ? 'active' : '';
    $assignedCoachActive = in_array($curr_route, ['user.assigned-coach']) ? 'active' : '';
    $reportActivityActive = in_array($curr_route, ['user.report-activity']) ? 'active' : '';
    $sportSuggestionActive = in_array($curr_route, ['athlete.sport-suggestion']) ? 'active' : '';
    $sessionSchedulesActive = in_array($curr_route, ['athlete.session-schedules.index']) ? 'active' : '';
    $messengerActive = in_array($curr_route, ['user.messenger']) ? 'active' : '';
    $profileActive = in_array($curr_route, ['athlete.profile.index']) ? 'active' : '';
    $unreadMessagesCount = Message::where('receiver_id', $user->id)->where('is_read', false)->count();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a href="{{ route('athlete.dashboard') }}" class="nav-link {{ $dashboardActive }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-header">Training</li>

        <!-- Training Schedule -->
        <li class="nav-item">
            <a href="{{ route('user.training-schedule') }}" class="nav-link {{ $trainingScheduleActive }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Training Schedule</p>
            </a>
        </li>

        <!-- Session Schedules -->
        <li class="nav-item">
            <a href="{{ route('athlete.session-schedules.index') }}" class="nav-link {{ $sessionSchedulesActive }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>Session Schedules</p>
            </a>
        </li>

        <!-- Assigned Coach -->
        <li class="nav-item">
            <a href="{{ route('user.assigned-coach') }}" class="nav-link {{ $assignedCoachActive }}">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>Assigned Coach</p>
            </a>
        </li>

        <!-- Report Activity -->
        <li class="nav-item">
            <a href="{{ route('user.report-activity') }}" class="nav-link {{ $reportActivityActive }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>Report Activity</p>
            </a>
        </li>

        <!-- Sport Suggestion -->
        <li class="nav-item">
            <a href="{{ route('athlete.sport-suggestion') }}" class="nav-link {{ $sportSuggestionActive }}">
                <i class="nav-icon fas fa-lightbulb"></i>
                <p>Sport Suggestion</p>
            </a>
        </li>

        <li class="nav-header">Communication</li>

        <!-- Messenger -->
        <li class="nav-item">
            <a href="{{ route('athlete.messages.index') }}" class="nav-link {{ $messengerActive }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                    Messenger
                    @if($unreadMessagesCount > 0)
                        <span class="badge badge-info right" id="unread-messages-count">{{ $unreadMessagesCount }}</span>
                    @endif
                </p>
            </a>
        </li>

        <li class="nav-header">Account</li>

        <!-- Profile -->
        <li class="nav-item">
            <a href="{{ route('athlete.profile.index') }}" class="nav-link {{ $profileActive }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
            </a>
        </li>


    </ul>
</nav>
