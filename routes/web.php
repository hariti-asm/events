<?php

use App\Http\Middleware\UserType1;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ReservationController;

    Route::get('/', [HomeController::class, 'filter_Scope'])->name('filter.events');
    Route::get('/event_detail/{event}', [EventController::class, 'event_detail'])->name('event_detail');
    Route::post('/events/{event}', [EventController::class, 'book'])->name('booking.store');
    Route::get('/ticket/{event}', [TicketController::class, 'show'])->name('ticket');
Route::get('/organizers', [OrganizerController::class, 'index'])->name('organizers');
Route::group(["prefix" => "organiser", "as" => "organiser."], function (){
    Route::get('/organizers/{event}', [OrganizerController::class, 'update'])->name('events.validate');
    Route::post('events', [OrganizerController::class, 'store'])->name('events.store');
    Route::put('events/{id}', [OrganizerController::class, 'update'])->name('events.update');
    Route::match(['put', 'patch'], 'reservation/{event}', [OrganizerController::class, 'reservation_type'])->name('reservation.update');
    Route::get('/statistic', [OrganizerController::class, 'index'])->name('statistics');
    Route::get('/events_data', [OrganizerController::class, 'events'])->name('events');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('organiser.reservations');
    Route::put('/acceptations/{reservation}', [UserController::class, 'accept'])->name('reservations.accept');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'delete'])->name('reservation.delete');


});


Route::resource('events', EventController::class);


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/clients', [AdminController::class, 'getclients'])->name('admin.clients');
    Route::patch('/events/{event}/approve', [AdminController::class, 'update'])->name('events.approve');

    Route::get('/events', [AdminController::class, 'index'])->name('admin.events');
    Route::patch('/clients/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
