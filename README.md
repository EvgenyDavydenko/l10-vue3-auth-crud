## Building a Laravel 10 Auth + CRUD Application with Vue 3
api from Musante

1.  create a new Laravel project via Composer:
```
composer create-project laravel/laravel l10-ui-vue3-auth
```
2.  Install the frontend packeges
```
npm install @vitejs/plugin-vue vue vue-router bootstrap
npm run dev
```
3.  Авторизация пользователя с помощью sanctum
4.  Добавил сущность `Project` и CRUD операции над ней
```
php artisan make:model Project -mc
```
