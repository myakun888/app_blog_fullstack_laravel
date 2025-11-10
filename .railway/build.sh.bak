#ini adalah script otomatis yang di jalankan di laravel agar npm , tailwinds berjalan
echo "Instalasi Node.js dependencie..."
npm install

echo "build tailwinds + vite..."
npm run build

#ini untuk migrate, jika ada yang blm di migrate
php artisan migrate --force
#ini unutk agar web dapat membaca gambar pada storage
php artisan storage:link
