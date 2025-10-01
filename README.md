# Laravel Draggable Modal

A Laravel package that provides draggable and resizable modal components with Alpine.js support.

![Multi draggable modal demo](./screenshot.png)

## Features

- 🖱️ **Draggable Modals**: Click and drag modals to reposition them
- 📐 **Resizable**: Resize modals with drag handles
- 🎯 **Multiple Modal Support**: Open multiple modals simultaneously with z-index management
- 🎨 **Alert Modals**: Pre-styled alert modals with success, warning, error, and info variants
- 🎭 **Dark Mode Support**: Built-in dark mode styling
- ⚡ **Alpine.js Integration**: Seamless integration with Alpine.js
- 🎪 **Modal Triggers**: Simple component to trigger modals
- 📱 **Responsive**: Works on desktop and mobile devices

## Requirements

- PHP 8.2 or higher
- Laravel 11.0 or 12.0
- Alpine.js 3.x
- Tailwind CSS

## Installation

설치와 설정의 전체 단계는 `INSTALL.md`를 참고하세요. README에서는 사용법만 다룹니다.

## Usage

### Basic Draggable Modal

```blade
<div x-data="{}">
    <x-draggable-modal
        id="my-modal"
        title="My Modal"
        :width="800"
        :height="600">

        <div class="p-4">
            Modal content goes here
        </div>
    </x-draggable-modal>

    <!-- Trigger the modal -->
    <x-modal-trigger
        text="Open Modal"
        modal-id="my-modal" />
</div>
```

### Multi-Modal Support

```blade
<div x-data="{}">
    <x-draggable-modal-multi
        id="modal-1"
        title="First Modal">

        <div class="p-4">
            First modal content
        </div>
    </x-draggable-modal-multi>

    <x-draggable-modal-multi
        id="modal-2"
        title="Second Modal">

        <div class="p-4">
            Second modal content
        </div>
    </x-draggable-modal-multi>

    <!-- Triggers -->
    <x-modal-trigger text="Open Modal 1" modal-id="modal-1" />
    <x-modal-trigger text="Open Modal 2" modal-id="modal-2" />
</div>
```

### Alert Modal

```blade
<div x-data="{}">
    <x-draggable-modal-alert
        id="success-alert"
        title="Success!"
        message="Your action was completed successfully."
        type="success" />

    <!-- Available types: info, success, warning, error -->

    <x-modal-trigger
        text="Show Alert"
        modal-id="success-alert"
        modal-type="alert" />
</div>
```

### Modal Trigger Variants

```blade
<!-- Primary Button (default) -->
<x-modal-trigger
    text="Open Modal"
    modal-id="my-modal"
    variant="primary" />

<!-- Secondary Button -->
<x-modal-trigger
    text="Open Modal"
    modal-id="my-modal"
    variant="secondary" />

<!-- Danger Button -->
<x-modal-trigger
    text="Delete"
    modal-id="delete-modal"
    variant="danger" />

<!-- Link Style -->
<x-modal-trigger
    text="Open Modal"
    modal-id="my-modal"
    type="link"
    variant="primary" />
```

## Component Props

### Draggable Modal / Draggable Modal Multi

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier for the modal |
| `title` | string | '' | Modal title displayed in header |
| `width` | int | 800 | Initial width in pixels |
| `height` | int | 600 | Initial height in pixels |
| `minWidth` | int | 300 | Minimum width in pixels |
| `minHeight` | int | 200 | Minimum height in pixels |
| `initialX` | int\|null | null | Initial X position (centered if null) |
| `initialY` | int\|null | null | Initial Y position (centered if null) |
| `showCloseButton` | bool | true | Show close button in header |
| `showResizeHandle` | bool | true | Show resize handle in corner |
| `closeOnEscape` | bool | true | Close modal on ESC key |
| `closeOnBackdropClick` | bool | false | Close modal when clicking backdrop |

### Draggable Modal Alert

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | string | auto-generated | Unique identifier for the modal |
| `title` | string | 'Alert' | Alert title |
| `message` | string | '' | Alert message |
| `type` | string | 'info' | Alert type: info, success, warning, error |
| `showCloseButton` | bool | true | Show close button |
| `closeOnBackdropClick` | bool | false | Close on backdrop click |
| `closeOnEscape` | bool | true | Close on ESC key |

### Modal Trigger

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `text` | string | 'Open Modal' | Button/link text |
| `modal-id` | string | required | ID of the modal to open |
| `variant` | string | 'primary' | Style variant: primary, secondary, danger |
| `type` | string | 'button' | Render as: button, link |
| `modalType` | string | 'multi' | Modal type: multi, single, alert |

## Programmatic Control

You can also trigger modals programmatically using custom events:

```javascript
// Open a modal
window.dispatchEvent(new CustomEvent('open-modal', {
    detail: { modalId: 'my-modal' }
}));

// Close a modal
window.dispatchEvent(new CustomEvent('close-modal', {
    detail: { modalId: 'my-modal' }
}));
```

> You can also open a modal by dispatching a DOM event from Blade or JS. The package registers listeners in `resources/js/draggable-modal/init.js`.

## Livewire Integration

You can trigger modals from Livewire components:

```php
// In your Livewire component
$this->dispatch('open-modal', modalId: 'user-edit-modal');
```

## Customization

### Customizing Views

After publishing the views, you can customize them in:

```
resources/views/draggable-modal/components/
```

### Customizing JavaScript

After publishing the JavaScript files, you can modify the behavior in:

```
resources/js/draggable-modal/
```

If you change file locations or names, update your imports accordingly and rebuild assets (`npm run build`).

### Routes: 샘플 라우트 비활성화 및 `web.php`에 직접 추가

샘플 라우트 자동 로드를 끄고자 한다면 설정을 퍼블리시한 뒤 비활성화할 수 있습니다.

1) 설정 퍼블리시

```bash
php artisan vendor:publish --tag=draggable-modal-config
```

2) `.env` 또는 `config/draggable-modal.php`에서 비활성화

```env
DRAGGABLE_MODAL_LOAD_SAMPLE_ROUTES=false
```

또는 `config/draggable-modal.php`에서

```php
'load_sample_routes' => false,
```

3) `routes/web.php`에 직접 추가 예시

```php
Route::prefix('draggable-modal')->as('draggable-modal.')->group(function () {
    Route::view('/sample/single', 'draggable-modal-sample-code.single-modal')->name('sample.single');
    Route::view('/sample/multi', 'draggable-modal-sample-code.multi-modal')->name('sample.multi');
    Route::view('/sample/alert', 'draggable-modal-sample-code.alert-modal')->name('sample.alert');
    Route::view('/sample/vite', 'draggable-modal-sample-code.vite-test')->name('sample.vite');
});
```

## Troubleshooting

설치/빌드 관련 문제는 `INSTALL.md`의 Troubleshooting 절을 확인하세요. 사용 중 동작 문제가 있다면 브라우저 콘솔 오류와 Alpine 초기화 여부를 우선 확인해 주세요.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Credits

- [Philip Shin](https://github.com/philipshin)

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.