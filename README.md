initial install

```
composer create-project laravel/laravel sprint
composer require laravel/jetstream laravel/sanctum
php artisan jetstream:install livewire --teams --dark
```

customizations

```
php artisan make:migration add_columns_to_users_table
php artisan make:model Project --controller --resource --seed --migration --test
```
