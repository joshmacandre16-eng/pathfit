# Railway 502 Fix Plan

## Root Cause

- `railpack.toml` forces Railway to use Railpack builder instead of Dockerfile
- No `[start]` command in `railpack.toml`, so container exits after build
- Dockerfile (PHP-FPM + Nginx + Supervisor) is ignored

## Tasks

- [x] Delete `railpack.toml`
- [x] Create `docker/railway-start.sh` startup script (handles `$PORT`, runs Laravel optimizations, starts Supervisor)
- [x] Update `Dockerfile` to use the startup script as CMD
