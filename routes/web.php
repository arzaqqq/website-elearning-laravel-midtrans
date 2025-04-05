<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [frontController::class, 'index'])->name('front.index');
Route::get('/pricing', [frontController::class, 'pricing'])->name('front.pricing');
Route::match(['get', 'post'], '/booking/payment/midtrans/notification',
    [FrontController::class, 'paymentMidtransNotification'])
    ->name('front.payment_midtrans_notification');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:student')->group(function () {
        // Subscription routes
        Route::get('/dashboard/subscriptions/', [DashboardController::class, 'subscriptions'])
            ->name('dashboard.subscriptions');

        Route::get('/dashboard/subscription/{transaction}', [DashboardController::class, 'subscription_details'])
            ->name('dashboard.subscription.details');

        // Course routes
        Route::get('/dashboard/courses/', [CourseController::class, 'index'])
            ->name('dashboard.courses');

        Route::get('/dashboard/course/{course:slug}', [CourseController::class, 'details'])
            ->name('dashboard.course.details');

        Route::get('/dashboard/search/courses', [CourseController::class, 'search_courses'])
            ->name('dashboard.search.courses');

            Route::middleware(['check.subscription'])->group(function () {
                // Course joining route
                Route::get('/dashboard/join/{course:slug}', [CourseController::class, 'join'])
                    ->name('dashboard.course.join');

                // Course learning routes
                Route::get('/dashboard/learning/{course:slug}/{courseSection}/{sectionContent}', [CourseController::class, 'learning'])
                    ->name('dashboard.course.learning');

                Route::get('/dashboard/learning/{course:slug}/finished', [CourseController::class, 'learning_finished'])
                    ->name('dashboard.course.learning.finished');
            });

            Route::get('/dashboard/learning/{course:slug}/{courseSection}/{sectionContent}', [CourseController::class, 'learning'])
                ->name('dashboard.course.learning');

            Route::get('/dashboard/learning/{course:slug}/finished', [CourseController::class, 'learning_finished'])
                ->name('dashboard.course.learning.finished');

            Route::post('/booking/payment/midtrans', [frontController::class, 'paymentStoreMidtrans'])
            ->name('front.payment_store_midtrans');
    });
});

require __DIR__.'/auth.php';
