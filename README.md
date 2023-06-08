# Setup 
- mariadb
- nginx
# Initialization
- make .env file

```
$ composer install

$ php artisan key:generate

$ php artisan migrate:refresh --seed

$ php artisan storage:link

$ php artisan optimize:clear

$ php artisan serve

```
