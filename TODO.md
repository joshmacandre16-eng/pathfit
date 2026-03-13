# Fix Composer Plugin Warning in Docker Build Logs

## Steps:

- [x] Step 1: Update Dockerfile to create non-root user in composer stage and run Composer commands as non-root.
- [x] Step 2: Update production stage RUN commands to run composer dump-autoload as non-root user (switch USER).
- [ ] Step 3: Rebuild Docker image with `docker-compose build --no-cache`.
- [ ] Step 4: Test with `docker-compose up` and verify no Composer superuser warning in logs.
- [ ] Step 5: Confirm app runs correctly (access http://localhost:8080).

**Progress:** Steps 1-2 complete. Dockerfile updates done. Ready for rebuild & test.
