# LaravelCorsMiddleware

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads](https://poser.pugx.org/adoranwodo/laravelcorsmiddleware/downloads)](https://packagist.org/packages/adoranwodo/laravelcorsmiddleware)
[![Build Status](https://semaphoreci.com/api/v1/adoranwodo/laravel-cors-middleware/branches/master/shields_badge.svg)](https://semaphoreci.com/adoranwodo/laravel-cors-middleware)

Laravel Cors Middleware is a package that allows users enable Cross-Origin Resource Sharing (CORS) for their Laravel / Lumen applications by taking advantage of the middleware configuration.

# Installation

Via Composer

``` bash
$ composer require adoranwodo/laravelcorsmiddleware
```


# Usage

## Laravel
If you are using Laravel, please continue here. If you are using Lumen, please scroll down to the Lumen section.

### Configuration
Please add the service provider to your ``` config/app.php ``` : 

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

### Global Middleware (Laravel)
To use the CORS middleware globally (on all routes), go to ```app/Http/Kernel.php``` and add the laravelcorsmiddleware to your ```$middleware``` array like this:
```
protected $middleware = [
  ...
  \AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddleware::class,
]
```

### Middleware Group (Laravel)
To use the CORS middleware only for specific routes or groups, go to ```app/Http/Kernel.php``` and add the laravelcorsmiddleware to your middleware group array like this:
```
protected $middlewareGroups = [
    'web' => [
        ...
        \AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddleware::class,
    ],

    'api' => [
        ...
    ],
];
```


## Lumen
If you are using Lumen, please continue here. If you are using Laravel, please scroll up to the Laravel section

### Configuration
Please create a ```/config``` directory in the parent directory and add create a new ```laravelcorsmiddleware.php``` file. Paste this into your new php file (You can edit the values as you like).

```
<?php

return [
    
    /*
	*  __________      __________       ___________     __________
	* |               |          |     |           |   |
	* |               |          |     |           |   |
	* |               |          |     |           |   |
	* |               |          |     |___________|   |__________
	* |               |          |     |       \                  |
	* |               |          |     |        \                 |
	* |               |          |     |         \                |
	* |__________     |__________|     |          \    ___________|
	*
	*
	*
	* LARAVEL CORS MIDDLEWARE
	* 
	* Please add a list of values to allowedOrigins, allowedMethods and allowedHeaders. 
	* You can also choose to set the value of these to '*', but note that this is not advisable 
	* for allowedOrigins as this would give everyone access to your api.
    */

    'allowCredentials' => true,	  		          	//true or false.      NOTE: Boolean NOT String. 'true' is different from true
    'allowedOrigins' => ['http://localhost:8081'],        	//array of strings    e.g. ['*'] or ['https://mywebsite.com', 'https://anotherwebsite.com', ... ]
    'allowedMethods' => ['GET'],    			  	//array of strings    e.g. ['*'] or ['GET', 'POST', ... ]
    'allowedHeaders' => ['Content-Type', 'Authorization'],      //array of strings.   e.g. ['*'] or ['Content-Type', 'Authorization', ... ]
    'maxAge' => 86400,                			        //number.             e.g. 86400
];
```
Once this is done, you can go to ```bootstrap/app.php```. Here, you will load the configuration file manually and register the service provider like this: 
```
$app->configure('laravelcorsmiddleware');  //load the config file
$app->register(AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddlewareServiceProvider::class);  //register the service provider
```
Finally, you need to add this to your middleware. You can add it globally or to a middleware group.

### Global Middleware (Lumen)
To use the CORS middleware globally (on all routes), go to ```bootstrap/app.php``` and add the laravelcorsmiddleware to your ```$middleware``` array like this:
```
$app->middleware([
  ...
  \AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddleware::class,
]);
```

### Middleware Group (Lumen)
To use the CORS middleware only for specific routes or groups, go to ```bootstrap/app.php``` and add the laravelcorsmiddleware to your middleware group array like this:
```
$app->routeMiddleware([
    'cors' => \AdoraNwodo\LaravelCorsMiddleware\LaravelCorsMiddleware::class
]);
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


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
