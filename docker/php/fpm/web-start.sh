#!/bin/sh
set -e

nginx -g 'pid /tmp/nginx.pid; daemon off;' &
php-fpm &
php /var/www/core/artisan websockets:serve --port=7001
#php /var/www/core/artisan queue:work
