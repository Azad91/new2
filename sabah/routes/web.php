<?php

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

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
  Route::get('login', 'App\Http\Controllers\Back\AuthController@login')->name('login');
  Route::post('login', 'App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
  Route::get('panel', 'App\Http\Controllers\Back\DashboardController@index')->name('dashboard');
  // MAKALE ROUTS
  Route::get('makale/silinenler','App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');
  Route::resource('makaleler','App\Http\Controllers\Back\ArticleController');
  Route::get('/switch','App\Http\Controllers\Back\ArticleController@switch')->name('switch');
  Route::get('/deleteArticle/{id}','App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
  Route::get('/hardDeleteArticle/{id}','App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');
  Route::get('/recoverArticle/{id}','App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');
  // KAREGORI ROUTS
  Route::get('/kategoriler', 'App\Http\Controllers\Back\CategoryController@index')->name('category.index');
  Route::post('/kategoriler/create', 'App\Http\Controllers\Back\CategoryController@create')->name('category.create');
  Route::post('/kategoriler/update', 'App\Http\Controllers\Back\CategoryController@update')->name('category.update');
  Route::post('/kategoriler/delete', 'App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');
  Route::get('/kategori/status', 'App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
  Route::get('/kategori/getData', 'App\Http\Controllers\Back\CategoryController@getData')->name('category.getData');
  // PAGES ROUTS
  Route::get('/sayfalar', 'App\Http\Controllers\Back\PageController@index')->name('page.index');
  Route::get('/sayfalar/olustur', 'App\Http\Controllers\Back\PageController@create')->name('page.create');
  Route::get('/sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@update')->name('page.edit');
  Route::post('/sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@updatePost')->name('page.edit.post');
  Route::post('/sayfalar/olustur', 'App\Http\Controllers\Back\PageController@post')->name('page.create.post');
  Route::get('/sayfa','App\Http\Controllers\Back\PageController@switch')->name('page.switch');
  Route::get('/sayfalar/sil/{id}', 'App\Http\Controllers\Back\PageController@delete')->name('page.delete');
  Route::get('/sayfa/siralama', 'App\Http\Controllers\Back\PageController@orders')->name('page.orders');
  // CONFIG
  Route::get('/ayarlar', 'App\Http\Controllers\Back\ConfigController@index')->name('config.index');
  Route::post('/ayarlar/update', 'App\Http\Controllers\Back\ConfigController@update')->name('config.update');
  //
  Route::get('logout', 'App\Http\Controllers\Back\AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/','App\Http\Controllers\Front\HomepageController@index')->name('homepage');
Route::get('/iletisim','App\Http\Controllers\Front\HomepageController@contact')->name('contact');
Route::post('/iletisim','App\Http\Controllers\Front\HomepageController@contactpost')->name('contact.post');
Route::get('/kategori/{category}','App\Http\Controllers\Front\HomepageController@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\HomepageController@single')->name('single');
Route::get('/{sayfa}', 'App\Http\Controllers\Front\HomePageController@page')->name('page');
