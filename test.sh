#!/bin/bash
php artisan cache:clear --env=testing
php artisan config:cache --env=testing
vendor/bin/phpunit
