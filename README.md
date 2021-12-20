Polecenia użyte:

wget https://getcomposer.org/installer
php installer
rm installer
./composer.phar create-project laravel/laravel laravel-app
cd laravel-app/

mv -i public www

chmod g+rws -R storage/*
../composer.phar install laravel/ui
../composer.phar require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev

php artisan migrate
php artisan db:seed --class=UserSeeder

npm install laravel-mix
npm install bootstrap@4 --save

php artisan clear-compiled
../composer.phar dump-autoload
php artisan optimize

Publiczny dostęp do storage/app/public:
1. ln -s /path/to/laravel/storage/app/public /path/to/public/directory/storage

2. Dla standardowego katalogu public wystarczy: php artisan storage:link
