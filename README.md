
# Laravel Image Resizer

A simple Laravel package to resize images out of your Laravel storage.


## Features

- Resize PNG, JPEG, JPG etc.
- Resize while keeping aspect ratio
- Configurable routes
- Image caching
- Configurable settings
## Requirements

In order to use this package you need to have **imagick** installed and enabled in your php.ini
```
extension=imagick.so
```
## Installation

Install the package with composer:

```
composer require webduonederland/laravel-image-resizer
```

Publish the configuration:

```
php artisan vendor:publish --provider="WebduoNederland\LaravelImageResizer\ServiceProvider" --tag="config"
```


## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.