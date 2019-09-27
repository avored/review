<?php
Route::middleware(['web'])
    ->group(function () {
        Route::post('review', \AvoRed\Review\Http\Controllers\ReviewController::class)
            ->name('review.save');
    });


$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\Review\Http\Controllers\Admin')
    ->name('admin.')
    ->group(function () {
        // Route::get('review', \AvoRed\Review\Http\Controllers\ReviewController::class)
        //     ->name('review.index');
        // Route::get('review/{id}', \AvoRed\Review\Http\Controllers\ReviewController::class)
        //     ->name('review.approve');
    });
