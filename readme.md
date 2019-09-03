<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Instructions
- install vagrant, virtualbox. 
- `composer install`.
- to start server run `php vendor/bin/homestead make`.
- copy `.env.example` to `.env`.
- change `.env` to `Homestead.yaml` settings
- `php artisan key:generate`
- `php artisan cache:clear`
- `php artisan config:clear`
- `composer dump-autoload`
prisijungti i vagrant `vagrant ssh` ir  `cd code`
- `php artisan migrate`
- `php artisan seed`
install nodejs, npm.
- run `npm install`


##Testing 
- run "test" in console it is alias for "vendor/bin/phpunit"

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).
