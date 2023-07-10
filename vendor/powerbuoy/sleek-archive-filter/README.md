# [Sleek Archive Filter](https://github.com/powerbuoy/sleek-archive-filter/)

[![Packagist](https://img.shields.io/packagist/vpre/powerbuoy/sleek-archive-filter.svg?style=flat-square)](https://packagist.org/packages/powerbuoy/sleek-archive-filter)
[![GitHub license](https://img.shields.io/github/license/powerbuoy/sleek-archive-filter.svg?style=flat-square)](https://github.com/powerbuoy/sleek-archive-filter/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/powerbuoy/sleek-archive-filter.svg?style=flat-square)](https://github.com/powerbuoy/sleek-archive-filter/issues)
[![GitHub forks](https://img.shields.io/github/forks/powerbuoy/sleek-archive-filter.svg?style=flat-square)](https://github.com/powerbuoy/sleek-archive-filter/network)
[![GitHub stars](https://img.shields.io/github/stars/powerbuoy/sleek-archive-filter.svg?style=flat-square)](https://github.com/powerbuoy/sleek-archive-filter/stargazers)

Adds the ability to filter posts in an archive using GET params:

- `?sleek_filter_tax_{taxonomy_name}[]={term_id}`  
	Show only posts belonging to `{term_id}` in `{taxonomy_name}`.
- `?sleek_filter_meta_min_{meta_field_name}[]={value}`  
	Show only posts whose (numeric) `{meta_field_name}` is a minimum of `{value}`.
- `?sleek_filter_meta_max_{meta_field_name}[]={value}`  
	Show only posts whose (numeric) `{meta_field_name}` is a maximum of `{value}`.
- `?sleek_filter_meta_{meta_field_name}[]={value}`  
	Show only posts whose `{meta_field_name}` is exactly `{value}`.

## Theme Support

### `sleek/archive_filter`

Enable the above.

## Hooks

N/A

## Functions

N/A

## Classes

N/A
