<?php

use App\Http\Controllers\Auth\LoginCustomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CriminalGroupController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\FireArmsController;
use App\Http\Controllers\ExplosiveController;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnidadUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();

Route::get('/login', [LoginCustomController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginCustomController::class, 'login']);


Route::group(['middleware' => ['auth', 'profile:99']], function () {

    Route::get('/users', [UnidadUserController::class, 'index'])->name('users.index');;
    Route::post('/users', [UnidadUserController::class, 'store'])->name('users.store');;
    Route::post('/users/search', [UnidadUserController::class, 'search'])->name('users.search');;
    Route::put('/users/inactive/{user}', [UnidadUserController::class, 'inactive'])->name('users.inactive');;
    Route::put('/users/active/{user}', [UnidadUserController::class, 'active'])->name('users.active');;
    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');

    Route::post('/process-report-general', [ReportController::class, 'processGeneral'])->name('process-report-general');

    Route::get('/reports/preview', [ReportController::class, 'preview'])->name('report.preview');
    Route::get('/reports/preview-general/{date}/{type_report}', [ReportController::class, 'previewGeneral'])->name('report.preview-general');

    Route::post('/reports', [ReportController::class, 'export'])->name('report.export');
    Route::post('/reports-general', [ReportController::class, 'exportGeneral'])->name('report.export-general');

});

Route::group(['middleware' => ['auth', 'profile:1,99']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginCustomController::class, 'logout'])->name('logout');
    Route::get('/init-achievements', [HomeController::class, 'index'])->name('init-achievements');
    Route::post('/init-achievements', [HomeController::class, 'initReport'])->name('init-achievements.init-report');
    Route::post('/init-achievements/finish', [HomeController::class, 'finishReport'])->name('init-achievements.finish-report');

    Route::get('/register-criminal-groups', [CriminalGroupController::class, 'index'])->name('register-criminal-groups');
    Route::post('/register-criminal-groups', [CriminalGroupController::class, 'store'])->name('register-criminal-groups.store');
    Route::delete('/register-criminal-groups/{data}', [CriminalGroupController::class, 'delete'])->name('register-criminal-groups.delete');
    Route::get('/edit-item-criminal-group/{data}', [CriminalGroupController::class, 'edit'])->name('edit-item-criminal-group');
    Route::put('/edit-item-criminal-group/{data}', [CriminalGroupController::class, 'update'])->name('edit-item-criminal-group.put');

    Route::get('/register-persons', [PersonsController::class, 'index'])->name('register-persons');
    Route::post('/register-persons', [PersonsController::class, 'store'])->name('register-persons.store');
    Route::delete('/register-persons/{data}', [PersonsController::class, 'delete'])->name('register-persons.delete');
    Route::get('/edit-item-person/{data}', [PersonsController::class, 'edit'])->name('edit-item-person');
    Route::put('/edit-item-person/{data}', [PersonsController::class, 'update'])->name('edit-item-person.put');



    Route::get('/register-currencies', [CurrencyController::class, 'index'])->name('register-currencies');
    Route::post('/register-currencies', [CurrencyController::class, 'store'])->name('register-currencies.store');
    Route::delete('/register-currencies/{data}', [CurrencyController::class, 'delete'])->name('register-currencies.delete');


    Route::get('/register-drugs', [DrugController::class, 'index'])->name('register-drugs');
    Route::post('/register-drugs', [DrugController::class, 'store'])->name('register-drugs.store');
    Route::delete('/register-drugs/{data}', [DrugController::class, 'delete'])->name('register-drugs.delete');
    Route::get('/edit-item-drug/{data}', [DrugController::class, 'edit'])->name('edit-item-drug');
    Route::put('/edit-item-drug/{data}', [DrugController::class, 'update'])->name('edit-item-drug.put');


    Route::get('/register-firearms', [FireArmsController::class, 'index'])->name('register-firearms');
    Route::post('/register-firearms', [FireArmsController::class, 'store'])->name('register-firearms.store');
    Route::delete('/register-firearms/{data}', [FireArmsController::class, 'delete'])->name('register-firearms.delete');


    Route::get('/register-explosives', [ExplosiveController::class, 'index'])->name('register-explosives');
    Route::post('/register-explosives', [ExplosiveController::class, 'store'])->name('register-explosives.store');
    Route::delete('/register-explosives/{data}', [ExplosiveController::class, 'delete'])->name('register-explosives.delete');

    Route::get('/register-fuels', [FuelController::class, 'index'])->name('register-fuels');
    Route::post('/register-fuels', [FuelController::class, 'store'])->name('register-fuels.store');
    Route::delete('/register-fuels/{data}', [FuelController::class, 'delete'])->name('register-fuels.delete');
    Route::get('/edit-item-fuel/{data}', [FuelController::class, 'edit'])->name('edit-item-fuel');
    Route::put('/edit-item-fuel/{data}', [FuelController::class, 'update'])->name('edit-item-fuel.put');


    Route::get('/register-others', [OthersController::class, 'index'])->name('register-others');
    Route::post('/register-others', [OthersController::class, 'store'])->name('register-others.store');
    Route::delete('/register-others/{data}', [OthersController::class, 'delete'])->name('register-others.delete');

});


//Route::post('/create',[HomeController::class,'crearlogro'])->name('crear-logro');
