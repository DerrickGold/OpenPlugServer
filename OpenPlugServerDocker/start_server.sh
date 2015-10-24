#!/bin/bash

cd OpenPlugServer
touch storage/db/database.sqlite

php artisan migrate --force
php artisan db:seed --force
composer dump-autoload --optimize
php artisan optimize --force
php artisan route:clear
php artisan route:cache
php artisan serve --host 0.0.0.0 --port 25222
