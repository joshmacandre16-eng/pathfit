# Fix Laravel Artisan PowerShell Errors - TODO

## Steps:

- [x] **Step 1:** Update README.md with Docker and local instructions.
- [x] **Step 2:** Enhance run-artisan.ps1 and create run-migrate.ps1.
- [ ] **Step 3:** Test Docker: `docker compose up -d --build` (requires Docker Desktop). Skipped (not installed).
- [x] **Step 4:** Local tests PASS (PHP PATH works, migrate running).
- [ ] **Step 5:** User add PHP to permanent PATH (optional, README instructions).
- [x] **Step 6:** Verify migrations (running; check .env DB_HOST=127.0.0.1 for XAMPP).
- [ ] Complete: attempt_completion.

**Notes:** DB external (10.142.0.4 or local XAMPP MySQL). Use Docker for prod consistency.
