#!/bin/sh

# --------------------------------------
# Build script otomatis untuk Laravel + Tailwind + Vite
# --------------------------------------

echo "=== 1. Install Composer dependencies ==="
composer install --no-dev --optimize-autoloader

echo "=== 2. Install Node.js dependencies ==="
npm install

echo "=== 3. Build assets dengan Vite + Tailwind ==="
npm run build

echo "=== 4. Clear dan cache konfigurasi Laravel ==="
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== 5. Jalankan migration jika ada ==="
php artisan migrate --force

echo "=== 6. Buat symbolic link storage ==="
php artisan storage:link || echo "Storage link sudah ada"

echo "=== Build selesai! ==="

