#!/bin/sh
set -e # berhenti kalau ada error

echo "==> Install PHP dependencies"
composer install --optimize-autoloader --no-dev

echo "==> Install Node.js dependencies"
#npm install

echo "==> Build Tailwind + Vite"
#npm run build

echo "==> Clear & cache Laravel configurations"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Link storage folder"
php artisan storage:link || echo "Storage link sudah ada, lanjut..."

echo "==> Run migrations"
php artisan migrate --force

echo "✅ Build selesai"
