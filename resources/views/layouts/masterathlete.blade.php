<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#10b981" />

    <title>PathFit | Athlete Dashboard</title>

    <!-- Google Font: DM Sans & DM Mono -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&family=DM+Sans:wght@300;400;500;600;700&display=swap" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />
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
    <!-- DataTables  -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('templates/dist/img/cpsulogo.jpg') }}" />
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
   
    <style>
        /* ========================================
           CSS VARIABLES & BASE STYLES
           ======================================== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* Colors */
            --bg: #f8f9fa;
            --surface: #ffffff;
            --border: #e9ecef;
            --text: #212529;
            --text-muted: #6c757d;
            --accent: #0d6efd;
            --accent-hover: #0b5ed7;
            --green: #198754;
            --red: #dc3545;
            --amber: #ffc107;
            --purple: #6f42c1;
            
            /* Layout */
            --header-h: 60px;
            --sidebar-w: 260px;
            
            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
            
            /* Transitions */
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

        /* ========================================
           HEADER STYLES (Modern & Responsive)
           ======================================== */
        .headermain {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-h);
            background: var(--surface) !important;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 30px;
            gap: 20px;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: transparent;
            cursor: pointer;
            padding: 8px;
            transition: all var(--transition-fast);
        }

        .hamburger span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all var(--transition-normal);
        }

        .hamburger:hover {
            background: var(--bg);
            border-color: #10b981;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -5px);
        }

        /* Header Brand */
        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .header-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }

        .header-brand-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .header-brand-text span {
            color: #10b981;
        }

        /* Header Search */
        .header-search {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 13px;
            color: var(--text-muted);
            width: 300px;
            transition: all var(--transition-fast);
            flex-shrink: 0;
        }

        .header-search:focus-within {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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

        .header-search input::placeholder {
            color: var(--text-muted);
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Icon Button */
        .icon-btn {
            width: 40px;
            height: 40px;
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
            font-size: 18px;
        }

        .icon-btn:hover {
            background: var(--bg);
            color: var(--text);
            border-color: var(--border);
        }

        /* Notification Badge */
        .notif-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            min-width: 18px;
            height: 18px;
            background: var(--red);
            border-radius: 99px;
            font-size: 10px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border: 2px solid var(--surface);
        }

        /* Dark Mode Toggle */
        .dark-toggle-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            border-left: 1px solid var(--border);
            margin-left: 4px;
        }

        .dark-toggle {
            width: 48px;
            height: 26px;
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
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: white;
            transition: transform var(--transition-normal);
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            margin-left: 4px;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px 6px 8px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .user-dropdown-btn:hover {
            background: var(--bg);
            border-color: #10b981;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .user-info {
            text-align: left;
            display: block;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.2;
        }

        .user-role {
            font-size: 11px;
            color: #10b981;
            font-weight: 500;
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

        /* Dropdown Menu */
        .dropdown-menu-custom {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 220px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-lg);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all var(--transition-fast);
            z-index: 1001;
        }

        .user-dropdown.open .dropdown-menu-custom {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            color: var(--text);
            text-decoration: none;
            transition: all var(--transition-fast);
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .dropdown-item-custom:hover {
            background: var(--bg);
            color: #10b981;
        }

        .dropdown-item-custom i {
            width: 18px;
            text-align: center;
            color: var(--text-muted);
        }

        .dropdown-divider-custom {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }

        /* ========================================
           LAYOUT
           ======================================== */
        .layout {
            display: flex;
            padding-top: var(--header-h);
            min-height: 100vh;
        }

        /* Sidebar Overlay (mobile) */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity var(--transition-normal);
            backdrop-filter: blur(3px);
        }

        .sidebar-overlay.open {
            display: block;
            opacity: 1;
        }

        /* ========================================
           SIDEBAR STYLES (Modern Glass)
           ======================================== */
        .sidebarmain {
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

        /* Sidebar Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .sidebar-brand-text span {
            color: #10b981;
        }

        .sidebar-brand-subtitle {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Sidebar User Panel */
        .sidebar-user-panel {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.04) 0%, rgba(5, 150, 105, 0.04) 100%);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--purple) 100%);
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
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 12px;
            color: #10b981;
            font-weight: 500;
            margin-top: 2px;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

        .nav-sidebar {
            padding: 0;
            list-style: none;
        }

        .nav-header {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 16px 24px 8px;
            opacity: 0.7;
        }

        .nav-item {
            margin: 2px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: all var(--transition-fast);
            position: relative;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #10b981;
            border-radius: 0 3px 3px 0;
            transition: height var(--transition-fast);
        }

        .nav-link i {
            width: 22px;
            text-align: center;
            font-size: 18px;
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
            color: #10b981;
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(5, 150, 105, 0.12) 100%);
            color: #10b981;
            font-weight: 600;
        }

        .nav-link.active::before {
            height: 28px;
        }

        .nav-link.active i {
            opacity: 1;
            color: #10b981;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
            font-family: inherit;
        }

        .logout-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            color: var(--red);
            border-color: var(--red);
        }

        /* ========================================
           CONTENT WRAPPER
           ======================================== */
        .content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-w);
            padding: 28px 32px;
            background: var(--bg);
            min-height: calc(100vh - var(--header-h));
            transition: margin-left var(--transition-smooth);
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* Cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 18px 24px;
            font-weight: 600;
            color: var(--text);
            font-size: 16px;
        }

        .card-body {
            padding: 24px;
        }

        /* Stats Grid Preview */
        .stats-preview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
        }
        .stat-label {
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ========================================
           SCROLLBAR
           ======================================== */
        .sidebarmain::-webkit-scrollbar {
            width: 5px;
        }
        .sidebarmain::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebarmain::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 10px;
        }

        /* ========================================
           RESPONSIVE BREAKPOINTS
           ======================================== */
        @media (max-width: 1200px) {
            .header-search { width: 240px; }
        }

        @media (max-width: 992px) {
            .hamburger { display: flex; }
            .header-search { display: none; }
            .sidebarmain { transform: translateX(-100%); box-shadow: none; }
            .sidebarmain.open { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,0.12); }
            .content-wrapper { margin-left: 0; }
            .user-info { display: none; }
        }

        @media (max-width: 768px) {
            .headermain { padding: 0 16px; gap: 12px; }
            .header-brand-text { font-size: 16px; }
            .dark-toggle-wrap { display: none; }
            .content-wrapper { padding: 20px; }
            .page-title { font-size: 24px; }
        }

        @media (max-width: 480px) {
            .content-wrapper { padding: 16px; }
            .stats-preview { gap: 12px; }
            .stat-number { font-size: 22px; }
        }

        /* Dark Mode Support */
        body.dark-mode {
            --bg: #121826;
            --surface: #1a1f2e;
            --border: #2a2f3f;
            --text: #e2e8f0;
            --text-muted: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Header -->
        <header class="headermain">
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>

            <a href="#" class="header-brand">
                <div class="header-brand-icon">
                    <i class="fas fa-running"></i>
                </div>
                <div class="header-brand-text">
                    Path<span>Fit</span>
                </div>
            </a>



            <div class="header-actions">
                <button class="icon-btn notif-btn" title="Notifications">
                    <i class="far fa-bell"></i>
                    <span class="notif-badge">3</span>
                </button>

                <div class="dark-toggle-wrap">
                    <i class="fas fa-moon" style="font-size: 13px;"></i>
                    <button class="dark-toggle" id="darkToggle" title="Dark mode"></button>
                </div>


                <div class="user-dropdown" id="userDropdown">
                    <div class="user-dropdown-btn">
                         @php $user = Auth::user(); @endphp
                        <div class="sidebar-user-avatar">
                                    @if($user && $user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User">
                            @else
                                {{ $user ? substr($user->name ?? 'U', 0, 2) : 'U' }}
                            @endif 
                        </div>
                        <i class="fas fa-chevron-down user-dropdown-arrow"></i>
                    </div>
                    <div class="dropdown-menu-custom">
                        <a href="{{ route('admin.profile.index') }}" class="dropdown-item-custom">
                            <i class="fas fa-user-circle"></i>
                            <span>My Profile</span>
                        </a>
                        <div class="dropdown-divider-custom"></div>
                   <form method="POST" action="{{ route('logout.post') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                    </div>
                </div>

                   

            </div>
        </header>

        <div class="layout">
            <!-- Sidebar -->
       
             <aside id="sidebar" class="sidebarmain">
                <!-- Sidebar Brand -->
                <div class="sidebar-brand" >
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <div>
                        <div class="sidebar-brand-text">Path<span>Fit</span></div>
                        <div class="sidebar-brand-subtitle">Athlete Dashboard</div>
                    </div>
                </div>

                <!-- Sidebar User Panel -->
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
                            <div class="sidebar-user-role">Athlete</div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Navigation -->
                <nav class="sidebar-nav">
                    @include('menu.sidebarathlete')
                </nav>

                <!-- Sidebar Footer -->
                <div class="sidebar-footer">
                    @auth
                    <form method="POST" action="{{ route('logout.post') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    @endauth
                </div>
            </aside>

            <!-- Content Wrapper -->
            <main class="content-wrapper">
                @yield("body")
                @yield("content")
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Dark mode toggle
        const body = document.body;
        const darkToggle = document.getElementById('darkToggle');
        if(darkToggle) {
            darkToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
            });
        }

        // User dropdown toggle
        const userDropdown = document.getElementById('userDropdown');
        if(userDropdown) {
            const userBtn = userDropdown.querySelector('.user-dropdown-btn');
            if(userBtn) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('open');
                });
            }
            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('open');
                }
            });
        }

        // Mobile sidebar logic
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
                if(sidebar && sidebar.classList.contains('open')) closeSidebar();
                else openSidebar();
            });
        }
        if(overlay) overlay.addEventListener('click', closeSidebar);
        if(sidebar) {
            sidebar.querySelectorAll('a, button').forEach(el => {
                el.addEventListener('click', () => {
                    if (window.innerWidth < 992) closeSidebar();
                });
            });
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) closeSidebar();
        });

        // Logout demo alert
        document.querySelectorAll('#logoutBtn, #sidebarLogoutBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                alert("Logout action (demo)");
            });
        });
    </script>
</body>
</html>