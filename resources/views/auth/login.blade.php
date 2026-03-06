<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PE PathFit AI — Login</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<style>
  :root {
    --lime: #10b981;
    --dark: #0D0F0A;
    --mid: #181C12;
    --card: #1E2418;
    --muted: #4A5240;
    --text: #e0eaed;
    --accent: #7BFF4F;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--dark);
    color: var(--text);
    height: 100vh;
    display: flex;
    overflow: hidden;
  }

  /* ── LEFT PANEL ── */
  .left {
    width: 52%;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 48px 56px;
    background: var(--mid);
    overflow: hidden;
  }

  /* animated grid background */
  .left::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(200,241,53,.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(200,241,53,.04) 1px, transparent 1px);
    background-size: 48px 48px;
    animation: gridShift 20s linear infinite;
  }

  @keyframes gridShift {
    from { background-position: 0 0; }
    to   { background-position: 48px 48px; }
  }

  /* glowing orb */
  .orb {
    position: absolute;
    width: 460px;
    height: 460px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(123,255,79,.18) 0%, transparent 70%);
    top: -80px;
    left: -100px;
    pointer-events: none;
    animation: pulse 6s ease-in-out infinite;
  }

  @keyframes pulse {
    0%, 100% { opacity: .7; transform: scale(1); }
    50%       { opacity: 1; transform: scale(1.08); }
  }

  .left-top {
    position: relative;
    z-index: 2;
  }

  .logo-mark {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 72px;
    animation: fadeDown .6s ease both;
  }

  .logo-icon {
    width: 40px;
    height: 40px;
    background: var(--lime);
    border-radius: 10px;
    display: grid;
    place-items: center;
  }

  .logo-icon svg { width: 22px; height: 22px; }

  .logo-text {
    font-family: 'Space Mono', monospace;
    font-size: 13px;
    letter-spacing: .12em;
    color: var(--lime);
    text-transform: uppercase;
  }

  .hero-label {
    font-family: 'Space Mono', monospace;
    font-size: 11px;
    letter-spacing: .25em;
    color: var(--lime);
    text-transform: uppercase;
    margin-bottom: 16px;
    animation: fadeDown .6s .1s ease both;
  }

  .hero-headline {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(64px, 7vw, 96px);
    line-height: .94;
    letter-spacing: .01em;
    color: var(--text);
    animation: fadeDown .6s .2s ease both;
  }

  .hero-headline span {
    color: var(--lime);
    display: block;
  }

  .hero-sub {
    margin-top: 28px;
    font-size: 15px;
    font-weight: 300;
    line-height: 1.7;
    color: #8A9480;
    max-width: 360px;
    animation: fadeDown .6s .3s ease both;
  }

  /* stats row */
  .stats {
    position: relative;
    z-index: 2;
    display: flex;
    gap: 0;
    border-top: 1px solid rgba(200,241,53,.12);
    padding-top: 32px;
    animation: fadeUp .6s .5s ease both;
  }

  .stat {
    flex: 1;
    padding-right: 32px;
    border-right: 1px solid rgba(200,241,53,.1);
    margin-right: 32px;
  }

  .stat:last-child { border-right: none; margin-right: 0; }

  .stat-num {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 40px;
    color: var(--lime);
    line-height: 1;
  }

  .stat-label {
    font-size: 12px;
    color: var(--muted);
    margin-top: 4px;
    letter-spacing: .04em;
  }

  /* feature pills */
  .pills {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 32px;
    animation: fadeDown .6s .4s ease both;
  }

  .pill {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(200,241,53,.07);
    border: 1px solid rgba(200,241,53,.18);
    border-radius: 100px;
    padding: 6px 14px;
    font-size: 12px;
    color: #9BAA88;
    letter-spacing: .03em;
  }

  .pill-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--lime);
    flex-shrink: 0;
  }

  /* ── RIGHT PANEL (SCROLLABLE) ── */
  .right {
    width: 48%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 64px 56px;
    background: var(--dark);
    position: relative;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--muted) var(--dark);
  }

  .right::-webkit-scrollbar {
    width: 6px;
  }

  .right::-webkit-scrollbar-track {
    background: var(--dark);
  }

  .right::-webkit-scrollbar-thumb {
    background: var(--muted);
    border-radius: 3px;
  }

  .back-home {
    position: absolute;
    top: 36px;
    right: 48px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Space Mono', monospace;
    font-size: 11px;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--muted);
    text-decoration: none;
    transition: color .2s;
    animation: fadeDown .6s .1s ease both;
    cursor: pointer;
  }

  .back-home:hover { color: var(--lime); }

  .back-home svg { transition: transform .2s; }
  .back-home:hover svg { transform: translateX(-4px); }

  .form-header {
    margin-bottom: 40px;
    animation: fadeDown .6s .2s ease both;
  }

  .form-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 11px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: var(--lime);
    margin-bottom: 10px;
  }

  .form-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 48px;
    letter-spacing: .02em;
    line-height: 1;
    color: var(--text);
  }

  .form-desc {
    margin-top: 10px;
    font-size: 14px;
    color: var(--muted);
    font-weight: 300;
  }

  .form-group {
    margin-bottom: 20px;
    animation: fadeDown .6s ease both;
  }

  .form-group:nth-child(1) { animation-delay: .3s; }
  .form-group:nth-child(2) { animation-delay: .35s; }
  .form-group:nth-child(3) { animation-delay: .4s; }

  label {
    display: block;
    font-size: 11px;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 8px;
    font-family: 'Space Mono', monospace;
  }

  .input-wrap {
    position: relative;
  }

  input {
    width: 100%;
    background: var(--card);
    border: 1px solid rgba(255,255,255,.07);
    border-radius: 10px;
    padding: 14px 18px;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: var(--text);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
  }

  input::placeholder { color: var(--muted); }

  input:focus {
    border-color: rgba(200,241,53,.4);
    box-shadow: 0 0 0 3px rgba(200,241,53,.06);
  }

  .input-icon {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
  }

  .row-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    animation: fadeDown .6s .45s ease both;
  }

  .remember {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--muted);
    cursor: pointer;
    user-select: none;
  }

  .remember input[type=checkbox] { display: none; }

  .chk-box {
    width: 16px;
    height: 16px;
    border: 1px solid var(--muted);
    border-radius: 4px;
    display: grid;
    place-items: center;
    transition: background .2s, border-color .2s;
    flex-shrink: 0;
  }

  .remember input:checked + .chk-box {
    background: var(--lime);
    border-color: var(--lime);
  }

  .remember input:checked + .chk-box::after {
    content: '';
    width: 8px;
    height: 5px;
    border-left: 2px solid var(--dark);
    border-bottom: 2px solid var(--dark);
    transform: rotate(-45deg) translateY(-1px);
    display: block;
  }

  .forgot {
    font-size: 13px;
    color: var(--lime);
    text-decoration: none;
    opacity: .8;
    transition: opacity .2s;
  }
  .forgot:hover { opacity: 1; }

  .btn-login {
    width: 100%;
    background: var(--lime);
    color: var(--dark);
    border: none;
    border-radius: 10px;
    padding: 15px;
    font-family: 'Space Mono', monospace;
    font-size: 13px;
    letter-spacing: .14em;
    text-transform: uppercase;
    font-weight: 700;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: transform .15s, box-shadow .2s;
    animation: fadeDown .6s .5s ease both;
  }

  .btn-login::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,.2);
    transform: translateX(-110%) skewX(-15deg);
    transition: transform .4s ease;
  }

  .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(200,241,53,.25); }
  .btn-login:hover::before { transform: translateX(110%) skewX(-15deg); }
  .btn-login:active { transform: translateY(0); }

  .divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 24px 0;
    animation: fadeDown .6s .55s ease both;
  }

  .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,.06); }
  .divider-text { font-size: 11px; color: var(--muted); letter-spacing: .1em; font-family: 'Space Mono', monospace; }

  .social-btns {
    display: flex;
    gap: 12px;
    animation: fadeDown .6s .6s ease both;
  }

  .social-btn {
    flex: 1;
    background: var(--card);
    border: 1px solid rgba(255,255,255,.07);
    border-radius: 10px;
    padding: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--text);
    cursor: pointer;
    transition: border-color .2s, background .2s;
    text-decoration: none;
  }

  .social-btn:hover {
    border-color: rgba(200,241,53,.25);
    background: rgba(200,241,53,.04);
  }

  .sign-up {
    margin-top: 28px;
    text-align: center;
    font-size: 13px;
    color: var(--muted);
    animation: fadeDown .6s .65s ease both;
  }

  .sign-up a { color: var(--lime); text-decoration: none; }
  .sign-up a:hover { text-decoration: underline; }

  /* Error messages */
  .error-message {
    color: #ff6b6b;
    font-size: 12px;
    margin-top: 6px;
  }

  .alert-error {
    background: rgba(255, 107, 107, .15);
    border: 1px solid rgba(255, 107, 107, .3);
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: 13px;
    color: #ff6b6b;
    animation: fadeDown .3s ease both;
  }

  /* animations */
  @keyframes fadeDown {
    from { opacity: 0; transform: translateY(-16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* responsive */
  @media (max-width: 768px) {
    body { flex-direction: column; overflow: auto; }
    .left { width: 100%; padding: 40px 32px; }
    .right { width: 100%; padding: 40px 32px; overflow-y: visible; }
    .hero-headline { font-size: 56px; }
  }
</style>
</head>
<body>

<!-- LEFT: Description -->
<div class="left">
  <div class="orb"></div>

  <div class="left-top">
    <div class="logo-mark">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#0D0F0A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
        </svg>
      </div>
      <span class="logo-text">PE PathFit AI</span>
    </div>

    <p class="hero-label">Intelligent Fitness Education</p>

    <h1 class="hero-headline">
      Train<br>
      Smarter.<br>
      <span>Move Better.</span>
    </h1>

    <p class="hero-sub">
      AI-powered physical education platform designed to personalize fitness journeys, track progress in real time, and elevate PE learning for every student.
    </p>

    <div class="pills">
      <div class="pill"><div class="pill-dot"></div> AI Workout Plans</div>
      <div class="pill"><div class="pill-dot"></div> Progress Analytics</div>
      <div class="pill"><div class="pill-dot"></div> Real-time Feedback</div>
    </div>
  </div>

  <div class="stats">
    <div class="stat">
      <div class="stat-num">12K+</div>
      <div class="stat-label">Active Students</div>
    </div>
    <div class="stat">
      <div class="stat-num">98%</div>
      <div class="stat-label">Engagement Rate</div>
    </div>
    <div class="stat">
      <div class="stat-num">500+</div>
      <div class="stat-label">AI Workouts</div>
    </div>
  </div>
</div>

<!-- RIGHT: Login Form -->
<div class="right">

  <a href="{{ url('/') }}" class="back-home">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
    </svg>
    Back to Home
  </a>

  <div class="form-header">
    <p class="form-eyebrow">Welcome Back</p>
    <h2 class="form-title">Sign In</h2>
    <p class="form-desc">Continue your fitness journey where you left off.</p>
  </div>

  <!-- Session Error Messages -->
  @if ($errors->any())
  <div class="alert-error">
    @foreach ($errors->all() as $error)
      {{ $error }}<br>
    @endforeach
  </div>
  @endif

  @if (session('error'))
  <div class="alert-error">
    {{ session('error') }}
  </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label for="email">Email Address</label>
      <div class="input-wrap">
        <input type="email" id="email" name="email" placeholder="you@school.edu" value="{{ old('email') }}" required>
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="3"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
          </svg>
        </span>
      </div>
      @error('email')
      <div class="error-message">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrap">
        <input type="password" id="password" name="password" placeholder="••••••••••" required>
        <span class="input-icon" style="cursor:pointer;" onclick="togglePwd()">
          <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </span>
      </div>
      @error('password')
      <div class="error-message">{{ $message }}</div>
      @enderror
    </div>

    <div class="row-options">
      <label class="remember">
        <input type="checkbox" id="remember" name="remember">
        <div class="chk-box"></div>
        Remember me
      </label>
      <a href="#" class="forgot">Forgot password?</a>
    </div>

    <button type="submit" class="btn-login">Sign In to PathFit</button>
  </form>

  <div class="divider">
    <div class="divider-line"></div>
    <span class="divider-text">OR</span>
    <div class="divider-line"></div>
  </div>

  <div class="social-btns">
    <a href="#" class="social-btn">
      <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#EA4335" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
      Google
    </a>
    <a href="#" class="social-btn">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99C18.34 21.12 22 16.99 22 12c0-5.52-4.48-10-10-10z"/></svg>
      Facebook
    </a>
  </div>

  <p class="sign-up">Don't have an account? <a href="{{ route('register') }}">Create one free →</a></p>
</div>

<script>
  function togglePwd() {
    const inp = document.getElementById('password');
    inp.type = inp.type === 'password' ? 'text' : 'password';
  }
</script>
</body>
</html>
