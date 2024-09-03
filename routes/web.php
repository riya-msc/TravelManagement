<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserPackageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//admin routes
Route::get('admin/login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
Route::post('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware('admin.auth')->group(function () {
    Route::get('admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout',  [AdminController::class,'logout'])->name('admin.logout');
});

Route::middleware('admin.auth')->prefix('admin')->group(function (){

    Route::controller(AdminProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'profile')->name('admin.profile');
        Route::get('/change-password', 'changePassword')->name('admin.change_password');
        Route::post('/update-password', 'updatePassword')->name('admin.password.update');
    });

    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        Route::get('/information', 'information')->name('information');
        Route::get('/contacts', 'contacts')->name('admin.contacts');
        Route::post('/information/store', 'storeInformation')->name('information.store');
        Route::get('/services', 'services')->name('admin.services');
        Route::put('/services/update/{id}', 'serviceUpdate')->name('services.update');
        Route::get('/about', 'about')->name('admin.about');
        Route::post('/about/update', 'aboutUpdate')->name('admin.about.update');
    });

    Route::controller(BlogController::class)->prefix('blogs')->group(function () {
        Route::get('/', 'blogs')->name('admin.blogs');
        Route::get('/add', 'blogAdd')->name('admin.blog.add');
        Route::post('/store', 'blogStore')->name('admin.blog.store');
        Route::get('/edit/{blog}', 'blogEdit')->name('admin.blog.edit');
        Route::get('/deactivate/{blog}', 'blogDeactivate')->name('admin.blog.deactivate');
        Route::get('/activate/{blog}', 'blogActivate')->name('admin.blog.activate');
        Route::post('/update/{blog}', 'blogUpdate')->name('admin.blog.update');
    });

    Route::controller(DestinationController::class)->prefix('destination')->group(function () {
        Route::get('/', 'destinations')->name('admin.destinations');
        Route::get('/add', 'destinationAdd')->name('admin.destination.add');
        Route::post('/store', 'destinationStore')->name('admin.destination.store');
        Route::get('/edit/{destination}', 'destinationEdit')->name('admin.destination.edit');
        Route::get('/deactivate/{destination}', 'destinationDeactivate')->name('admin.destination.deactivate');
        Route::get('/activate/{destination}', 'destinationActivate')->name('admin.destination.activate');
        Route::post('/update/{destination}', 'destinationUpdate')->name('admin.destination.update');
    });

    Route::controller(PackageController::class)->prefix('package')->group(function () {
        Route::get('/create', 'createPackage')->name('create.package');
        Route::post('/store', 'storePackage')->name('store.package');
        Route::get('/list', 'listPackage')->name('list.package');
        Route::get('/edit/{package}', 'editPackage')->name('edit.package');
        Route::get('/package/{package}/images/{image}/remove', 'removeImage')->name('package.images.remove');
        Route::post('/update/{package}', 'updatePackage')->name('update.package');
        Route::get('/deactivate/{package}', 'deactivatePackage')->name('deactivate.package');
        Route::get('/activate/{package}', 'activatePackage')->name('activate.package');
        Route::get('/manage/visa/{package}', 'manageVisaPackage')->name('manage.visa.package');
        Route::post('/visa/requirements/{package}', 'visaRequirementsStore')->name('visa.requirements.package');
        Route::get('/itinerary/{package}', 'itineraryPackage')->name('itinerary.package');
        Route::get('/itinerary/manage/{package}', 'manageItineraryPackage')->name('manage.itinerary');
        Route::post('/store/itinerary/{package}', 'storePackageItinerary')->name('store.package.itinerary');

        Route::get('/booked-package', 'bookedPackage')->name('booked.package');
        Route::get('/tour-queries', 'tourQueries')->name('tour.queries');
        Route::get('/booked-package/details/{packageBooking}', 'bookedPackageDetails')->name('booked.package.details');
        Route::get('/booked-package/details/modify/{packageBooking}', 'bookedPackageModify')->name('modify.booked.package');
        Route::post('/booked-package/update/{packageBooking}', 'bookedPackageUpdate')->name('booked.package.update');
    });
});

Route::redirect('/dashboard','/');
Route::redirect('/admin','/admin/login');

//frontend routes
Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/about',[IndexController::class,'about'])->name('about');
Route::get('/blog',[IndexController::class,'blog'])->name('blog');
Route::get('/blog/{blog}',[IndexController::class,'blogSingle'])->name('blog.single');
Route::get('/blogs',[IndexController::class,'blogs'])->name('blogs');
Route::get('/package',[IndexController::class,'package'])->name('package');
Route::get('/contact',[IndexController::class,'contact'])->name('contact');


Route::get('/fetch-destinations',[IndexController::class,'fetchDestinations'])->name('fetch.destinations');
Route::post('/search-tour',[IndexController::class,'searchTour'])->name('search.tour');
Route::post('/contact-store',[IndexController::class,'contactStore'])->name('contact.store');

Route::post('/store-tour-query',[UserPackageController::class,'storeTourQuery'])->name('store.tour.query');

Route::get('/package/{package_code}', [UserPackageController::class, 'packageShow'])->name('package.show');


//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/user-profile-edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');
    Route::post('/user-profile-update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');

    Route::get('/user-password-edit', [IndexController::class, 'userPasswordEdit'])->name('user.password.edit');
    Route::post('/user-password-update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');

    Route::get('/booked-packages', [UserPackageController::class, 'bookedPackages'])->name('user.booked.packages');
    Route::get('/package/booking/{package_code}', [UserPackageController::class, 'packageBooking'])->name('package.booking');
    Route::post('/package/booking/store', [UserPackageController::class, 'packageBookingStore'])->name('package.booking.store');
    Route::get('/view-booked-package/{packageBooking}', [UserPackageController::class, 'viewBookedPackages'])->name('view.booked.package');
});
