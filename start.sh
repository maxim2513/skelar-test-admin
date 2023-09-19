#!/bin/bash

# Start Docker containers
docker-compose up -d

# Install PHP dependencies
docker-compose exec -T laravel.test composer install

# Generate application key
./vendor/bin/sail php artisan key:generate

# Migrate the database
./vendor/bin/sail php artisan migrate

# Install NPM
./vendor/bin/sail npm install

# Install build front
./vendor/bin/sail npm run build

echo "Laravel application is running at http://localhost"
echo "For registration new user http://localhost/register/"