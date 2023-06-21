#!/usr/bin/env sh

printf "\n\nStarting PHP $PHP_VERSION daemon...\n\n";
php-fpm --daemonize

printf "Starting Nginx...\n\n"
set -e

printf "Starting Supervisor...\n\n"
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf &

if [[ "$1" == -* ]]; then
    set -- nginx -g "daemon off;" "$@"
fi

printf "Running php artisan optimize...\n\n"
if [[ "$APP_ENV" != 'local' ]]; then
    php artisan optimize
fi

printf "Running command...\n\n"
exec "$@"
