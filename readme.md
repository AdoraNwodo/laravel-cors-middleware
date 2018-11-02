# LaravelCorsMiddleware

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads](https://poser.pugx.org/adoranwodo/laravelcorsmiddleware/downloads)](https://packagist.org/packages/adoranwodo/laravelcorsmiddleware)
[![Build Status](https://semaphoreci.com/api/v1/adoranwodo/laravel-cors-middleware/branches/master/shields_badge.svg)](https://semaphoreci.com/adoranwodo/laravel-cors-middleware)

Laravel Cors Middleware is a package that allows users enable Cross-Origin Resource Sharing (CORS) for their Laravel / Lumen applications by taking advantage of the middleware configuration.

## Installation

Via Composer

``` bash
$ composer require adoranwodo/laravelcorsmiddleware
```
## Laravel
If you are using Laravel, please continue here. If you are using Lumen, please scroll to the Lumen section
after doing this, please add the service provider to your ``` config/app.php ``` : 

```
'providers' => [
  ...
  AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddlewareServiceProvider::class
]
```

There is a default configuration in ```config.laravelcorsmiddleware.php```. Publish this file to your own config directory and change to your own values. You can publish the file by running the code below in your terminal:
```
php artisan vendor:publish --provider="AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddlewareServiceProvider"
```
There are some instructions in the config. Please adhere strictly and you should be fine :).

Finally, you need to add this to your middleware. You can add it globally or to a middleware group.



## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email nennenwodo@gmail.com instead of using the issue tracker.

## Credits

- [Nenne Adora Nwodo][link-author]
- [All Contributors][link-contributors]

## License

osl-3.0. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/adoranwodo/laravelcorsmiddleware.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/adoranwodo/laravelcorsmiddleware.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/adoranwodo/laravelcorsmiddleware/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/adoranwodo/laravelcorsmiddleware
[link-downloads]: https://packagist.org/packages/adoranwodo/laravelcorsmiddleware
[link-travis]: https://travis-ci.org/adoranwodo/laravelcorsmiddleware
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/adoranwodo
[link-contributors]: ../../contributors]
