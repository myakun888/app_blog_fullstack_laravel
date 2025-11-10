#!/bin/bash
# =========================
# Build & Deploy Laravel + Tailwind di Railway
# =========================

set -e  # berhenti jika ada error

echo "==== Step 1: Install PHP dependencies ===="
composer install --no-dev --optimize-autoloader

echo "==== Step 2: Install Node.js dependencies ===="
npm install

echo "==== Step 3: Build Tailwind + Vite ===="
npm run build

# Pastikan CSS hasil build ada
if [ ! -f public/css/app.css ]; then
    echo "⚠️ ERROR: app.css tidak ditemukan! Build Tailwind gagal."
    exit 1
fi

echo "==== Step 4: Clear Laravel cache ===="
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "==== Step 5: Re-cache Laravel ===="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==== Step 6: Storage link ===="
php artisan storage:link || true  # abaikan jika sudah ada

echo "==== Step 7: Migrate database ===="
php artisan migrate --force

echo "==== Deployment selesai! ===="

