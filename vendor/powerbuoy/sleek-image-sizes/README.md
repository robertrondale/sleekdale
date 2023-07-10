# [Sleek Image Sizes](https://github.com/powerbuoy/sleek-image-sizes/)

[![Packagist](https://img.shields.io/packagist/vpre/powerbuoy/sleek-image-sizes.svg?style=flat-square)](https://packagist.org/packages/powerbuoy/sleek-image-sizes)
[![GitHub license](https://img.shields.io/github/license/powerbuoy/sleek-image-sizes.svg?style=flat-square)](https://github.com/powerbuoy/sleek-image-sizes/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/powerbuoy/sleek-image-sizes.svg?style=flat-square)](https://github.com/powerbuoy/sleek-image-sizes/issues)
[![GitHub forks](https://img.shields.io/github/forks/powerbuoy/sleek-image-sizes.svg?style=flat-square)](https://github.com/powerbuoy/sleek-image-sizes/network)
[![GitHub stars](https://img.shields.io/github/stars/powerbuoy/sleek-image-sizes.svg?style=flat-square)](https://github.com/powerbuoy/sleek-image-sizes/stargazers)

Utility functions for registering WordPress image sizes.

## Theme support

N/A

## Hooks

N/A

## Functions

### `Sleek\ImageSizes\register($width, $height, $crop, $additionalSizes)`

Overrides WordPress' built-in thumbnail sizes (thumbnail, medium, medium_large and large) using the dimensions passed to the function, e.g: `Sleek\ImageSizes\register(1920, 1080, ['center', 'center']);` where large will be `1920x1080`, `medium_large` will be 75% of that size, `medium` 50% and `thumbnail` 25%.

Also accepts a fourth argument, `$additionalSizes`, which allows you to register more sizes under different names;

```
Sleek\ImageSizes\register(1920, 1080, ['center', 'center'], [
	'portrait' => ['width' => 1080, 'height' => 1920, 'crop' => ['center', 'top']],
	'square' => ['width' => 1920, 'height' => 1920],
]);
```

Each additional size will be registered as `{$name}_large`, `{$name}_medium_large` (75%), `{$name}_medium` (50%) and `{$name}_thumbnail` (25%)

### `Sleek\ImageSizes\get_image_sizes($width, $height)`

Helper function for `register()`.

## Classes

N/A
