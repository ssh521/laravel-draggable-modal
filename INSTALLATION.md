# Installation

## Requirements

- PHP 8.0 or higher
- Laravel 9.0 or higher

## Install via Composer

```bash
composer require your-vendor/laravel-draggable-modal
```

## Publish Assets

Publish the package assets to your application:

```bash
php artisan vendor:publish --tag=draggable-modal-assets
```

This will publish the JavaScript and CSS files to your `public` directory.

## Usage

Include the modal manager in your Blade templates:

```blade
@include('draggable-modal::modal')
```

Or manually include the assets:

```html
<link rel="stylesheet" href="{{ asset('vendor/draggable-modal/css/modal.css') }}">
<script src="{{ asset('vendor/draggable-modal/js/modal-manager.js') }}"></script>
```