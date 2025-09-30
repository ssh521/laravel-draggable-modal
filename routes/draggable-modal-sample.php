<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Draggable Modal Sample Routes
|--------------------------------------------------------------------------
| These routes are provided for trying out the package quickly.
| You may disable them by not registering the service provider
| in non-local environments, or by removing this file.
*/

Route::group([
    'prefix' => 'draggable-modal',
    'as' => 'draggable-modal.',
], function () {
    Route::view('/sample/single', 'draggable-modal-sample-code.single-modal')->name('sample.single');
    Route::view('/sample/multi', 'draggable-modal-sample-code.multi-modal')->name('sample.multi');
    Route::view('/sample/alert', 'draggable-modal-sample-code.alert-modal')->name('sample.alert');
    Route::view('/sample/vite', 'draggable-modal-sample-code.vite-test')->name('sample.vite');
});


