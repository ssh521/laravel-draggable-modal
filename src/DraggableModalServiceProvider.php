<?php

namespace ssh521\LaravelDraggableModal;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use ssh521\LaravelDraggableModal\View\Components\DraggableModal;
use ssh521\LaravelDraggableModal\View\Components\DraggableModalAlert;
use ssh521\LaravelDraggableModal\View\Components\DraggableModalMulti;
use ssh521\LaravelDraggableModal\View\Components\ModalTrigger;

class DraggableModalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/draggable-modal'),
        ], 'draggable-modal-views');

        // Publish JavaScript files
        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('js/vendor/draggable-modal'),
        ], 'draggable-modal-js');

        // Publish sample views (optional)
        $this->publishes([
            __DIR__.'/../resources/views/draggable-modal-sample-code' => resource_path('views/draggable-modal-sample-code'),
        ], 'draggable-modal-sample-views');

        // Load views from package
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'draggable-modal');

        // Load sample routes
        $this->loadRoutesFrom(__DIR__.'/../routes/draggable-modal-sample.php');

        // Register Blade components
        Blade::component('draggable-modal', DraggableModal::class);
        Blade::component('draggable-modal-multi', DraggableModalMulti::class);
        Blade::component('draggable-modal-alert', DraggableModalAlert::class);
        Blade::component('modal-trigger', ModalTrigger::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}