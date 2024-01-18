initial install

```
composer create-project laravel/laravel sprint
composer require laravel/jetstream laravel/sanctum
php artisan jetstream:install livewire --teams --dark
```

customizations

```
php artisan make:migration add_columns_to_users_table
php artisan make:model Project --all
php artisan make:controller ProjectsController --model=Project --api --requests
```
