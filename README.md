<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installing Laravel

```
composer create-project laravel/laravel example-app
```

## Installing Breeze
```
cd example-app
composer require laravel/breeze --dev
php artisan breeze:install
 
php artisan migrate
npm install
npm run dev
```
auth_breeze_role
## Creating Model & Tables

<p align="center">Create Role Model and Migration</p>

```
php artisan make:model Role -m
```
<p align="center">Add a row to role table </p>

```
$table->string('name')
```
<p align="center">Add Role Id to user table by adding a extended migration</p>

```
php artisan make:migration add_role_id_to_users_table --table=users
```

<p align="center">Add the role id as a foreign key</p>

```
$table->foreignId('role_id')->default(1)->constrained();
```

## Creating Middleware


```
php artisan make:middleware RoleMiddleware
```

## Changes In Model


```
protected $fillable = ['name'];

```

## Creating Middleware

```
php artisan make:middleware RoleMiddleware
```

```
if (auth()->user()->role_id == $roleId) {
            return $next($request);
            
        }
return redirect('/');
```

### Creating Controller

```
php artisan make:controller SuperAdminController
php artisan make:controller AdminController
php artisan make:controller UserController
```


## Creating Routes

```
Route::middleware(['auth', 'verified', 'role:1'])->prefix('user')->name('user.')->group(function() {
        Route::get('/entry-time', [UserController::class, 'index'])->name('entrytime');
    });

Route::middleware(['auth', 'verified', 'role:2'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('/user', [AdminController::class, 'index'])->name('users');
    });

Route::middleware(['auth', 'verified', 'role:3'])->prefix('superadmin')->name('superadmin.')->group(function() {
        Route::get('/admin', [SuperAdminController::class, 'index'])->name('admins');
    });
```

## Seeding Roles and SuperAdmin 

```
Role::create(['name' => 'User']);
    Role::create(['name' => 'Admin']);
    Role::create(['name' => 'SuperAdmin']);

    User::create([
        'name' => 'SuperAdmin',
        'email' => 'superadmin@gmail.com',
        'password' => bcrypt('admin12345'),
        'role_id' => 3
]);
```

## Creating View File 

In app->View create layout for admin and superAdmin

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
