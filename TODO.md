# Deployment Fix Plan

## Issues

1. Missing runtime libraries in Dockerfile (libpng, libpq removed after build)
2. Working directory mismatch between Dockerfile (/var/www/html) and docker-compose/railpack (/app)
3. Nginx config root path mismatch
4. Railpack build command runs migrations during build phase
5. DOCKER.md outdated for single-container architecture

## Tasks

- [x] Fix Dockerfile: add runtime packages, use --virtual build-deps, change WORKDIR to /app
- [x] Fix docker/nginx.conf: update root to /app/public
- [x] Fix docker-compose.yml: remove redundant separate nginx service, expose port 80 on app
- [x] Fix railpack.toml: remove migrate from build cmd, remove redundant cache commands
- [x] Update DOCKER.md: reflect single-container architecture
