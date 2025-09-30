# Installation Guide

This guide will help you install and configure Laravel Draggable Modal step by step.

## Prerequisites

- PHP ≥ 8.2
- Laravel 11 or 12
- Vite 빌드 구성 활성화(기본 `@vite` 사용 전제)
- Alpine.js (아래 단계에서 설치)

## Step 1: Install the Package

```bash
composer require ssh521/laravel-draggable-modal
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

> 참고: 퍼블리시 후 변경 사항이 반영되지 않으면 아래 명령으로 캐시를 비우세요.
> ```bash
> php artisan optimize:clear
> ```

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
    <div x-data="{}">
        <h1 class="text-2xl font-bold mb-4">Test Draggable Modal</h1>

        <x-modal-trigger modal-id="test-modal" text="Open Modal" modalType="single" class="mb-4" />

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
    </div>
</body>
</html>
```

> 참고: `x-modal-trigger`는 내부적으로 Alpine의 `$dispatch`를 사용합니다. 트리거와 모달이 Alpine 스코프 안에 있도록 예제처럼 `x-data="{}"`로 감싸주세요. 그렇지 않으면 클릭 이벤트가 올바르게 전파되지 않을 수 있습니다.

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
   - If you published files, try `php artisan optimize:clear`

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

4. 퍼블리시 후 경로가 맞는지 확인:
   - `resources/js/vendor/draggable-modal/init.js` 존재 여부 확인
   - `resources/js/app.js`에서 `import './vendor/draggable-modal/init'` 경로 확인

### Modal appears but can't drag or resize

1. Check if Tailwind CSS is installed and configured
2. Verify the modal component files are published correctly
3. Check browser console for JavaScript errors

### Blade components not found

1. 뷰/컴포넌트 캐시를 비웁니다:
   ```bash
   php artisan view:clear && php artisan optimize:clear
   ```
2. Laravel 11/12 환경인지 확인하세요 (이 패키지는 11/12를 대상으로 합니다)

## Next Steps

- Read the [README.md](README.md) for usage examples
- Check the component props for customization options
- Explore the alert modal and multi-modal features

## Need Help?

If you encounter any issues not covered here, please:
1. Check the browser console for errors
2. Verify all installation steps were followed
3. Open an issue on GitHub with error details