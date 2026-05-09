#!/usr/bin/env bash
set -euo pipefail

php artisan migrate --force
php artisan optimize

exec php -d variables_order=EGPCS -S 0.0.0.0:${PORT:-8080} -t public
