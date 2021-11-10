#!/bin/sh

# process by githun actions
# composer install -o -d /www --no-dev
# php /www/artisan vendor:publish --all
php /www/artisan config:clear
php /www/artisan config:cache

while : ;do php /www/artisan schedule:run; sleep 59; done;