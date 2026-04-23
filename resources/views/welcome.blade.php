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
            --primary-soft: #ecfdf5;
            --secondary: #6366f1;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f8fafc;
            --gray: #475569;
            --gray-light: #cbd5e1;
            --card-radius: 28px;
            --shadow-sm: 0 12px 28px -8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 20px 32px -12px rgba(0, 0, 0, 0.08);
            --transition: all 0.35s cubic-bezier(0.2, 0.95, 0.4, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.5;
            background: white;
        }

          body::-webkit-scrollbar {
            display: none;
        }      /* ========== PREMIUM HEADER ========== */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: var(--transition);
            padding: 1.2rem 0;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(18px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.03);
            padding: 0.7rem 0;
            border-bottom: 1px solid rgba(16, 185, 129, 0.2);
        }

        .nav-container {
            max-width: 1320px;
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
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 10px 20px -6px rgba(16, 185, 129, 0.35);
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .nav-links {
            display: flex;
            gap: 2.8rem;
            align-items: center;
            list-style: none;
        }

        .nav-links li a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 570;
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
            border-radius: 4px;
        }

        .nav-links li a:hover::after,
        .nav-links li a.active::after {
            width: 100%;
        }

        .nav-links li a:hover {
            color: var(--primary-dark);
        }

        .nav-cta {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }

        .btn-outline-modern {
            background: transparent;
            border: 1.5px solid #e2e8f0;
            color: var(--dark);
            font-weight: 600;
            padding: 0.55rem 1.4rem;
            border-radius: 60px;
            font-size: 0.9rem;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
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
            border-radius: 60px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.25);
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 22px rgba(16, 185, 129, 0.35);
        }

        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
            min-width: 44px;
            min-height: 44px;
            justify-content: center;
            align-items: center;
        }

        .mobile-toggle span {
            width: 26px;
            height: 2px;
            background: var(--dark);
            transition: all 0.3s;
            border-radius: 4px;
        }

        /* ========== HERO REFINED ========== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(125deg, #f9fef7 0%, #eef9ef 100%);
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 70%;
            height: 100%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: var(--dark);
            line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-content .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--gray);
            margin-bottom: 2.5rem;
            line-height: 1.6;
            max-width: 90%;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .btn-large {
            padding: 1rem 2.2rem;
            font-size: 1rem;
            border-radius: 60px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            min-height: 52px;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 12px 24px -12px rgba(16, 185, 129, 0.45);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 28px -12px rgba(16, 185, 129, 0.5);
        }

        .btn-hero-secondary {
            background: white;
            color: var(--dark);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .btn-hero-secondary:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 12px 20px -10px rgba(0, 0, 0, 0.1);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.12);
            color: var(--primary-dark);
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(2px);
        }

        .hero-features {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
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
            flex-shrink: 0;
        }

        .hero-visual {
            position: relative;
            width: 100%;
        }

        .image-wrapper {
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 45px -20px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s;
        }

        .image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(16, 185, 129, 0.1) 100%);
            pointer-events: none;
        }

        /* ========== FEATURES ENHANCED ========== */
        .features {
            padding: clamp(3rem, 8vw, 7rem) 2rem;
            background: white;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem;
            padding: 0 1rem;
        }

        .section-tag {
            display: inline-block;
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-dark);
            padding: 0.4rem 1.2rem;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 0.3px;
        }

        .section-header h2 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-header p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--gray);
        }

        .features-grid {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border: 1px solid #edf2f7;
            border-radius: var(--card-radius);
            padding: 2.5rem;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 40px -18px rgba(16, 185, 129, 0.2);
            border-color: var(--primary-light);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-soft);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
            flex-shrink: 0;
        }

        .feature-card h3 {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: var(--gray);
            line-height: 1.65;
        }

        /* ========== STEPS REFINED ========== */
        .how-it-works {
            padding: clamp(3rem, 6vw, 5rem) 2rem clamp(3rem, 8vw, 7rem);
            background: #fafef9;
        }

        .steps-container {
            max-width: 1320px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .step-card {
            text-align: center;
            background: white;
            border-radius: 32px;
            padding: 2rem 1.2rem;
            transition: var(--transition);
            border: 1px solid #eef2f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .step-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary-light);
            box-shadow: 0 18px 30px -12px rgba(0, 0, 0, 0.06);
        }

        .step-number {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 auto 1.5rem;
            box-shadow: 0 12px 20px -12px rgba(16, 185, 129, 0.4);
        }

        .step-card h3 {
            font-size: clamp(1rem, 2vw, 1.3rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .step-card p {
            color: var(--gray);
            line-height: 1.6;
        }

        /* ========== COACHES ========== */
        .coaches {
            padding: clamp(3rem, 8vw, 7rem) 2rem;
            background: white;
        }

        .coaches-grid {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .coach-card {
            background: white;
            border: 1px solid #edf2f7;
            border-radius: 32px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: var(--transition);
        }

        .coach-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px -14px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-light);
        }

        .coach-avatar {
            width: 110px;
            height: 110px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin: 0 auto 1.2rem;
            box-shadow: 0 12px 20px -12px rgba(16, 185, 129, 0.3);
        }

        .coach-avatar-image {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.2rem;
            display: block;
            border: 3px solid rgba(16, 185, 129, 0.25);
        }

        .coach-card h3 {
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .coach-specialty {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
        }

        .coach-card p {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* ========== CTA ========== */
        .cta-section {
            padding: clamp(3rem, 8vw, 7rem) 2rem;
            background: linear-gradient(115deg, #0a2b1f, var(--primary-dark));
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -10%;
            width: 120%;
            height: 150%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        }

        .cta-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
            padding: 0 1rem;
        }

        .cta-container h2 {
            font-size: clamp(1.8rem, 5vw, 3.2rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1.2rem;
        }

        .cta-container p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
        }

        .cta-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-white {
            background: white;
            color: var(--primary-dark);
            padding: 1rem 2.2rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            min-height: 52px;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-white {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 1rem 2.2rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            min-height: 52px;
        }

        .btn-outline-white:hover {
            background: white;
            color: var(--primary-dark);
            transform: translateY(-3px);
        }

        /* ========== FOOTER ========== */
        footer {
            background: var(--darker);
            color: white;
            padding: clamp(2rem, 5vw, 4rem) 2rem 2rem;
        }

        .footer-content {
            max-width: 1320px;
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
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-brand p {
            color: #cbd5e1;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            color: white;
            text-decoration: none;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-section h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }

        .footer-section a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            margin-bottom: 0.7rem;
            transition: color 0.2s;
            font-size: 0.9rem;
            padding: 0.2rem 0;
            min-height: 32px;
            display: flex;
            align-items: center;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 2rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        a { text-decoration: none; }
        .Started { color: white; }

        /* ========== LARGE DESKTOP (1201px+) ========== */
        @media (min-width: 1201px) {
            .hero-content h1 { font-size: 3.8rem; }
            .features-grid { grid-template-columns: repeat(3, 1fr); }
            .steps-grid { grid-template-columns: repeat(4, 1fr); }
            .coaches-grid { grid-template-columns: repeat(4, 1fr); }
        }
           .mobile-cta-wrapper {
                display: none;
            }

        /* ========== DESKTOP (1025px – 1200px) ========== */
        @media (max-width: 1200px) {
            .hero-container { gap: 2.5rem; }
            .features-grid { grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
            .steps-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
            .coaches-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
            .footer-content { grid-template-columns: 2fr 1fr 1fr 1fr; gap: 2rem; }
            .footer-content .footer-section:last-child { grid-column: span 1; }
        }

        /* ========== LARGE TABLET / SMALL DESKTOP (769px – 1024px) ========== */
        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
            .hero-content { order: 1; }
            .hero-visual { order: 2; max-width: 600px; margin: 0 auto; }
            .hero-content p { max-width: 100%; }
            .features-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .steps-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .coaches-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .footer-content { grid-template-columns: repeat(2, 1fr); gap: 2rem; }
            .footer-brand { grid-column: span 2; }
        }

        /* ========== TABLET (601px – 768px) ========== */
        @media (max-width: 768px) {
            nav { padding: 0.8rem 0; }
            .nav-container { padding: 0 1.25rem; position: relative; }

            .nav-links {
                display: none;
                position: absolute;
                top: calc(100% + 0.5rem);
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 1.5rem;
                gap: 0.25rem;
                box-shadow: 0 20px 35px rgba(0, 0, 0, 0.08);
                border-bottom: 1px solid rgba(16, 185, 129, 0.2);
                align-items: stretch;
                border-radius: 0 0 16px 16px;
            }

            .nav-links.active { display: flex; }

            .nav-links li a {
                padding: 0.75rem 0.5rem;
                font-size: 1.05rem;
                border-bottom: 1px solid rgba(0,0,0,0.04);
                min-height: 44px;
                display: flex;
                align-items: center;
            }

            .nav-links li:last-child a { border-bottom: none; }

            .mobile-toggle { display: flex; }
            .nav-cta { display: none; }

            .mobile-cta-wrapper {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                width: 100%;
                margin-top: 0.75rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
            }
               .mobile-cta-wrapper {
                display: block;
            }

            .mobile-cta-wrapper a {
                text-align: center;
                justify-content: center;
                width: 100%;
                min-height: 48px;
            }

            .hero {
                padding-top: 70px;
                min-height: auto;
                padding-bottom: 3rem;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }

            .hero-content h1 { font-size: clamp(1.9rem, 6vw, 2.5rem); }
            .hero-content p { font-size: 1rem; margin-bottom: 1.75rem; }

            .hero-actions {
                gap: 0.75rem;
            }

            .btn-large {
                padding: 0.85rem 1.6rem;
                font-size: 0.95rem;
            }

            .hero-features {
                gap: 1rem;
            }

            .feature-item { font-size: 0.9rem; }

            .hero-visual { max-width: 100%; }
            .image-wrapper { border-radius: 20px; }

            .section-header { margin-bottom: 2.5rem; }

            .features { padding: 3rem 1.25rem; }
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            .feature-card { padding: 1.75rem; }

            .how-it-works { padding: 3rem 1.25rem; }
            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.25rem;
            }
            .step-card { padding: 1.5rem 1rem; }

            .coaches { padding: 3rem 1.25rem; }
            .coaches-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.25rem;
            }
            .coach-card { padding: 1.5rem 1rem; }
            .coach-avatar { width: 90px; height: 90px; font-size: 2rem; }
            .coach-avatar-image { width: 90px; height: 90px; }

            .cta-section { padding: 3rem 1.25rem; }
            .cta-container h2 { font-size: clamp(1.6rem, 5vw, 2.2rem); }
            .cta-actions { flex-direction: column; align-items: center; gap: 0.75rem; }
            .btn-white, .btn-outline-white { width: 100%; max-width: 320px; justify-content: center; }

            footer { padding: 2.5rem 1.25rem 1.5rem; }
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 1.75rem;
                margin-bottom: 2rem;
            }
            .footer-brand { grid-column: span 2; }
        }

        /* ========== MOBILE (≤600px) ========== */
        @media (max-width: 600px) {
            .nav-container { padding: 0 1rem; }

            .logo { font-size: 1.35rem; }
            .logo-icon { width: 38px; height: 38px; border-radius: 12px; }

            .hero { padding-top: 64px; }
            .hero-container { padding: 0 1rem; padding-top: 1.5rem; padding-bottom: 2rem; }

            .hero-content h1 { font-size: clamp(1.75rem, 7vw, 2.2rem); }
            .hero-badge { font-size: 0.78rem; padding: 0.4rem 1rem; }

            .hero-actions { flex-direction: column; gap: 0.75rem; }
            .btn-large {
                width: 100%;
                justify-content: center;
                padding: 0.9rem 1.5rem;
            }

            .hero-features {
                flex-direction: column;
                gap: 0.6rem;
            }

            .features { padding: 2.5rem 1rem; }
            .features-grid { grid-template-columns: 1fr; gap: 1rem; }
            .feature-card { padding: 1.5rem; border-radius: 20px; }
            .feature-icon { width: 50px; height: 50px; margin-bottom: 1rem; }

            .how-it-works { padding: 2.5rem 1rem 3rem; }
            .steps-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .step-card { padding: 1.5rem 1rem; border-radius: 20px; }
            .step-number { width: 56px; height: 56px; font-size: 1.5rem; border-radius: 20px; }

            .coaches { padding: 2.5rem 1rem; }
            .coaches-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .coach-card { padding: 1.5rem; border-radius: 20px; }
            .coach-avatar { width: 80px; height: 80px; font-size: 1.75rem; }
            .coach-avatar-image { width: 80px; height: 80px; }

            .cta-section { padding: 2.5rem 1rem; }
            .cta-container p { font-size: 1rem; }

            footer { padding: 2rem 1rem 1.5rem; }
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }
            .footer-brand { grid-column: span 1; }
            .footer-brand h3 { font-size: 1.5rem; }

            .footer-bottom { font-size: 0.8rem; }

            .section-header { padding: 0; margin-bottom: 2rem; }
            .section-header p { font-size: 0.95rem; }
        }

        /* ========== EXTRA SMALL (≤380px) ========== */
        @media (max-width: 380px) {
            .logo { font-size: 1.2rem; }
            .logo-icon { width: 34px; height: 34px; }
            .hero-content h1 { font-size: 1.65rem; }
            .btn-large { font-size: 0.9rem; }
            .step-card, .feature-card, .coach-card { border-radius: 16px; }
        }

        /* ========== LANDSCAPE MOBILE ========== */
        @media (max-width: 768px) and (orientation: landscape) {
            .hero {
                min-height: auto;
                padding-top: 70px;
                padding-bottom: 2rem;
            }
            .hero-container {
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
                align-items: start;
            }
            .hero-visual { display: block; }
            .steps-grid { grid-template-columns: repeat(4, 1fr); }
        }

        /* ========== PRINT ========== */
        @media print {
            nav, .cta-section { display: none; }
            .hero { min-height: auto; padding-top: 1rem; }
            .hero-container { grid-template-columns: 1fr; }
            .features-grid, .steps-grid, .coaches-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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
                <div class="mobile-cta-wrapper" >
                    <a href="{{ route('login')}}" class="btn-outline-modern">Log in</a>
                </div>
            </ul>
            <div class="nav-cta">
                <a href="{{ route('login')}}" class="btn-outline-modern">Log in</a>
            </div>
            <div class="mobile-toggle" onclick="toggleMenu()" aria-label="Toggle navigation" role="button">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>{{ isset($welcomeData['hero']['feature_1']) ? $welcomeData['hero']['feature_1']->value : 'Personalized Plans' }}</span>
                    </div>
                    <div class="feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>{{ isset($welcomeData['hero']['feature_2']) ? $welcomeData['hero']['feature_2']->value : 'Real-time Coaching' }}</span>
                    </div>
                    <div class="feature-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
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

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <span class="section-tag">{{ isset($welcomeData['features']['section_tag']) ? $welcomeData['features']['section_tag']->value : 'FEATURES' }}</span>
            <h2>{{ isset($welcomeData['features']['section_title']) ? $welcomeData['features']['section_title']->value : 'Everything You Need to Succeed' }}</h2>
            <p>{{ isset($welcomeData['features']['section_subtitle']) ? $welcomeData['features']['section_subtitle']->value : 'Powered by advanced AI technology to deliver personalized fitness experiences that actually work.' }}</p>
        </div>
        <div class="features-grid">
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div><h3>{{ isset($welcomeData['features']['feature_1_title']) ? $welcomeData['features']['feature_1_title']->value : 'Smart Workout Plans' }}</h3><p>{{ isset($welcomeData['features']['feature_1_description']) ? $welcomeData['features']['feature_1_description']->value : 'AI-generated programs tailored to your fitness level, goals, and available equipment. Adapts in real-time based on your performance.' }}</p></div>
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div><h3>{{ isset($welcomeData['features']['feature_2_title']) ? $welcomeData['features']['feature_2_title']->value : 'Real-Time Analytics' }}</h3><p>{{ isset($welcomeData['features']['feature_2_description']) ? $welcomeData['features']['feature_2_description']->value : 'Track every metric that matters with comprehensive analytics and insights to optimize your training.' }}</p></div>
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><h3>{{ isset($welcomeData['features']['feature_3_title']) ? $welcomeData['features']['feature_3_title']->value : 'Expert Coaching' }}</h3><p>{{ isset($welcomeData['features']['feature_3_description']) ? $welcomeData['features']['feature_3_description']->value : 'Get guidance from certified trainers and AI-powered form corrections to ensure safe, effective workouts.' }}</p></div>
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91"/></svg></div><h3>{{ isset($welcomeData['features']['feature_4_title']) ? $welcomeData['features']['feature_4_title']->value : 'Nutrition Guidance' }}</h3><p>{{ isset($welcomeData['features']['feature_4_description']) ? $welcomeData['features']['feature_4_description']->value : 'Personalized meal plans and nutrition tracking integrated with your training program for optimal results.' }}</p></div>
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><h3>{{ isset($welcomeData['features']['feature_5_title']) ? $welcomeData['features']['feature_5_title']->value : 'Progress Tracking' }}</h3><p>{{ isset($welcomeData['features']['feature_5_description']) ? $welcomeData['features']['feature_5_description']->value : 'Visualize your journey with detailed progress charts, milestone tracking, and achievement badges.' }}</p></div>
            <div class="feature-card"><div class="feature-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div><h3>{{ isset($welcomeData['features']['feature_6_title']) ? $welcomeData['features']['feature_6_title']->value : 'Video Workouts' }}</h3><p>{{ isset($welcomeData['features']['feature_6_description']) ? $welcomeData['features']['feature_6_description']->value : 'Access thousands of HD workout videos with detailed instructions and multiple camera angles.' }}</p></div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="steps-container">
            <div class="section-header">
                <span class="section-tag">{{ isset($welcomeData['how_it_works']['section_tag']) ? $welcomeData['how_it_works']['section_tag']->value : 'HOW IT WORKS' }}</span>
                <h2>{{ isset($welcomeData['how_it_works']['section_title']) ? $welcomeData['how_it_works']['section_title']->value : 'Get Started in 4 Simple Steps' }}</h2>
                <p>{{ isset($welcomeData['how_it_works']['section_subtitle']) ? $welcomeData['how_it_works']['section_subtitle']->value : 'Begin your transformation journey with our streamlined onboarding process.' }}</p>
            </div>
            <div class="steps-grid">
                <div class="step-card"><div class="step-number">1</div><h3>{{ isset($welcomeData['how_it_works']['step_1_title']) ? $welcomeData['how_it_works']['step_1_title']->value : 'Create Your Profile' }}</h3><p>{{ isset($welcomeData['how_it_works']['step_1_description']) ? $welcomeData['how_it_works']['step_1_description']->value : 'Tell us about your fitness level, goals, and preferences to personalize your experience.' }}</p></div>
                <div class="step-card"><div class="step-number">2</div><h3>{{ isset($welcomeData['how_it_works']['step_2_title']) ? $welcomeData['how_it_works']['step_2_title']->value : 'Get Your AI Plan' }}</h3><p>{{ isset($welcomeData['how_it_works']['step_2_description']) ? $welcomeData['how_it_works']['step_2_description']->value : 'Our AI analyzes your data and generates a customized workout and nutrition plan just for you.' }}</p></div>
                <div class="step-card"><div class="step-number">3</div><h3>{{ isset($welcomeData['how_it_works']['step_3_title']) ? $welcomeData['how_it_works']['step_3_title']->value : 'Start Training' }}</h3><p>{{ isset($welcomeData['how_it_works']['step_3_description']) ? $welcomeData['how_it_works']['step_3_description']->value : 'Follow guided workouts with real-time feedback and form corrections from our AI coach.' }}</p></div>
                <div class="step-card"><div class="step-number">4</div><h3>{{ isset($welcomeData['how_it_works']['step_4_title']) ? $welcomeData['how_it_works']['step_4_title']->value : 'Track Progress' }}</h3><p>{{ isset($welcomeData['how_it_works']['step_4_description']) ? $welcomeData['how_it_works']['step_4_description']->value : 'Monitor your improvements, celebrate milestones, and watch your plan adapt as you grow.' }}</p></div>
            </div>
        </div>
    </section>

    <!-- Coaches Section -->
    <section class="coaches" id="coaches">
        <div class="section-header">
            <span class="section-tag">{{ isset($welcomeData['coaches']['section_tag']) ? $welcomeData['coaches']['section_tag']->value : 'OUR TEAM' }}</span>
            <h2>{{ isset($welcomeData['coaches']['section_title']) ? $welcomeData['coaches']['section_title']->value : 'Train with Expert Coaches' }}</h2>
            <p>{{ isset($welcomeData['coaches']['section_subtitle']) ? $welcomeData['coaches']['section_subtitle']->value : 'Learn from certified professionals who specialize in different areas of fitness and wellness.' }}</p>
        </div>
        <div class="coaches-grid">
            @forelse($coaches as $coach)
            <div class="coach-card">
                @if($coach->photo)
                    <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->fname }} {{ $coach->lname }}" class="coach-avatar-image">
                @else
                    <div class="coach-avatar">{{ substr($coach->fname, 0, 1) }}{{ substr($coach->lname, 0, 1) }}</div>
                @endif
                <h3>{{ $coach->fname }} {{ $coach->lname }}</h3>
                <div class="coach-specialty">{{ $coach->specialization ?? 'General Coaching' }}</div>
                <p>{{ $coach->experience ?? 'Experienced coach dedicated to helping athletes achieve their goals.' }}</p>
            </div>
            @empty
            <div class="coach-card"><div class="coach-avatar">AS</div><h3>Alexandra Smith</h3><div class="coach-specialty">Strength Training</div><p>Certified personal trainer with 8+ years in strength and conditioning. Olympic weightlifting specialist.</p></div>
            <div class="coach-card"><div class="coach-avatar">MJ</div><h3>Michael Johnson</h3><div class="coach-specialty">Cardio & Endurance</div><p>Former marathon runner and triathlon coach. Expert in cardiovascular training and endurance.</p></div>
            <div class="coach-card"><div class="coach-avatar">SR</div><h3>Sarah Rodriguez</h3><div class="coach-specialty">Yoga & Flexibility</div><p>RYT-500 certified instructor focusing on mind-body connection and flexibility training.</p></div>
            <div class="coach-card"><div class="coach-avatar">DK</div><h3>David Kim</h3><div class="coach-specialty">Nutrition & Recovery</div><p>Sports nutritionist helping athletes optimize diet and recovery for peak performance.</p></div>
            @endforelse
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand"><h3>PathFit AI</h3><p>Revolutionizing fitness through AI-powered training and personalized coaching for athletes of all levels.</p><div class="social-links"><a href="#" class="social-link"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a><a href="#" class="social-link"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a><a href="#" class="social-link"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg></a><a href="#" class="social-link"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a></div></div>
            <div class="footer-section"><h4>Product</h4><a href="#">Features</a><a href="#">Pricing</a><a href="#">Coaches</a><a href="#">Workouts</a><a href="#">Mobile App</a></div>
            <div class="footer-section"><h4>Company</h4><a href="#">About Us</a><a href="#">Careers</a><a href="#">Blog</a><a href="#">Press Kit</a><a href="#">Partners</a></div>
            <div class="footer-section"><h4>Resources</h4><a href="#">Help Center</a><a href="#">Video Tutorials</a><a href="#">Community</a><a href="#">Success Stories</a><a href="#">API Docs</a></div>
            <div class="footer-section"><h4>Legal</h4><a href="{{ route('privacy', 'privacy-policy') }}">Privacy Policy</a><a href="{{ route('term', 'terms-of-service') }}">Terms of Service</a><a href="{{ route('cookie', 'cookie-policy') }}">Cookie Policy</a><a href="{{ route('disclaimer', 'disclaimer') }}">Disclaimer</a><a href="{{ route('contact', 'contact') }}">Contact</a></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2024 PathFit AI. All rights reserved. Powered by advanced artificial intelligence.</p></div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        function scrollTo(id) {
            const element = document.getElementById(id);
            if (element) {
                const offset = 80;
                const offsetPosition = element.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                document.getElementById('navLinks').classList.remove('active');
            }
        }

        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            const navLinks = document.getElementById('navLinks');
            const toggle = document.querySelector('.mobile-toggle');
            if (!navLinks.contains(e.target) && !toggle.contains(e.target)) {
                navLinks.classList.remove('active');
            }
        });

        // Close menu on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                document.getElementById('navLinks').classList.remove('active');
            }
        });

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
            document.querySelectorAll('.feature-card, .step-card, .coach-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>