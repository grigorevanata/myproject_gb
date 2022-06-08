<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialController;

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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
    return view('welcome');
});

Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])
	->where('id', '\d+')
	->name('news.show');

Route::group(['middleware' => 'auth'], function(){
	Route::get('/account', AccountController::class)
	->name('account');


	//admin routes
	Route::group(['middlware' => 'admin' , 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/', AdminController::class)
    ->name('index');
	Route::get('/parser', ParserController::class)
	    ->name('parser');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
	});
});

   
Route::get('/collection', function() {
	$collection = collect(['Nick', 'Ben', 'Ann', 'Jil', 'Fred', 'Pit', 'July']);
	dd($collection->map(function($item) {
		return strtoupper($item);
	})->filter(function($item) {
		if(strlen($item) > 3) {
			 return $item;
		}
	})->sort()->toJson());
});

Route::get('/sessions', function() {
	session()->put('test', 'Test data');

	if(session()->has('test')) {

		//session()->remove('test'); удаление сессии
	}
	dd(session()->all());
});
    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'guest'], function() {
	Route::get('/auth/{driver}/redirect', [SocialController::class, 'redirect'])
		->where('driver', '\w+')
		->name('social.redirect');
	Route::any('/auth/{driver}/callback', [SocialController::class, 'callback'])
		->where('driver', '\w+')
		->name('social.callback');
});
