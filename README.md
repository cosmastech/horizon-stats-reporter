# Horizon Stats Reporter for Laravel

## Installation
Require the package via `composer require cosmastech/horizon-stats-exporter`.

### Configure StatsDAdapter
You'll also want to [publish the configuration](https://github.com/cosmastech/laravel-statsd-adapter?tab=readme-ov-file#installation)
for `cosmastech/laravel-statsd-adapter`. This will allow you to set default tags and which driver to use
when publishing stats.

## Publish the Configuration
Run this command within your Laravel application.
```
php artisan vendor:publish --provider="Cosmastech\HorizonStatsReporter\HorizonStatsReporterServiceProvider"
```

This will allow you to override configuration values.

## Usage
TODO