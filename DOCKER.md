# Docker Setup Guide for PathFit

## Quick Start

### Prerequisites

- Docker
- Docker Compose

### Building and Running

1. **Clone environment variables:**

    ```bash
    cp .env.example .env
    ```

2. **Build and start containers:**

    ```bash
    docker-compose up -d --build
    ```

3. **Generate app key (if needed):**

    ```bash
    docker-compose exec app php artisan key:generate
    ```

4. **Run migrations:**

    ```bash
    docker-compose exec app php artisan migrate
    ```

5. **Install Node dependencies (if needed):**
    ```bash
    docker-compose exec app npm install
    ```

### Access the Application

- **Web**: http://localhost
- **API**: http://localhost/api

### Useful Commands

```bash
# View logs
docker-compose logs -f app

# Run artisan commands
docker-compose exec app php artisan tinker

# Rebuild containers
docker-compose up -d --build

# Stop containers
docker-compose down

# Access database
docker-compose exec mysql mysql -u root -p pathfit

# Fresh migration
docker-compose exec app php artisan migrate:fresh --seed
```

## Services

- **app**: PHP 8.3-FPM + Nginx (single container via supervisord)
- **mysql**: MySQL 8.0 database

## Environment Variables

Key variables to configure in `.env`:

```
APP_ENV=production
APP_DEBUG=false
DB_HOST=mysql
DB_DATABASE=pathfit
DB_USERNAME=root
DB_PASSWORD=password
```

## Production Notes

- The `app` container bundles PHP-FPM and Nginx via supervisord for simplicity
- Build the frontend separately in production using `npm run build`
- Use environment-specific configurations
- Set proper file permissions on `storage/` and `bootstrap/cache/`
- Use persistent volumes for database data
- Consider using a reverse proxy (e.g., Traefik, nginx) in front of the Docker setup
