<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - PathFit AI</title>
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #34d399;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #cbd5e1;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--dark);
            line-height: 1.6;
            background: var(--light);
        }
        .page-header {
            padding: 8rem 2rem 4rem;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            text-align: center;
        }
        .page-header h1 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        .content-section {
            padding: 3rem 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        .contact-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
        }
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 2rem;
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
                a{
            color: var(--primary);
            text-decoration: none;
            border: solid 1px black;
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
             margin: 0.5rem;
        }
    </style>
</head>
<body>
    <a href="/">Home</a>
    <section class="page-header">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you. Get in touch with our team.</p>
    </section>
    <section class="content-section">
        <div class="contact-section">
            <h2>Get In Touch</h2>
            <p>Have questions? We're here to help!</p>
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
            </div>
        </div>
    </section>
</body>
</html>

