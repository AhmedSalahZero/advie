<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Auth::routes();

# Auth Routes
/**************************************** Backoffice Homepage ********************************/
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
/**************************************** Manager Permitions ********************************/
Route::group(['prefix' => '/admin' , 'middleware' => ['auth']] , function () {
    Route::get('/languages', 'LanguageController@index')->name('languages.index');
    Route::get('/pages', 'PageController@index')->name('pages.index');
    Route::post('/pages','PageController@store')->name('pages.post');
    Route::post('/pages','PageController@create')->name('pages.create');
    Route::get('/pages/paginate_by_ajax','PageController@fetchDataByAjax');
    Route::get('/sections/paginate_by_ajax','SectionsController@fetchDataByAjax');
    Route::get('/sliders', 'SliderController@index')->name('sliders.index');
    Route::get('/sliders/paginate_by_ajax','SliderController@fetchDataByAjax');
    Route::Resource('/messages','MessagesController')->only(['index','edit']);
    /**************************************** Admin Permitions ********************************/


    Route::group(['middleware' => ['auth' , 'admin'] ] , function () {
        Route::get('/activities', 'Activitiescontroller@index')->name('activities.index');
        Route::get('/activities/paginate_by_ajax','Activitiescontroller@fetchDataByAjax');
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::get('/users/create', 'UsersController@create')->name('users.create');
        Route::post('/users/store', 'UsersController@store')->name('users.store');
        Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
        Route::put('/users/{id}/update', 'UsersController@update')->name('users.update');
        Route::DELETE('/users/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::get('/users/paginate_by_ajax','UsersController@fetchDataByAjax');
        Route::get('/roles', 'RolesController@index')->name('roles.index');
        Route::get('/roles/create', 'RolesController@create')->name('roles.create');
        Route::post('/roles/store', 'RolesController@store')->name('roles.store');
        Route::get('/roles/{id}/edit', 'RolesController@edit')->name('roles.edit');
        Route::put('/roles/{id}/update', 'RolesController@update')->name('roles.update');
        Route::DELETE('/roles/{id}', 'RolesController@destroy')->name('roles.destroy');
        Route::get('/roles/paginate_by_ajax','RolesController@fetchDataByAjax');
        Route::get('/users/{id}/role', 'UsersController@setRole')->name('role.user.to');
        Route::post('/users/role', 'UsersController@doRole')->name('role.user.store');
        // by me

        Route::Resource('/settings','SettingsController');
        Route::resource('/partners','PartnersController');
    });
    /**************************************** Creator Permitions ********************************/
    Route::group(['middleware' => ['auth' , 'creator'] ] , function () {
        Route::get('/pages/create', 'PageController@create')->name('pages.create');
        Route::get('/pages/create/select', 'PageController@selectItem')->name('pages.select');
        Route::post('/pages/store', 'PageController@store')->name('pages.store');
        Route::get('/languages/create', 'LanguageController@create')->name('languages.create');
        Route::post('/languages/store', 'LanguageController@store')->name('languages.store');
        Route::get('/sliders/create', 'SliderController@create')->name('sliders.create');
        Route::post('/sliders/store', 'SliderController@store')->name('sliders.store');
        Route::Resource('/sections','SectionsController');
        Route::resource('/services','ServicesController')->except('show');
        Route::resource('/projects','ProjectsController')->except('show');
        Route::resource('/blog','BlogController');
        Route::post('/pages/uploadImage','PageController@uploadImage')->name('upload.image');
        Route::get('/messages/paginate_by_ajax','MessagesController@fetchDataByAjax');
    });
    /**************************************** Remover Permitions ********************************/
    Route::group(['middleware' => ['auth' , 'remover'] ] , function () {
        Route::DELETE('/languages/{id}', 'LanguageController@destroy')->name('languages.destroy');
        Route::DELETE('/pages/{id}', 'PageController@destroy')->name('pages.destroy');
        Route::DELETE('/sliders/{id}', 'SliderController@destroy')->name('sliders.destroy');
    });
    /**************************************** Editor Permitions ********************************/
    Route::group(['middleware' => ['auth' ,'editor']] , function () {
        Route::get('/pages/{id}/edit', 'PageController@edit')->name('pages.edit');
        Route::put('/pages/{id}/update', 'PageController@update')->name('pages.update');
        Route::get('/languages/{id}/edit', 'LanguageController@edit')->name('languages.edit');
        Route::put('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
        Route::get('/sliders/{id}/edit', 'SliderController@edit')->name('sliders.edit');
        Route::put('/sliders/{id}/update', 'SliderController@update')->name('sliders.update');

    });
});

// front
Route::group(['prefix'=>'{lang}','middleware' => 'Localization'] , function() {

    Route::resource('/contact','ContactController')->only('index')->names([
        'index'=>'contact.index'
    ]);
    Route::get('/projects/{project}','ProjectsController@show')->name('projects.show');
    Route::resource('/news','NewsController')->only(['index','show']);
    Route::get('/market','MarketsController@show')->name('markets.show');

    Route::resource('/about','AboutController')->only('index');
    Route::resource('/services','ServicesController')->only('show');
    Route::Resource('/messages','MessagesController')->only(['store'])->middleware('web');

    Route::get('/{page}','HomeController@customPage');
    Route::get('/' , 'HomeController@homePage')->name('home.index');



//    Route::resource('/projects','ProjectsController')->only('show');



});

Route::redirect('/','/'.App()->getLocale());
