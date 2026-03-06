<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#10b981" />

    <title>@yield('title')</title>

    <!-- Google Font: DM Sans & DM Mono -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&family=DM+Sans:wght@300;400;500;600;700&display=swap" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free-V6/css/all.min.css') }}" />
    
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/toastr/toastr.min.css') }}" />
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" />
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}" />
    
    <!-- DataTables  -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('templates/dist/img/cpsulogo.jpg') }}" />
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f8f9fa;
            --surface: #ffffff;
            --border: #e9ecef;
            --text: #212529;
            --text-muted: #6c757d;
            --accent: #7c3aed;
            --accent-hover: #6d28d9;
            --green: #198754;
            --red: #dc3545;
            --amber: #ffc107;
            --purple: #7c3aed;
            --header-h: 60px;
            --sidebar-w: 260px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
            --transition-fast: 0.15s ease;
            --transition-normal: 0.25s ease;
            --transition-smooth: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
            line-height: 1.5;
            overflow-x: hidden;
        }

        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-h);
            background: var(--surface) !important;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 16px;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            cursor: pointer;
            padding: 8px;
            transition: all var(--transition-fast);
        }

        .hamburger span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all var(--transition-normal);
        }

        .hamburger:hover {
            background: var(--bg);
            border-color: var(--accent);
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .header-brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .header-brand-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .header-brand-text span {
            color: #7c3aed;
        }

        .header-search {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 13px;
            color: var(--text-muted);
            width: 280px;
            transition: all var(--transition-fast);
            flex-shrink: 0;
        }

        .header-search:focus-within {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .header-search i {
            font-size: 14px;
            opacity: 0.6;
        }

        .header-search input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            color: var(--text);
            width: 100%;
            font-family: inherit;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all var(--transition-fast);
            position: relative;
            flex-shrink: 0;
        }

        .icon-btn i {
            font-size: 16px;
        }

        .icon-btn:hover {
            background: var(--bg);
            color: var(--text);
            border-color: var(--border);
        }

        .notif-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            min-width: 16px;
            height: 16px;
            background: var(--red);
            border-radius: 99px;
            font-size: 10px;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid var(--surface);
        }

        .dark-toggle-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            border-left: 1px solid var(--border);
            margin-left: 4px;
        }

        .dark-toggle {
            width: 44px;
            height: 24px;
            background: var(--border);
            border-radius: 99px;
            border: none;
            cursor: pointer;
            position: relative;
            transition: all var(--transition-normal);
            flex-shrink: 0;
        }

        .dark-toggle::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            transition: transform var(--transition-normal);
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .user-dropdown {
            position: relative;
            margin-left: 8px;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .user-dropdown-btn:hover {
            background: var(--bg);
            border-color: #7c3aed;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .user-info {
            text-align: left;
            display: none;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.2;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.2;
        }

        .user-dropdown-arrow {
            color: var(--text-muted);
            font-size: 10px;
            transition: transform var(--transition-fast);
        }

        .user-dropdown.open .user-dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 200px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all var(--transition-fast);
            z-index: 1001;
        }

        .user-dropdown.open .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            color: var(--text);
            text-decoration: none;
            transition: all var(--transition-fast);
        }

        .dropdown-item:hover {
            background: var(--bg);
            color: #7c3aed;
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
            color: var(--text-muted);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }

        .layout {
            display: flex;
            padding-top: var(--header-h);
            min-height: 100vh;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity var(--transition-normal);
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.open {
            opacity: 1;
        }

        .main-sidebar {
            width: var(--sidebar-w);
            min-height: calc(100vh - var(--header-h));
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: var(--header-h);
            bottom: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform var(--transition-smooth);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .sidebar-brand-text span {
            color: #7c3aed;
        }

        .sidebar-brand-subtitle {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .sidebar-user-panel {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.03) 0%, rgba(109, 40, 217, 0.03) 100%);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .sidebar-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .sidebar-user-details {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 12px;
            color: #7c3aed;
            font-weight: 500;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 0;
        }

        .nav-sidebar {
            padding: 0;
            list-style: none;
        }

        .nav-header {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 16px 20px 8px;
            opacity: 0.7;
        }

        .nav-item {
            margin: 2px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: all var(--transition-fast);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #7c3aed;
            border-radius: 0 3px 3px 0;
            transition: height var(--transition-fast);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            opacity: 0.7;
            transition: all var(--transition-fast);
        }

        .nav-link p {
            margin: 0;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-link:hover {
            background: var(--bg);
            color: var(--text);
        }

        .nav-link:hover i {
            opacity: 1;
            color: #7c3aed;
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(109, 40, 217, 0.1) 100%);
            color: #7c3aed;
            font-weight: 600;
        }

        .nav-link.active::before {
            height: 24px;
        }

        .nav-link.active i {
            opacity: 1;
            color: #7c3aed;
        }

        .nav-badge {
            background: #7c3aed;
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 99px;
            margin-left: auto;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            color: var(--red);
            border-color: var(--red);
        }

        .content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-w);
            padding: 24px;
            background: var(--bg);
            min-height: calc(100vh - var(--header-h));
            transition: margin-left var(--transition-smooth);
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 20px;
            font-weight: 600;
            color: var(--text);
        }

        .card-body {
            padding: 20px;
        }

        .btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all var(--transition-fast);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9 0%, #5b21b6 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        table.dataTable {
            background: var(--surface);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border) !important;
        }

        table.dataTable thead th {
            background: var(--bg) !important;
            color: var(--text) !important;
            font-weight: 600 !important;
            border-bottom: 2px solid var(--border) !important;
            padding: 14px 16px !important;
            font-size: 12px !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table.dataTable tbody td {
            padding: 12px 16px !important;
            border-bottom: 1px solid var(--border) !important;
            color: var(--text);
            font-size: 13px;
            vertical-align: middle;
        }

        table.dataTable tbody tr:hover {
            background: var(--bg) !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            color: var(--text) !important;
            background: var(--surface) !important;
            font-size: 13px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 8px 12px !important;
            border-radius: 8px !important;
            margin: 0 3px !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            background: var(--surface) !important;
            font-size: 13px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%) !important;
            color: white !important;
            border-color: #7c3aed !important;
        }

        .main-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .main-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-sidebar::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 10px;
        }

        @media (max-width: 1200px) {
            .header-search {
                width: 220px;
            }
        }

        @media (max-width: 992px) {
            :root {
                --sidebar-w: 260px;
            }

            .hamburger {
                display: flex;
            }

            .header-search {
                display: none;
            }

            .main-sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .main-sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(0,0,0,0.15);
            }

            .sidebar-overlay {
                display: block;
            }

            .sidebar-overlay.open {
                pointer-events: all;
            }

            .content-wrapper {
                margin-left: 0;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 0 16px;
                gap: 12px;
            }

            .header-brand-text {
                font-size: 14px;
            }

            .dark-toggle-wrap {
                display: none;
            }

            .content-wrapper {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .header-brand-subtitle {
                display: none;
            }

            .content-wrapper {
                padding: 12px;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <header class="main-header">
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>



            <div class="header-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>

            <div class="header-actions">
                <button class="icon-btn notif-btn" title="Notifications">
                    <i class="far fa-bell"></i>
                    <span class="notif-badge">3</span>
                </button>

                <div class="dark-toggle-wrap">
                    <i class="fas fa-moon" style="font-size: 12px; color: var(--text-muted);"></i>
                    <button class="dark-toggle" id="darkToggle" title="Toggle dark mode"></button>
                </div>

                <div class="user-dropdown" id="userDropdown">
                     <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer;">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form> </div>
            </div>
        </header>

        <div class="layout">
            <aside id="sidebar" class="main-sidebar" >
                <div class="sidebar-brand" style="height:60px;">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <div>
                        <div class="sidebar-brand-text">Path<span>Fit</span></div>
                        <div class="sidebar-brand-subtitle">Coach Dashboard</div>
                    </div>
                </div>

                <div class="sidebar-user-panel">
                    <div class="sidebar-user-info">
                        @php $user = Auth::user(); @endphp
<div class="sidebar-user-avatar">
                            @if($user && $user->photo)
<img src="{{ asset('storage/' . $user->photo) }}" alt="User">
                            @else
                                {{ $user ? substr($user->name ?? 'U', 0, 2) : 'U' }}
                            @endif
                        </div>
                        <div class="sidebar-user-details">
                            <div class="sidebar-user-name">{{ $user->name ?? 'User' }}</div>
                            <div class="sidebar-user-role">Coach</div>
                        </div>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    @include('menu.sidebarcoach')
                </nav>
                                <!-- Sidebar Footer -->
                <div class="sidebar-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </aside>

            <main class="content-wrapper">
                @yield("body")
                @yield("content")
            </main>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Settings</h5>
                <p>Control panel content</p>
            </div>
        </aside>

    </div>

    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('templates/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        @if(Session::has('error'))
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 4000,
        };
        toastr.error("{{ Session::get('error') }}");
        @endif

        @if(Session::has('success'))
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            timeOut: 4000,
        };
        toastr.success("{{ Session::get('success') }}");
        @endif

        $(function () {
            $("#example1").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                language: {
                    search: "Search:",
                    paginate: {
                        previous: '<i class="fas fa-chevron-left"></i>',
                        next: '<i class="fas fa-chevron-right"></i>'
                    }
                }
            });
        });

        const body = document.body;
        const darkToggle = document.getElementById('darkToggle');
        
        if(darkToggle) {
            darkToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
            });
        }

        const userDropdown = document.getElementById('userDropdown');
        
        if(userDropdown) {
            const userDropdownBtn = userDropdown.querySelector('.user-dropdown-btn');
            
            if(userDropdownBtn) {
                userDropdownBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('open');
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('open');
                }
            });
        }

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburger = document.getElementById('hamburger');

        function openSidebar() {
            if(sidebar) sidebar.classList.add('open');
            if(overlay) overlay.classList.add('open');
            if(hamburger) hamburger.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            if(sidebar) sidebar.classList.remove('open');
            if(overlay) overlay.classList.remove('open');
            if(hamburger) hamburger.classList.remove('active');
            document.body.style.overflow = '';
        }

        if(hamburger) {
            hamburger.addEventListener('click', () => {
                if(sidebar && sidebar.classList.contains('open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });
        }
        
        if(overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        if(sidebar) {
            sidebar.querySelectorAll('a').forEach(a => {
                a.addEventListener('click', () => {
                    if (window.innerWidth < 992) closeSidebar();
                });
            });
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>

