# Welcome to your Angkringan789 app 👋

This is a [Laravel](https://laravel.com) project

## Get started

1. Clone project dan masuk ke direktori project

   ```bash
   git clone <repository-url>
   cd <project-name>
   ```

2. Install dependencies

   ```bash
   composer install
   npm install
   ```

3. Setup environment
   
   ```bash
   cp .env.example .env
   ```
   
4. Generate App Key
    
    ```bash
    php artisan key:generate
    ```

5. Konfigurasi database
   - Buka file .env
   - Sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

6. Install Filament Admin Panel & buat user admin

   ```bash
   composer require filament/filament
   php artisan filament:install --notifications --widgets
   php artisan make:filament-user
   ```

7. Migrate Database

   ```bash
   php artisan migrate
   ```

8. Jalankan aplikasi
   ```bash
   composer run dev
   ```
   
   Perintah ini akan menjalankan 3 proses secara bersamaan:
   - Laravel development server di port 8000
   - Queue worker untuk background jobs
   - Vite development server untuk asset bundling

Aplikasi dapat diakses di [http://localhost:8000](http://localhost:8000)

> Note: 
> - Pastikan PHP versi 8.2 atau lebih tinggi sudah terinstall (sesuai composer.json)
> - Pastikan Composer sudah terinstall
> - Pastikan Node.js & NPM sudah terinstall
> - Pastikan database (MySQL/PostgreSQL) sudah terinstall dan running
> - Pastikan `concurrently` sudah terinstall (akan diinstall otomatis saat `npm install`)
