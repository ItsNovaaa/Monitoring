# Requirements
1. PHP Version 7.4+
2. MYSQL Ver 8.0.30 for Win64 on x86_64 (MySQL Community Server - GPL)
3. Composer
4. Web Browser
5. PHP server (Laragon Or Xampp)

# INSTALLATION
1. Clone the project
2. Open terminal and type composer update or composer install (if not working type composer install --ignore-platform-reqs)
3. Copy .env.example and paste here, rename .env.example.copy to .env
4. Configure your database connection
5. Run "php artisan key:generate" and "php artisan config:clear"
6. Run "php artisan migrate" and "php artisan db:seed" to generate table and insert default user
7. Run "php artisan serve"
8. Open the browser and type localhost:8000


# HOW TO USE THE APP
1. Login with admin user
   1. Username: admin
   2. Password: admin
2. Go to perusahaan page and create perusahaan
3. After that go to kendaraan page and create kendaraan
4. Go to request kendaraan page and create request kendaraan
5. After that you can approve your request kendaraan
6. After that you must be logout
7. Login with pejabat User
   1. Username: pejabat
   2. Password: admin
8. Go to request kendaraan page and approve the request
9. You can see status column change
10. After that you must be logout and login with admin user
11. Go to kendaraan menu and select dropdown monitoring kendaraan
12. Here you can see the status and history of the kendaraan
13. If you want see your log activity, you can go to log activity menu
14. After that there profile menu, you can edit your username and password here