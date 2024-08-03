# Laravel Docker Setup

This guide will help you set up a Laravel project using Docker with the following specifications:
- PHP version > 8
- Latest Laravel version
- Redis
- PostgreSQL

## Prerequisites

Ensure you have the following installed on your machine:
- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Make](https://www.gnu.org/software/make/)

## Getting Started

### 1. Build the Docker Containers

First, you need to build the Docker containers. Run the following command in your terminal:

```sh
make build
```

### 2. Access the app Container

Once the build is complete, access the app container with the following command:

```sh
docker-compose exec app bash
```

### 3. Set Correct Permissions

Set the correct permissions for the storage and bootstrap/cache directories:

```sh
chown -R www-data:www-data /var/www/apps/storage /var/www/apps/bootstrap/cache
chmod -R 775 /var/www/apps/storage /var/www/apps/bootstrap/cache
```