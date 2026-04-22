<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>PathFit AI - Transform Your Fitness Journey</title>
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
        }

        /* ========== REDESIGNED HEADER & NAVIGATION (Premium Look) ========== */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            padding: 1.2rem 0;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            padding: 0.7rem 0;
            border-bottom: 1px solid rgba(16, 185, 129, 0.15);
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo - Modern & Bold */
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--dark);
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .logo:hover {
            transform: scale(1.02);
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(145deg, var(--primary), #0b9f6e);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 8px 18px rgba(16, 185, 129, 0.3);
            transition: all 0.3s;
        }
        .logo-icon svg {
            width: 24px;
            height: 24px;
            filter: drop-shadow(0 1px 1px rgba(0,0,0,0.1));
        }

        /* Navigation Links - Sleek & Underlined Effect */
        .nav-links {
            display: flex;
            gap: 2.8rem;
            align-items: center;
            list-style: none;
        }

        .nav-links li a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 550;
            font-size: 0.98rem;
            transition: color 0.25s;
            position: relative;
            padding: 0.4rem 0;
        }

        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2.5px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transition: width 0.25s ease;
            border-radius: 2px;
        }

        .nav-links li a:hover::after,
        .nav-links li a.active::after {
            width: 100%;
        }

        .nav-links li a:hover {
            color: var(--primary-dark);
        }

        /* CTA Buttons - Glass & Gradient */
        .nav-cta {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }

        .btn-outline-modern {
            background: transparent;
            border: 1.5px solid var(--gray-light);
            color: var(--dark);
            font-weight: 600;
            padding: 0.55rem 1.4rem;
            border-radius: 40px;
            font-size: 0.9rem;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-modern:hover {
            border-color: var(--primary);
            background: rgba(16, 185, 129, 0.05);
            transform: translateY(-2px);
        }

        .btn-primary-modern {
            background: linear-gradient(105deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.6rem 1.7rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.25);
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 22px rgba(16, 185, 129, 0.35);
            background: linear-gradient(105deg, var(--primary-dark), var(--primary));
        }

        /* Mobile Toggle - Refined */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
        }

        .mobile-toggle span {
            width: 26px;
            height: 2px;
            background: var(--dark);
            transition: all 0.3s;
            border-radius: 4px;
        }

        /* Responsive: Mobile Menu with Login Inside Hamburger */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
                border-bottom: 1px solid rgba(16, 185, 129, 0.2);
            }

            .nav-links.active {
                display: flex;
            }

            .mobile-toggle {
                display: flex;
            }

            /* Hide desktop CTA group on mobile */
            .nav-cta {
                display: none;
            }

            /* Inject mobile login buttons inside .nav-links via JS, but we style them */
            .mobile-cta-wrapper {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                width: 100%;
                margin-top: 0.5rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
            }
            .mobile-cta-wrapper .btn-mobile-login {
                display: block;
                text-align: center;
                background: transparent;
                border: 1.5px solid var(--gray-light);
                color: var(--dark);
                padding: 0.75rem;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.2s;
            }
            .mobile-cta-wrapper .btn-mobile-signup {
                display: block;
                text-align: center;
                background: linear-gradient(105deg, var(--primary), var(--primary-dark));
                color: white;
                padding: 0.75rem;
                border-radius: 50px;
                font-weight: 700;
                text-decoration: none;
                box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
                transition: all 0.2s;
            }
            .mobile-cta-wrapper .btn-mobile-login:hover,
            .mobile-cta-wrapper .btn-mobile-signup:hover {
                transform: translateY(-2px);
            }
        }

        /* Hero Section (Original styles remain intact) */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 3.75rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero-content .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-large {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .btn-hero-secondary {
            background: white;
            color: var(--dark);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-hero-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .hero-badge svg {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(0.95); }
        }

        .hero-features {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .feature-item svg {
            color: var(--primary);
        }

        .athlete-image-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-wrapper {
            position: relative;
            width: 100%;
            height: 70%;
            border-radius: 24px;
            margin-top: -30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(16, 185, 129, 0.2) 100%);
        }

        .hero-visual {
            position: relative;
            height: 600px;
        }

        /* Features Section (unchanged) */
        .features {
            padding: 8rem 2rem;
            background: white;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 5rem;
        }

        .section-tag {
            display: inline-block;
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-header h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.25rem;
            color: var(--gray);
        }

        .features-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2.5rem;
            transition: all 0.4s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--gray);
            line-height: 1.8;
        }

        .steps-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .step-card {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .step-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .step-card p {
            color: var(--gray);
            line-height: 1.7;
        }

        .coaches {
            padding: 8rem 2rem;
            background: white;
        }

        .coaches-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .coach-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.4s;
        }

        .coach-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .coach-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin: 0 auto 1.5rem;
        }

        .coach-avatar-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
        }

        .coach-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .coach-specialty {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .coach-card p {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .cta-section {
            padding: 8rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .cta-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-container h2 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
        }

        .cta-container p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
        }

        .cta-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-white {
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-block;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .btn-outline-white {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-white:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-3px);
        }

        footer {
            background: var(--darker);
            color: white;
            padding: 4rem 2rem 2rem;
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

        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .hero-visual {
                height: 400px;
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .coaches-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .section-header h2 {
                font-size: 2rem;
            }
            .features-grid,
            .steps-grid,
            .coaches-grid {
                grid-template-columns: 1fr;
            }
            .cta-container h2 {
                font-size: 2rem;
            }
            .cta-actions {
                flex-direction: column;
            }
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
        a {
            text-decoration: none;
        }
        .Started {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation - FULLY REDESIGNED (Premium Header) -->
    <nav id="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                PathFit AI
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" onclick="scrollTo('home')">Dashboard</a></li>
                <li><a href="#features" onclick="scrollTo('features')">Features</a></li>
                <li><a href="#coaches" onclick="scrollTo('coaches')">Coaches</a></li>
                <!-- Mobile CTAs will be injected here dynamically -->
            </ul>
            <div class="nav-cta">
                <a href="{{ route('login')}}" class="btn-outline-modern">Log in</a>
                <a href="{{ route('login')}}" class="btn-primary-modern">Start free trial</a>
            </div>
            <div class="mobile-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Unchanged content) -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                    <span>{{ isset($welcomeData['hero']['badge_text']) ? $welcomeData['hero']['badge_text']->value : 'AI-Powered Fitness Platform' }}</span>
                </div>
                <h1>Your AI-Powered <br><span class="gradient-text">{{ isset($welcomeData['hero']['gradient_text']) ? $welcomeData['hero']['gradient_text']->value : 'Fitness Journey' }}</span></h1>
                <p>{{ isset($welcomeData['hero']['subtitle']) ? $welcomeData['hero']['subtitle']->value : 'Experience personalized workout plans, intelligent progress tracking, and adaptive training powered by advanced artificial intelligence' }}</p>
                <div class="hero-actions">
                    <button class="btn-large btn-hero-primary" onclick="scrollTo('features')">
                        <a href="{{ route('login')}}" class="Started">Get Started</a>
                    </button>
                    <button class="btn-large btn-hero-secondary">
                        <a href="#features">Discover More</a>
                    </button>
                </div>
                <div class="hero-features">
                    <div class="feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>{{ isset($welcomeData['hero']['feature_1']) ? $welcomeData['hero']['feature_1']->value : 'Personalized Plans' }}</span>
                    </div>
                    <div class="feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>{{ isset($welcomeData['hero']['feature_2']) ? $welcomeData['hero']['feature_2']->value : 'Real-time Coaching' }}</span>
                    </div>
                    <div class="feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>{{ isset($welcomeData['hero']['feature_3']) ? $welcomeData['hero']['feature_3']->value : 'Progress Analytics' }}</span>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="athlete-image-container">
                    <div class="image-wrapper">
                        <img src="{{ isset($welcomeData['hero']['hero_image']) && $welcomeData['hero']['hero_image']->value ? asset('storage/' . $welcomeData['hero']['hero_image']->value) : asset('templates/dist/img/athlete.jpg') }}" alt="Athletic Training">
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section (unchanged) -->
    <section class="features" id="features">
        <div class="section-header">
            <span class="section-tag">{{ isset($welcomeData['features']['section_tag']) ? $welcomeData['features']['section_tag']->value : 'FEATURES' }}</span>
            <h2>{{ isset($welcomeData['features']['section_title']) ? $welcomeData['features']['section_title']->value : 'Everything You Need to Succeed' }}</h2>
            <p>{{ isset($welcomeData['features']['section_subtitle']) ? $welcomeData['features']['section_subtitle']->value : 'Powered by advanced AI technology to deliver personalized fitness experiences that actually work.' }}</p>
        </div>
        <div class="features-grid"> ... </div>
    </section>

    <!-- How It Works (unchanged) -->
    <section class="how-it-works" id="how-it-works"> ... </section>

    <!-- Coaches Section (unchanged) -->
    <section class="coaches" id="coaches"> ... </section>

    <!-- CTA & Footer unchanged -->
    <section class="cta-section"> ... </section>
    <footer> ... </footer>

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

        // Smooth scroll function
        function scrollTo(id) {
            const element = document.getElementById(id);
            if (element) {
                const offset = 80;
                const elementPosition = element.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                document.getElementById('navLinks').classList.remove('active');
            }
        }

        // Toggle mobile menu
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        // Dynamically inject mobile login buttons inside .nav-links on small screens
        function injectMobileCtas() {
            const navLinks = document.getElementById('navLinks');
            if (!navLinks) return;
            // Check if mobile wrapper already exists to avoid duplication
            if (!document.querySelector('.mobile-cta-wrapper')) {
                const ctaWrapper = document.createElement('div');
                ctaWrapper.className = 'mobile-cta-wrapper';
                ctaWrapper.innerHTML = `
                    <a href="{{ route('login')}}" class="btn-mobile-login">Log in</a>
                    <a href="{{ route('login')}}" class="btn-mobile-signup">Start free trial</a>
                `;
                navLinks.appendChild(ctaWrapper);
            }
        }

        // Intersection Observer for animation (preserved)
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            injectMobileCtas(); // Inject mobile login inside hamburger
            const animateElements = document.querySelectorAll('.feature-card, .step-card, .coach-card');
            animateElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
