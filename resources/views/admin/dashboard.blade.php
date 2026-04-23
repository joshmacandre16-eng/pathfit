@extends('layouts.master')

@section('content')

<style>
    /* ============================================
       DASHBOARD LAYOUT FIX
       ============================================ */

    /* Fix content-wrapper to account for sidebar */
    .content-wrapper {
        margin-left: var(--sidebar-w) !important;
        padding: 1.5rem !important;
        transition: margin-left var(--transition-smooth) !important;
        width: calc(100% - var(--sidebar-w)) !important;
        max-width: none !important;
    }

    /* When sidebar is hidden (mobile) */
    @media (max-width: 991px) {
        .content-wrapper {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 1rem !important;
        }

        .main-sidebar {
            transform: translateX(-100%);
            z-index: 1050 !important;
            box-shadow: var(--shadow-lg);
        }

        .main-sidebar.open {
            transform: translateX(0);
        }

        .hamburger {
            display: flex !important;
        }
    }

    /* Tablet (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .content-wrapper {
            padding: 1.25rem !important;
        }
    }

    /* Mobile (< 768px) */
    @media (max-width: 767px) {
        .content-wrapper {
            padding: 0.75rem !important;
        }
    }

    /* ============================================
       STAT CARDS
       ============================================ */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1199px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 575px) {
        .stat-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }

    .stat-card.blue::before   { background: linear-gradient(90deg, #0d6efd, #6f42c1); }
    .stat-card.green::before  { background: linear-gradient(90deg, #198754, #20c997); }
    .stat-card.amber::before  { background: linear-gradient(90deg, #fd7e14, #ffc107); }
    .stat-card.red::before    { background: linear-gradient(90deg, #dc3545, #e91e8c); }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-muted);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .stat-icon.blue  { background: rgba(13,110,253,0.1); color: #0d6efd; }
    .stat-icon.green { background: rgba(25,135,84,0.1);  color: #198754; }
    .stat-icon.amber { background: rgba(255,193,7,0.15);  color: #fd7e14; }
    .stat-icon.red   { background: rgba(220,53,69,0.1);   color: #dc3545; }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -0.03em;
        line-height: 1;
    }

    .stat-footer {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--text-muted);
        border-top: 1px solid var(--border);
        padding-top: 12px;
        text-decoration: none;
        transition: color 0.15s;
    }

    .stat-footer:hover { color: var(--accent); }
    .stat-footer i { font-size: 11px; }

    @media (max-width: 575px) {
        .stat-card { padding: 14px; gap: 10px; }
        .stat-value { font-size: 22px; }
        .stat-icon { width: 32px; height: 32px; font-size: 14px; }
        .stat-label { font-size: 11px; }
    }

    /* ============================================
       PAGE HEADER
       ============================================ */
    .dash-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .dash-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -0.02em;
        margin: 0;
    }

    .dash-subtitle {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 3px;
    }

    .breadcrumb-bar {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        flex-wrap: wrap;
    }

    .breadcrumb-bar a { color: var(--accent); text-decoration: none; }
    .breadcrumb-bar a:hover { text-decoration: underline; }
    .breadcrumb-bar .sep { color: var(--text-muted); opacity: 0.5; font-size: 11px; }
    .breadcrumb-bar .current { color: var(--text-muted); }

    @media (max-width: 575px) {
        .dash-title { font-size: 18px; }
        .breadcrumb-bar { display: none; }
    }

    /* ============================================
       RECENT USERS TABLE
       ============================================ */
    .dash-table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .dash-table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 10px;
    }

    .dash-table-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dash-table-title i {
        color: var(--accent);
        font-size: 14px;
    }

    .view-all-btn {
        font-size: 12px;
        font-weight: 600;
        color: var(--accent);
        text-decoration: none;
        padding: 6px 14px;
        border: 1px solid var(--accent);
        border-radius: 8px;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .view-all-btn:hover {
        background: var(--accent);
        color: white;
    }

    .dash-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .dash-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 500px;
    }

    .dash-table thead th {
        background: #f8f9fa;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-muted);
        padding: 12px 20px;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .dash-table tbody td {
        padding: 14px 20px;
        font-size: 13px;
        color: var(--text);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .dash-table tbody tr:last-child td {
        border-bottom: none;
    }

    .dash-table tbody tr:hover td {
        background: rgba(13,110,253,0.03);
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-mini-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #0d6efd, #6f42c1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-mini-name { font-weight: 500; }
    .user-mini-id { font-size: 11px; color: var(--text-muted); }

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .role-badge.admin  { background: rgba(13,110,253,0.1);  color: #0d6efd; }
    .role-badge.coach  { background: rgba(25,135,84,0.1);   color: #198754; }
    .role-badge.player { background: rgba(111,66,193,0.1);  color: #6f42c1; }
    .role-badge.user   { background: rgba(108,117,125,0.1); color: #6c757d; }

    .date-text { color: var(--text-muted); font-size: 12px; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: var(--text-muted);
    }
    .empty-state i { font-size: 40px; opacity: 0.2; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 14px; }
</style>

<!-- Dashboard Page Header -->
<div class="dash-header">
    <div>
        <div class="breadcrumb-bar">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home" style="font-size:11px;"></i></a>
            <span class="sep">›</span>
            <span class="current">Dashboard</span>
        </div>
        <h1 class="dash-title">Admin Dashboard</h1>
        <p class="dash-subtitle">Welcome back! Here's what's happening today.</p>
    </div>
</div>

<!-- Stat Cards -->
<div class="stat-grid">
    <!-- Total Users -->
    <div class="stat-card blue">
        <div class="stat-header">
            <span class="stat-label">Total Users</span>
            <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        </div>
        <div class="stat-value">{{ $users->count() }}</div>
        <a href="{{ route('admin.users.index') }}" class="stat-footer">
            <span>View all users</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Coaches -->
    <div class="stat-card green">
        <div class="stat-header">
            <span class="stat-label">Coaches</span>
            <div class="stat-icon green"><i class="fas fa-user-tie"></i></div>
        </div>
        <div class="stat-value">
            {{ isset($coaches) ? $coaches->count() : $users->where('role','coach')->count() }}
        </div>
        <a href="{{ route('admin.coach.index') }}" class="stat-footer">
            <span>Manage coaches</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Players -->
    <div class="stat-card amber">
        <div class="stat-header">
            <span class="stat-label">Players</span>
            <div class="stat-icon amber"><i class="fas fa-running"></i></div>
        </div>
        <div class="stat-value">
            {{ $users->where('role','player')->count() }}
        </div>
        <a href="{{ route('admin.player-status') }}" class="stat-footer">
            <span>Player status</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Sports Available -->
    <div class="stat-card red">
        <div class="stat-header">
            <span class="stat-label">Sports</span>
            <div class="stat-icon red"><i class="fas fa-trophy"></i></div>
        </div>
        <div class="stat-value">
            {{ isset($sports) ? $sports->count() : '—' }}
        </div>
        <a href="{{ route('admin.sport_available.index') }}" class="stat-footer">
            <span>View sports</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<!-- Recent Users Table -->
<div class="dash-table-card">
    <div class="dash-table-header">
        <div class="dash-table-title">
            <i class="fas fa-clock"></i>
            Recent Users
        </div>
        <a href="{{ route('admin.users.index') }}" class="view-all-btn">
            View All →
        </a>
    </div>
    <div class="dash-table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users->sortByDesc('created_at')->take(5) as $u)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-mini-avatar">
                                {{ strtoupper(substr($u->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <div class="user-mini-name">{{ $u->name }}</div>
                                <div class="user-mini-id">#{{ $u->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="role-badge {{ strtolower($u->role ?? 'user') }}">
                            {{ $u->role ?? 'user' }}
                        </span>
                    </td>
                    <td>
                        <span class="date-text">
                            {{ $u->created_at ? $u->created_at->format('M d, Y') : '—' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <p>No users found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Hamburger toggle fix — reinforce sidebar open/close for mobile/tablet
    (function () {
        const hamburger = document.getElementById('hamburger');
        const sidebar   = document.getElementById('sidebar');
        const overlay   = document.getElementById('sidebarOverlay');

        if (!hamburger || !sidebar) return;

        function openSidebar() {
            sidebar.classList.add('open');
            if (overlay) overlay.classList.add('open');
            hamburger.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('open');
            hamburger.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Remove existing listeners by cloning
        const newHamburger = hamburger.cloneNode(true);
        hamburger.parentNode.replaceChild(newHamburger, hamburger);

        newHamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close on nav link click on mobile
        sidebar.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth < 992) closeSidebar();
            });
        });

        // Responsive: auto-close on large screens
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    })();
</script>

<style>
    /* Hamburger always visible on mobile/tablet */
    @media (max-width: 991px) {
        .hamburger {
            display: flex !important;
        }
    }
    @media (min-width: 992px) {
        .hamburger {
            display: none !important;
        }
        .main-sidebar {
            transform: translateX(0) !important;
        }
        .content-wrapper {
            margin-left: var(--sidebar-w) !important;
            width: calc(100% - var(--sidebar-w)) !important;
        }
    }
</style>
@endpush