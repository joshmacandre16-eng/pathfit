<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@switch($slug)
        @case('privacy-policy')Privacy Policy - PathFit AI@break
        @case('information-we-collect')Information We Collect - PathFit AI@break
        @case('how-we-use')How We Use Your Information - PathFit AI@break
        @case('data-protection')Data Protection - PathFit AI@break
        @case('cookies')Cookies & Tracking - PathFit AI@break
        @case('third-party')Third-Party Services - PathFit AI@break
        @case('your-rights')Your Rights - PathFit AI@break
        @case('childrens-privacy')Children's Privacy - PathFit AI@break
        @case('changes')Changes to Policy - PathFit AI@break
        @default Privacy Policy - PathFit AI
    @endswitch</title>
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #34d399;
            --secondary: #6366f1;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
            background: var(--light);
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1.25rem 0;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a.active {
            color: var(--primary);
        }

        .nav-cta {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-secondary {
            color: var(--dark);
            font-weight: 600;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: rgba(16, 185, 129, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-back {
            background: white;
            color: var(--dark);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #e2e8f0;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: var(--light);
        }

        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-toggle span {
            width: 24px;
            height: 2px;
            background: var(--dark);
            transition: all 0.3s;
            border-radius: 2px;
        }

        /* Page Header */
        .page-header {
            padding: 8rem 2rem 4rem;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-header-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .page-header p {
            font-size: 1.25rem;
            color: var(--gray);
            line-height: 1.8;
        }

        .last-updated {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-top: 1.5rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        /* Back Button */
        .back-container {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
        }

        /* Breadcrumb */
        .breadcrumb {
            max-width: 900px;
            margin: 0 auto;
            padding: 1.5rem 2rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--gray);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb span {
            color: var(--gray);
            font-size: 0.875rem;
        }

        .breadcrumb .current {
            color: var(--primary);
            font-weight: 600;
        }

        /* Content Section */
        .content-section {
            padding: 3rem 2rem 5rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .policy-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .policy-section:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .policy-section h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .policy-section h2 .icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            flex-shrink: 0;
        }

        .policy-section h2 .icon svg {
            width: 16px;
            height: 16px;
        }

        .policy-section p {
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .policy-section ul {
            list-style: none;
            margin-top: 1rem;
        }

        .policy-section ul li {
            color: var(--gray);
            line-height: 1.8;
            padding-left: 1.5rem;
            position: relative;
            margin-bottom: 0.5rem;
        }

        .policy-section ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
        }

        .policy-section a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .policy-section a:hover {
            text-decoration: underline;
        }

        .highlight-box {
            background: rgba(16, 185, 129, 0.05);
            border-left: 4px solid var(--primary);
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
            margin: 1.5rem 0;
        }

        .highlight-box p {
            margin: 0;
            color: var(--dark);
        }

        /* Page Navigation */
        .page-nav {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .page-nav a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            transition: all 0.3s;
        }

        .page-nav a:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .page-nav a.next {
            margin-left: auto;
        }

        /* Table of Contents */
        .toc-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .toc-section h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        .toc-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 0.75rem;
        }

        .toc-list a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: var(--light);
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            transition: all 0.3s;
        }

        .toc-list a:hover {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary);
            transform: translateX(4px);
        }

        .toc-list a .number {
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Contact Section */
        .contact-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            margin-top: 3rem;
        }

        .contact-section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .contact-section h2 .icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .contact-section p {
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--gray);
        }

        .contact-item .icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Footer */
        footer {
            background: var(--darker);
            color: white;
            padding: 4rem 2rem 2rem;
            margin-top: 5rem;
        }

        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-brand p {
            color: var(--gray-light);
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            color: white;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-section h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-section a {
            display: block;
            color: var(--gray-light);
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            text-align: center;
            color: var(--gray-light);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 2rem;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                display: flex;
            }

            .mobile-toggle {
                display: flex;
            }

            .page-header {
                padding: 6rem 1.5rem 3rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .page-header p {
                font-size: 1rem;
            }

            .back-container {
                position: static;
                margin-bottom: 1rem;
            }

            .breadcrumb {
                padding: 1rem 1.5rem 0;
            }

            .content-section {
                padding: 2rem 1.5rem;
            }

            .policy-section {
                padding: 1.5rem;
            }

            .policy-section h2 {
                font-size: 1.25rem;
            }

            .toc-list {
                grid-template-columns: 1fr;
            }

            .contact-section {
                padding: 2rem 1.5rem;
            }

            .contact-info {
                flex-direction: column;
                gap: 1rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .page-nav {
                flex-direction: column;
            }

            .page-nav a.next {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                PathFit AI
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="/#home">Home</a></li>
                <li><a href="/#features">Features</a></li>
                <li><a href="/#coaches">Coaches</a></li>
            </ul>
            <div class="nav-cta">
                <a href="{{ route('login') }}" class="btn-primary">Login</a>
            </div>
            <div class="mobile-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb">
        <a href="/">Home</a>
        <span>/</span>
        <a href="{{ route('privacy', 'privacy-policy') }}">Privacy Policy</a>
        <span>/</span>
        @switch($slug)
            @case('privacy-policy')
                <span class="current">Overview</span>
            @break
            @case('information-we-collect')
                <span class="current">Information We Collect</span>
            @break
            @case('how-we-use')
                <span class="current">How We Use Your Information</span>
            @break
            @case('data-protection')
                <span class="current">Data Protection</span>
            @break
            @case('cookies')
                <span class="current">Cookies & Tracking</span>
            @break
            @case('third-party')
                <span class="current">Third-Party Services</span>
            @break
            @case('your-rights')
                <span class="current">Your Rights</span>
            @break
            @case('childrens-privacy')
                <span class="current">Children's Privacy</span>
            @break
            @case('changes')
                <span class="current">Changes to Policy</span>
            @break
            @case('contact')
                <span class="current">Contact Us</span>
            @break
            @default
                <span class="current">Privacy Policy</span>
        @endswitch
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="back-container">
            <a href="/" class="btn-back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
        </div>
        <div class="page-header-content">
            @switch($slug)
                @case('privacy-policy')
                    <h1>Privacy Policy</h1>
                    <p>Your privacy is important to us. This policy outlines how we collect, use, and protect your personal information when you use PathFit AI.</p>
                @break
                @case('information-we-collect')
                    <h1>Information We Collect</h1>
                    <p>We collect various types of information to provide and improve our services to you.</p>
                @break
                @case('how-we-use')
                    <h1>How We Use Your Information</h1>
                    <p>Learn how we use the information we collect to power our AI-powered fitness services.</p>
                @break
                @case('data-protection')
                    <h1>Data Protection</h1>
                    <p>We implement robust security measures to protect your personal information.</p>
                @break
                @case('cookies')
                    <h1>Cookies & Tracking</h1>
                    <p>Understanding how we use cookies and tracking technologies on our platform.</p>
                @break
                @case('third-party')
                    <h1>Third-Party Services</h1>
                    <p>Information about third-party services that may have access to your data.</p>
                @break
                @case('your-rights')
                    <h1>Your Rights</h1>
                    <p>Understand your rights regarding the collection and use of your personal data.</p>
                @break
                @case('childrens-privacy')
                    <h1>Children's Privacy</h1>
                    <p>How we handle the privacy of children using our platform.</p>
                @break
                @case('changes')
                    <h1>Changes to This Policy</h1>
                    <p>Information about how we update and notify you of changes to this policy.</p>
                @break
                @case('contact')
                    <h1>Contact Us</h1>
                    <p>Get in touch with us for any privacy-related questions or concerns.</p>
                @break
                @default
                    <h1>Privacy Policy</h1>
                    <p>Your privacy is important to us. This policy outlines how we collect, use, and protect your personal information when you use PathFit AI.</p>
            @endswitch
            <div class="last-updated">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Last Updated: January 2024
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        
        @switch($slug)
            {{-- Privacy Policy Overview --}}
            @case('privacy-policy')
                <div class="toc-section">
                    <h3>Privacy Policy Sections</h3>
                    <ul class="toc-list">
                        <li><a href="{{ route('privacy', 'information-we-collect') }}"><span class="number">1</span> Information We Collect</a></li>
                        <li><a href="{{ route('privacy', 'how-we-use') }}"><span class="number">2</span> How We Use Your Information</a></li>
                        <li><a href="{{ route('privacy', 'data-protection') }}"><span class="number">3</span> How We Protect Your Data</a></li>
                        <li><a href="{{ route('privacy', 'cookies') }}"><span class="number">4</span> Cookies & Tracking</a></li>
                        <li><a href="{{ route('privacy', 'third-party') }}"><span class="number">5</span> Third-Party Services</a></li>
                        <li><a href="{{ route('privacy', 'your-rights') }}"><span class="number">6</span> Your Rights</a></li>
                        <li><a href="{{ route('privacy', 'childrens-privacy') }}"><span class="number">7</span> Children's Privacy</a></li>
                        <li><a href="{{ route('privacy', 'changes') }}"><span class="number">8</span> Changes to This Policy</a></li>
                        <li><a href="{{ route('privacy', 'contact') }}"><span class="number">9</span> Contact Us</a></li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </span>
                        Introduction
                    </h2>
                    <p>PathFit AI ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how your personal information is collected, used, disclosed, and safeguarded by us when you use our AI-powered fitness platform.</p>
                    <p>By accessing or using PathFit AI, you agree to the terms of this Privacy Policy. If you do not agree with the practices described in this policy, please do not use our services.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'information-we-collect') }}" class="next">
                        Next: Information We Collect
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Information We Collect --}}
            @case('information-we-collect')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                            </svg>
                        </span>
                        Information We Collect
                    </h2>
                    <p>We collect information to provide better services to all our users. This includes:</p>
                    <ul>
                        <li><strong>Personal Information:</strong> Name, email address, phone number, and profile information you provide when creating an account</li>
                        <li><strong>Health & Fitness Data:</strong> Fitness goals, workout history, body measurements, health conditions, and training preferences</li>
                        <li><strong>Usage Data:</strong> Information about how you interact with our platform, including workout sessions, features used, and time spent on the app</li>
                        <li><strong>Device Information:</strong> Device type, operating system, browser type, and unique device identifiers</li>
                        <li><strong>Location Data:</strong> General location information (with your consent) to provide location-based features</li>
                        <li><strong>Social Media Data:</strong> Information from social media platforms when you choose to connect your social accounts</li>
                    </ul>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'privacy-policy') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Overview
                    </a>
                    <a href="{{ route('privacy', 'how-we-use') }}" class="next">
                        Next: How We Use Your Information
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- How We Use Your Information --}}
            @case('how-we-use')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                            </svg>
                        </span>
                        How We Use Your Information
                    </h2>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Provide, maintain, and improve our AI-powered fitness services</li>
                        <li>Generate personalized workout plans and recommendations based on your goals and fitness level</li>
                        <li>Track your progress and provide detailed analytics and insights</li>
                        <li>Communicate with you about your account, workouts, and updates</li>
                        <li>Respond to your comments, questions, and provide customer support</li>
                        <li>Send you technical notices, updates, security alerts, and support messages</li>
                        <li>Monitor and analyze trends, usage, and activities in connection with our services</li>
                        <li>Detect, investigate, and prevent fraudulent transactions and other illegal activities</li>
                        <li>Comply with our legal obligations and enforce our terms and policies</li>
                    </ul>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'information-we-collect') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Information We Collect
                    </a>
                    <a href="{{ route('privacy', 'data-protection') }}" class="next">
                        Next: Data Protection
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Data Protection --}}
            @case('data-protection')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        How We Protect Your Data
                    </h2>
                    <p>We implement appropriate technical and organizational measures to protect your personal information, including:</p>
                    <ul>
                        <li>Encryption of data in transit and at rest using industry-standard encryption protocols</li>
                        <li>Regular security audits and vulnerability assessments</li>
                        <li>Access controls limiting employee access to personal information on a need-to-know basis</li>
                        <li>Secure storage practices and data backup procedures</li>
                        <li>Employee training on data protection and privacy</li>
                        <li>Incident response procedures for potential data breaches</li>
                    </ul>
                    <div class="highlight-box">
                        <p><strong>Your Responsibility:</strong> You are responsible for maintaining the confidentiality of your account credentials and for any activities under your account. Please notify us immediately if you suspect unauthorized access to your account.</p>
                    </div>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'how-we-use') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: How We Use Your Information
                    </a>
                    <a href="{{ route('privacy', 'cookies') }}" class="next">
                        Next: Cookies & Tracking
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Cookies and Tracking --}}
            @case('cookies')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/>
                                <path d="M8.5 8.5v.01"/>
                                <path d="M16 15.5v.01"/>
                                <path d="M12 12v.01"/>
                                <path d="M11 17v.01"/>
                                <path d="M7 14v.01"/>
                            </svg>
                        </span>
                        Cookies and Tracking Technologies
                    </h2>
                    <p>We use cookies and similar tracking technologies to enhance your experience on our platform. These technologies help us:</p>
                    <ul>
                        <li>Keep you logged in and remember your preferences</li>
                        <li>Understand how you use our services and improve them</li>
                        <li>Personalize content and recommendations based on your interests</li>
                        <li>Measure the effectiveness of our marketing campaigns</li>
                    </ul>
                    <p>You can control cookies through your browser settings. However, disabling certain cookies may affect the functionality of our services.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'data-protection') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Data Protection
                    </a>
                    <a href="{{ route('privacy', 'third-party') }}" class="next">
                        Next: Third-Party Services
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Third-Party Services --}}
            @case('third-party')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </span>
                        Third-Party Services
                    </h2>
                    <p>Our platform may contain links to third-party websites, services, or applications that are not operated by us. We are not responsible for the privacy practices of these third parties. We encourage you to review the privacy policies of any third-party services you access.</p>
                    <p>We may share your information with:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> Companies that help us operate our platform (e.g., hosting, analytics, payment processing)</li>
                        <li><strong>Coaches & Trainers:</strong> If you choose to work with a coach through our platform</li>
                        <li><strong>Legal Requirements:</strong> When required by law, regulation, or court order</li>
                        <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of company assets</li>
                    </ul>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'cookies') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Cookies & Tracking
                    </a>
                    <a href="{{ route('privacy', 'your-rights') }}" class="next">
                        Next: Your Rights
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Your Rights --}}
            @case('your-rights')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        Your Rights
                    </h2>
                    <p>You have the following rights regarding your personal information:</p>
                    <ul>
                        <li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
                        <li><strong>Correction:</strong> Request correction of inaccurate or incomplete data</li>
                        <li><strong>Deletion:</strong> Request deletion of your personal information (subject to legal requirements)</li>
                        <li><strong>Data Portability:</strong> Request a copy of your data in a structured, machine-readable format</li>
                        <li><strong>Opt-Out:</strong> Opt-out of certain data uses, including marketing communications</li>
                        <li><strong>Withdraw Consent:</strong> Withdraw consent for processing where consent was the legal basis</li>
                    </ul>
                    <p>To exercise these rights, please contact us using the information provided below.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'third-party') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Third-Party Services
                    </a>
                    <a href="{{ route('privacy', 'childrens-privacy') }}" class="next">
                        Next: Children's Privacy
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Children's Privacy --}}
            @case('childrens-privacy')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </span>
                        Children's Privacy
                    </h2>
                    <p>Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child under 13, please contact us immediately so we can remove such information.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'your-rights') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Your Rights
                    </a>
                    <a href="{{ route('privacy', 'changes') }}" class="next">
                        Next: Changes to Policy
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Changes to Policy --}}
            @case('changes')
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 4 23 10 17 10"/>
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
                            </svg>
                        </span>
                        Changes to This Policy
                    </h2>
                    <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for operational, legal, or regulatory reasons. We will post any changes on this page and update the "Last Updated" date at the top of this policy.</p>
                    <p>We encourage you to review this Privacy Policy periodically to stay informed about how we protect your information. Your continued use of our services after any changes constitutes acceptance of the updated policy.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'childrens-privacy') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Children's Privacy
                    </a>
                    <a href="{{ route('privacy', 'contact') }}" class="next">
                        Next: Contact Us
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Contact Us --}}
            @case('contact')
                <div class="contact-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </span>
                        Questions? Contact Us
                    </h2>
                    <p>If you have any questions or concerns about this Privacy Policy or our data practices, please reach out to us.</p>
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <span>support@pathfit-ai.com</span>
                        </div>
                        <div class="contact-item">
                            <div class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <div class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <span>123 Fitness Street, Tech City, TC 12345</span>
                        </div>
                    </div>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'changes') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Previous: Changes to Policy
                    </a>
                    <a href="{{ route('privacy', 'privacy-policy') }}" class="next">
                        Back to Overview
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @break

            {{-- Default fallback --}}
            @default
                <div class="policy-section">
                    <h2>
                        <span class="icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </span>
                        Introduction
                    </h2>
                    <p>PathFit AI ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how your personal information is collected, used, disclosed, and safeguarded by us when you use our AI-powered fitness platform.</p>
                    <p>By accessing or using PathFit AI, you agree to the terms of this Privacy Policy. If you do not agree with the practices described in this policy, please do not use our services.</p>
                </div>

                <div class="page-nav">
                    <a href="{{ route('privacy', 'information-we-collect') }}" class="next">
                        Next: Information We Collect
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
        @endswitch

    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h3>PathFit AI</h3>
                <p>Revolutionizing fitness through AI-powered training and personalized coaching for athletes of all levels.</p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Product</h4>
                <a href="/#features">Features</a>
                <a href="/#coaches">Coaches</a>
                <a href="#">Pricing</a>
                <a href="#">Mobile App</a>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <a href="#">About Us</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
                <a href="#">Press Kit</a>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <a href="#">Help Center</a>
                <a href="#">Video Tutorials</a>
                <a href="#">Community</a>
                <a href="#">Success Stories</a>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <a href="{{ route('privacy', 'privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('term', 'terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('cookie', 'cookie-policy') }}">Cookie Policy</a>
                <a href="{{ route('disclaimer', 'disclaimer') }}">Disclaimer</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 PathFit AI. All rights reserved. Powered by advanced artificial intelligence.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Toggle mobile menu
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    document.getElementById('navLinks').classList.remove('active');
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>

