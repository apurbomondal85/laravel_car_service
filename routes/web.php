<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ApplyController;
use App\Http\Controllers\Public\CareerController;
use App\Http\Controllers\Public\ClientController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('public.')->as('public.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog-details/{blog}', [BlogController::class, 'details'])->name('blogDetails');
    Route::get('/blog/{key}/categoryWise', [BlogController::class, 'blogCategoryWise'])->name('blogCategoryWise');

    Route::get('/galleries', [GalleryController::class, 'index'])->name('gallery');

    // About
    Route::get('/mission-vission', [AboutController::class, 'index'])->name('about');
    Route::get('/our-team', [AboutController::class, 'team'])->name('team');
    Route::get('/our-clients', [ClientController::class,'index'])->name('clients');
    Route::get('/client/show', [ClientController::class,'show'])->name('client.show');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');

    // Career
    Route::get('/career', [CareerController::class, 'index'])->name('careers');
    Route::get('/career-details/{career}', [CareerController::class, 'details'])->name('careerDetails');
    Route::get('/job-apply', [ApplyController::class,'index'])->name('apply');

    //Subscription
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription');
    Route::post('/subscriptions', [SubscriptionController::class, 'send'])->name('subscription.send');
    Route::post('/jobs', [SubscriptionController::class, 'jobPost'])->name('job.send');
    Route::post('/service-partners', [SubscriptionController::class, 'servicePartners'])->name('service-partners');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/store', [ContactController::class, 'newContact'])->name('contact.store');

    Route::group(['prefix' => 'projects', 'as' => 'project.', 'controller' => ProjectController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{team}/show', 'show')->name('show');
    });
});
