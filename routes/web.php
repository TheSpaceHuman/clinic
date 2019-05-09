<?php

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
Route::group(['middleware' => 'auth'], function(){
  Route::get('/', 'HomeController@index')->name('index');
  Route::get('services', 'ServiceController@index')->name('page.service.index');
  Route::get('services/search', 'ServiceController@searchService')->name('page.service.search');
  Route::get('services/category/{slug}', 'ServiceController@showCategory')->name('page.service.showCategory');
  Route::get('services/service/{slug}', 'ServiceController@showService')->name('page.service.showService');
  Route::get('doctors', 'DoctorController@index')->name('page.doctor.index');
  Route::get('doctors/search', 'DoctorController@searchService')->name('page.doctor.search');
  Route::get('doctors/spec/{slug}', 'DoctorController@showSpec')->name('page.doctor.showSpec');
  Route::get('doctors/doctor/{slug}', 'DoctorController@showDoctor')->name('page.doctor.showDoctor');
  Route::get('articles', 'ArticleController@index')->name('page.article.index');
  Route::get('articles/show/{slug}', 'ArticleController@show')->name('page.article.show');
  Route::get('articles/category/{slug}', 'ArticleController@showCategory')->name('page.article.category');
  Route::get('analyzes', 'AnalyzeController@index')->name('page.analyze.index');
  Route::get('feetback', 'FeetbackController@index')->name('page.feetback.index');
  Route::get('tasks', 'TaskController@index')->name('page.task.index')->middleware('secretary');
  Route::get('tasks/{id}', 'TaskController@update')->name('page.task.update');
  Route::post('tasks/created', 'TaskController@newTask')->name('page.task.new');
  Route::get('phonebook', 'PhonebookController@index')->name('page.phonebook.index');
  Route::get('news/{id}/show', 'HomeController@show')->name('page.news.show');
  Route::get('news/category/{category}', 'HomeController@category')->name('page.news.category');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
  Route::get('middleware/tasks', function () {
    return view('middleware.secretary');
  })->name('middleware.tasks');
  Route::get('user/profile', 'UserController@profile')->name('user.profile');
  Route::put('user/profile/{id}', 'UserController@update')->name('user.profile.update');
  //  Testing routes
  Route::get('testing/add-services', 'TestController@addServices')->name('test.add-services');
  Route::get('testing/services-search', 'TestController@servicesSearch')->name('test.services-search');
});


Route::get('admin', function () {
  return view('admin.index');
})->middleware(['auth', 'admin'])->name('admin.index');

Auth::routes();

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => ['auth', 'admin']], function(){
  Route::resource('doctors', 'DoctorController');
  Route::resource('category', 'CategoryController');
  Route::resource('service', 'ServiceController');
  Route::resource('users', 'UserController');
  Route::resource('spec', 'SpecController');
  Route::resource('article', 'ArticleController');
  Route::resource('analyze', 'AnalyzeController');
  Route::put('analyze/switch-show/{id}', 'AnalyzeController@switchShow')->name('article.switchShow');
  Route::resource('branch', 'BranchController');
  Route::resource('task', 'TaskController');
  Route::resource('phonebook', 'PhonebookController');
  Route::put('service/{id}/clone', 'ServiceController@clone')->name('service.clone');
  Route::get('doctors/{id}/clone', 'DoctorController@clone')->name('doctors.clone');
  Route::resource('files', 'FilesController');
  Route::resource('news', 'NewsController');
  Route::resource('art-categories', 'ArticleCategoryController');
});

