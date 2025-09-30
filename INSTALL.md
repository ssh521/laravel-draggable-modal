# Installation Guide

This guide will help you install and configure Laravel Draggable Modal step by step.

## Step 1: Install the Package

```bash
composer require philipshin/laravel-draggable-modal
```

## Step 2: Install Alpine.js

```bash
npm install alpinejs
```

## Step 3: Publish Package Assets

Publish the JavaScript files:

```bash
php artisan vendor:publish --tag=draggable-modal-js
```

This will copy the modal JavaScript files to `resources/js/vendor/draggable-modal/`.

(Optional) Publish the views if you want to customize them:

```bash
php artisan vendor:publish --tag=draggable-modal-views
```

## Step 4: Configure JavaScript

Open your `resources/js/app.js` file and add the following:

```javascript
import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Import modal initializer BEFORE starting Alpine
import './vendor/draggable-modal/init';

// Start Alpine
Alpine.start();
```

## Step 5: Add Required CSS

Add the `x-cloak` style to hide elements during Alpine initialization.

### Option A: Add to your layout file

```html
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
</body>
</html>
```

### Option B: Add to your CSS file

```css
/* resources/css/app.css */
[x-cloak] {
    display: none !important;
}
```

## Step 6: Build Your Assets

```bash
npm run build
```

Or for development with hot reload:

```bash
npm run dev
```

## Step 7: Test Your Installation

Create a test route and view:

```php
// routes/web.php
Route::get('/test-modal', function () {
    return view('test-modal');
});
```

```blade
<!-- resources/views/test-modal.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Modal</title>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10">
    <h1 class="text-2xl font-bold mb-4">Test Draggable Modal</h1>

    <button onclick="openModal('test-modal')"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Open Modal
    </button>

    <x-draggable-modal id="test-modal" title="Test Modal" :width="600" :height="400">
        <div class="p-5">
            <p>If you can see this modal, the installation was successful!</p>
            <ul class="mt-3 list-disc list-inside">
                <li>Drag the title bar to move the modal</li>
                <li>Drag the bottom-right corner to resize</li>
                <li>Press ESC to close</li>
            </ul>
        </div>
    </x-draggable-modal>

    <script>
        function openModal(modalId) {
            window.dispatchEvent(new CustomEvent('draggable-modal', {
                detail: { modalId: modalId }
            }));
        }
    </script>
</body>
</html>
```

Visit `http://your-app.test/test-modal` and click the "Open Modal" button. If the modal appears and you can drag and resize it, the installation is complete!

## Troubleshooting

### Modals don't appear

1. **Check if `x-cloak` CSS is added**
   ```css
   [x-cloak] { display: none !important; }
   ```

2. **Verify Alpine.js is installed**
   ```bash
   npm list alpinejs
   ```

3. **Check your app.js configuration**
   - Make sure Alpine is imported
   - Make sure `window.Alpine = Alpine;` is set
   - Make sure `init.js` is imported BEFORE `Alpine.start()`
   - Make sure `Alpine.start()` is called

4. **Check browser console for errors**
   - Open Developer Tools (F12)
   - Look for JavaScript errors

5. **Rebuild your assets**
   ```bash
   npm run build
   ```

### Alpine.js errors

If you see errors like "Alpine is not defined" or "draggableModal is not defined":

1. Make sure Alpine.js is installed:
   ```bash
   npm install alpinejs
   ```

2. Verify your `resources/js/app.js` imports Alpine correctly:
   ```javascript
   import Alpine from 'alpinejs';
   window.Alpine = Alpine;
   ```

3. Rebuild your assets:
   ```bash
   npm run build
   ```

### Modal appears but can't drag or resize

1. Check if Tailwind CSS is installed and configured
2. Verify the modal component files are published correctly
3. Check browser console for JavaScript errors

## Next Steps

- Read the [README.md](README.md) for usage examples
- Check the component props for customization options
- Explore the alert modal and multi-modal features

## Need Help?

If you encounter any issues not covered here, please:
1. Check the browser console for errors
2. Verify all installation steps were followed
3. Open an issue on GitHub with error details