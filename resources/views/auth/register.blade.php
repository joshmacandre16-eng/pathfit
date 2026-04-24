<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PE PathFit AI — Register</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<style>
  :root {
    --lime: #10b981;
    --dark: #0D0F0A;
    --mid: #181C12;
    --card: #1E2418;
    --muted: #4A5240;
    --text: #E8EDE0;
    --accent: #3ce2ee8e;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--dark);
    color: var(--text);
    min-height: 100vh;
    display: flex;
  }

  /* ─── LEFT PANEL ─────────────────────────────────────── */
  .left {
    width: 52%;
    position: sticky;
    top: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: clamp(32px, 5vw, 56px) clamp(28px, 5vw, 56px);
    background: var(--mid);
    overflow: hidden;
    flex-shrink: 0;
  }

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

  .left-top { position: relative; z-index: 2; }

  .logo-mark {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: clamp(40px, 6vh, 72px);
    animation: fadeDown .6s ease both;
  }

  .logo-icon {
    width: 40px;
    height: 40px;
    background: var(--lime);
    border-radius: 10px;
    display: grid;
    place-items: center;
    flex-shrink: 0;
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
    font-size: clamp(52px, 6.5vw, 96px);
    line-height: .94;
    letter-spacing: .01em;
    color: var(--text);
    animation: fadeDown .6s .2s ease both;
  }

  .hero-headline span { color: var(--lime); display: block; }

  .hero-sub {
    margin-top: 28px;
    font-size: clamp(13px, 1.2vw, 15px);
    font-weight: 300;
    line-height: 1.7;
    color: #8A9480;
    max-width: 360px;
    animation: fadeDown .6s .3s ease both;
  }

  .pills {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 28px;
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

  .stats {
    position: relative;
    z-index: 2;
    display: flex;
    gap: 0;
    border-top: 1px solid rgba(200,241,53,.12);
    padding-top: 28px;
    animation: fadeUp .6s .5s ease both;
  }

  .stat {
    flex: 1;
    padding-right: 24px;
    border-right: 1px solid rgba(200,241,53,.1);
    margin-right: 24px;
    min-width: 0;
  }

  .stat:last-child { border-right: none; margin-right: 0; }

  .stat-num {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(28px, 3vw, 40px);
    color: var(--lime);
    line-height: 1;
  }

  .stat-label {
    font-size: 11px;
    color: var(--muted);
    margin-top: 4px;
    letter-spacing: .04em;
  }

  /* ─── RIGHT PANEL ─────────────────────────────────────── */
  .right {
    width: 48%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: clamp(72px, 8vh, 96px) clamp(24px, 5vw, 56px) clamp(40px, 6vh, 64px);
    background: var(--dark);
    position: relative;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--muted) var(--dark);
    min-height: 100vh;
  }

  .right::-webkit-scrollbar { width: 6px; }
  .right::-webkit-scrollbar-track { background: var(--dark); }
  .right::-webkit-scrollbar-thumb { background: var(--muted); border-radius: 3px; }

  .back-home {
    position: fixed;
    top: 28px;
    right: clamp(20px, 4vw, 48px);
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
    z-index: 100;
    background: rgba(13,15,10,.85);
    padding: 8px 14px;
    border-radius: 100px;
    border: 1px solid rgba(255,255,255,.06);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }

  .back-home:hover { color: var(--lime); }
  .back-home svg { transition: transform .2s; }
  .back-home:hover svg { transform: translateX(-4px); }

  .form-header {
    margin-bottom: 36px;
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
    font-size: clamp(36px, 4vw, 48px);
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

  .form-group { margin-bottom: 18px; }

  .name-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
    margin-bottom: 18px;
  }

  label {
    display: block;
    font-size: 11px;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 7px;
    font-family: 'Space Mono', monospace;
  }

  .input-wrap { position: relative; }

  input, select {
    width: 100%;
    background: var(--card);
    border: 1px solid rgba(255,255,255,.07);
    border-radius: 10px;
    padding: 13px 44px 13px 16px;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: var(--text);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
  }

  input::placeholder { color: var(--muted); }

  input:focus, select:focus {
    border-color: rgba(16,185,129,.4);
    box-shadow: 0 0 0 3px rgba(16,185,129,.07);
  }

  select {
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    padding-left: 16px;
  }

  select option { background: var(--card); color: var(--text); }
  select.placeholder-selected { color: var(--muted); }

  .input-icon {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
    display: flex;
    align-items: center;
  }

  .btn-register {
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
    margin-top: 8px;
    animation: fadeDown .6s .5s ease both;
  }

  .btn-register::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,.2);
    transform: translateX(-110%) skewX(-15deg);
    transition: transform .4s ease;
  }

  .btn-register:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(16,185,129,.25); }
  .btn-register:hover::before { transform: translateX(110%) skewX(-15deg); }
  .btn-register:active { transform: translateY(0); }

  .sign-in {
    margin-top: 24px;
    text-align: center;
    font-size: 13px;
    color: var(--muted);
    animation: fadeDown .6s .55s ease both;
  }

  .sign-in a { color: var(--lime); text-decoration: none; }
  .sign-in a:hover { text-decoration: underline; }

  .error-message {
    color: #ff6b6b;
    font-size: 12px;
    margin-top: 5px;
  }

  .alert-error {
    background: rgba(255,107,107,.12);
    border: 1px solid rgba(255,107,107,.28);
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 18px;
    font-size: 13px;
    color: #ff6b6b;
    animation: fadeDown .3s ease both;
  }

  @keyframes fadeDown {
    from { opacity: 0; transform: translateY(-14px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ─── TABLET (≤ 960px) ──────────────────────────────── */
  @media (max-width: 960px) {
    body { flex-direction: column; }

    .left {
      width: 100%;
      height: auto;
      position: relative;
      padding: 40px 32px 36px;
    }

    .hero-headline { font-size: clamp(48px, 8vw, 72px); }

    .stats { padding-top: 24px; }

    .right {
      width: 100%;
      min-height: auto;
      padding: 48px 32px 48px;
      overflow-y: visible;
    }

    .back-home {
      position: absolute;
      top: 20px;
      right: 24px;
    }

    .name-row {
      grid-template-columns: 1fr 1fr;
    }

    .name-row .form-group:first-child {
      grid-column: 1 / -1;
    }
  }

  /* ─── MOBILE (≤ 600px) ──────────────────────────────── */
  @media (max-width: 600px) {
    .left { padding: 28px 20px 28px; }

    .logo-mark { margin-bottom: 32px; }

    .hero-label { font-size: 10px; }

    .hero-headline { font-size: clamp(42px, 12vw, 60px); }

    .hero-sub { font-size: 13px; max-width: 100%; }

    .pills { gap: 8px; }

    .pill { font-size: 11px; padding: 5px 10px; }

    .stats { gap: 0; }
    .stat { padding-right: 16px; margin-right: 16px; }
    .stat-num { font-size: 26px; }
    .stat-label { font-size: 10px; }

    .right { padding: 52px 20px 40px; }

    .back-home { top: 14px; right: 14px; font-size: 10px; padding: 7px 11px; }

    .name-row {
      grid-template-columns: 1fr;
      gap: 18px;
    }

    .name-row .form-group:first-child {
      grid-column: auto;
    }

    .form-title { font-size: 34px; }

    input, select { font-size: 16px; /* prevent iOS zoom */ }
  }

  /* ─── SMALL MOBILE (≤ 380px) ────────────────────────── */
  @media (max-width: 380px) {
    .hero-headline { font-size: 38px; }
    .stat { padding-right: 12px; margin-right: 12px; }
    .stat-num { font-size: 22px; }
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

<!-- RIGHT: Register Form -->
<div class="right">

  <a href="{{ url('/') }}" class="back-home">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
    </svg>
    Back to Home
  </a>

  <div class="form-header">
    <p class="form-eyebrow">Get Started</p>
    <h2 class="form-title">Create Account</h2>
    <p class="form-desc">Join PathFit and start your fitness journey today.</p>
  </div>

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

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name Row -->
    <div class="name-row">
      <div class="form-group">
        <label for="fname">First Name</label>
        <div class="input-wrap">
          <input type="text" id="fname" name="fname" placeholder="John" value="{{ old('fname') }}" required>
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </span>
        </div>
        @error('fname')<div class="error-message">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label for="mname">Middle Name</label>
        <div class="input-wrap">
          <input type="text" id="mname" name="mname" placeholder="(Optional)" value="{{ old('mname') }}">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </span>
        </div>
        @error('mname')<div class="error-message">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label for="lname">Last Name</label>
        <div class="input-wrap">
          <input type="text" id="lname" name="lname" placeholder="Doe" value="{{ old('lname') }}" required>
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </span>
        </div>
        @error('lname')<div class="error-message">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-group">
      <label for="course">Course</label>
      <div class="input-wrap">
        <input type="text" id="course" name="course" placeholder="e.g. BS Physical Education" value="{{ old('course') }}" required>
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
          </svg>
        </span>
      </div>
      @error('course')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <div class="input-wrap">
        <select id="gender" name="gender" required
          class="{{ old('gender') ? '' : 'placeholder-selected' }}"
          onchange="this.classList.toggle('placeholder-selected', !this.value)">
          <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
          <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
        </select>
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </span>
      </div>
      @error('gender')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <div class="input-wrap">
        <input type="email" id="email" name="email" placeholder="you@school.edu" value="{{ old('email') }}" required>
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="3"/>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
          </svg>
        </span>
      </div>
      @error('email')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrap">
        <input type="password" id="password" name="password" placeholder="••••••••••" required>
        <span class="input-icon" style="cursor:pointer;pointer-events:all;" onclick="togglePwd()">
          <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </span>
      </div>
      @error('password')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <div class="input-wrap">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••••" required>
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </span>
      </div>
      @error('password_confirmation')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn-register">Create Account</button>
</form>

  <p class="sign-in">Already have an account? <a href="{{ route('login') }}">Sign in →</a></p>
</div>

<script>
  function togglePwd() {
    const inp = document.getElementById('password');
    inp.type = inp.type === 'password' ? 'text' : 'password';
  }
</script>
</body>
</html>