#!/usr/bin/env bash
set -euo pipefail

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan migrate --force
php artisan storage:link || true

exec php artisan serve --host 0.0.0.0 --port "${PORT:-10000}"
