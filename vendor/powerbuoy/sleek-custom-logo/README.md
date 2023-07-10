# [Sleek Custom Logo](https://github.com/powerbuoy/sleek-custom-logo/)

[![Packagist](https://img.shields.io/packagist/vpre/powerbuoy/sleek-custom-logo.svg?style=flat-square)](https://packagist.org/packages/powerbuoy/sleek-custom-logo)
[![GitHub license](https://img.shields.io/github/license/powerbuoy/sleek-custom-logo.svg?style=flat-square)](https://github.com/powerbuoy/sleek-custom-logo/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/powerbuoy/sleek-custom-logo.svg?style=flat-square)](https://github.com/powerbuoy/sleek-custom-logo/issues)
[![GitHub forks](https://img.shields.io/github/forks/powerbuoy/sleek-custom-logo.svg?style=flat-square)](https://github.com/powerbuoy/sleek-custom-logo/network)
[![GitHub stars](https://img.shields.io/github/stars/powerbuoy/sleek-custom-logo.svg?style=flat-square)](https://github.com/powerbuoy/sleek-custom-logo/stargazers)

Hooks into `the_custom_logo()` and renders one of:

1) A custom logo selected in the admin
2) An SVG logo found in `dist/assets/site-logo.svg`
3) A PNG logo found in `dist/assets/site-logo.png`
4) Just outputs the site name

Also makes it possible to pass an array of arguments to `get_custom_logo()`; `the_custom_logo(['inline_svg' => true, 'append' => '-small'])` would instead render `dist/assets/site-logo-small.svg` as an inline SVG.

Finally it also changes the link class name from `custom-logo-link` to `site-logo`.

## Theme Support

N/A

## Hooks

N/A

## Functions

### `the_custom_logo($args)`

This is the native WordPress `the_custom_logo()` but we add the `$args` argument which enables you to specify `inline_svg` (`true`/`false`) and `append` (`String` to append to `site-logo` filename).

## Classes

N/A
