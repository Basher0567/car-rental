<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

//Laravel Vue Page Routing for user
Route::get("/home",[HomeController::class,'homePage'])->name('homePage');
Route::get("/LoginPage",[UserController::class,'loginPage'])->name('loginPage');
Route::get("/RegistrationPage",[UserController::class,'registrationPage'])->name('registrationPage');


//Laravel Vue Page Routing for user Admin Dashboard
Route::get("/DashboardPage",[DashboardController::class,'dashboardPage'])->name('dashboardPage');
Route::get("/CarPage",[CarController::class,'carPage'])->name('carPage');
Route::get("/CarSavePage",[CarController::class,'carSavePage'])->name('carSavePage');
Route::get("/RentalPage",[RentalController::class,'rentalPage'])->name('rentalPage');
Route::get("/RentalSavePage",[RentalController::class,'rentalSavePage'])->name('rentalSavePage');
Route::get("/CustomerPage",[CustomerController::class,'customerPage'])->name('customerPage');
Route::get("/CustomerSavePage",[CustomerController::class,'customerSavePage'])->name('customerSavePage');


//Laravel Vue Page Routing for user Customer Dashboard1
Route::get("/DashboardPage1",[FrontendDashboardController::class,'dashboardPage1'])->name('dashboardPage1');
Route::get("/RentalPage1",[FrontendRentalController::class,'RentalPage1'])->name('rentalPage1');
Route::get("/RentalHistory",[FrontendRentalController::class,'rentalHistory'])->name('rentalHistory');

//user
Route::post("/user-registration",[UserController::class,'userRegistration'])->name("userRegistration");
Route::post("/user-login",[UserController::class,'userLogin'])->name('userLogin');
Route::get("/logout",[UserController::class,'userLogout'])->name('userLogout');


//car
Route::post("/create-car",[CarController::class,'createCar'])->name('createCar');
Route::post("/update-car",[CarController::class,'updateCar'])->name('updateCar');
Route::get("/delete-car/{id}",[CarController::class,'deleteCar'])->name('deleteCar');
Route::post("/car-by-id",[CarController::class,'carById'])->name('carById');
Route::get("/list-car",[CarController::class,'carList'])->name('car-list');
Route::get("/show-car",[CarController::class,'carDetailsPage'])->name('carDetailPage');


//rental
Route::post("/create-rental",[RentalController::class,'createRental'])->name('createRental');
Route::post("/update-rental",[RentalController::class,'updateRental'])->name('updateRental');
Route::get("/delete-rental/{id}",[RentalController::class,'deleteRental'])->name('deleteRental');
Route::post("/rental-by-id",[RentalController::class,'rentalById'])->name('rentalById');
Route::get("/list-rental",[RentalController::class,'rentalList'])->name('rentalList');
Route::get("/show-rental",[RentalController::class,'rentalDetailsPage'])->name('rentalDetailsPage');


//customer
Route::post("/create-customer",[CustomerController::class,'createCustomer'])->name('createCustomer');
Route::post("/update-customer",[CustomerController::class,'updateCustomer'])->name('updateCustomer');
Route::get("/delete-customer/{id}",[CustomerController::class,'deleteCustomer'])->name('deleteCustomer');
Route::post("/customer-by-id",[CustomerController::class,'customerById'])->name('customerById');
Route::get("/list-customer",[CustomerController::class,'customerList'])->name('customerList');

//Dashboard
Route::get("/summary",[DashboardController::class,'summary'])->name('summary');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';*/
