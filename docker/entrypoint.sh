#!/bin/bash

composer install --no-progress --no-interaction

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan migrate
    php artisan key:generate
    php artisan passport:install
    php artisan db:seed
    php artisan key:generate
    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
    exec docker-php-entrypoint "$@"
fi
