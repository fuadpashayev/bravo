<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*********************Front**********************/

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/old', function(){
    return view('front.app.index_old');
});
Route::get('/language/{language?}', 'HomeController@setLocale')->name('setLocale');




/*********************Panel**********************/
Route::group(['prefix' => 'admin', 'middleware' => ['auth','lang'], 'as' => 'admin.'],function(){
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::delete('/categories/deleteSelecteds', 'CategoryController@destroySelecteds');
    Route::resource('/categories', 'CategoryController');

    Route::delete('/posts/deleteSelecteds', 'PostController@destroySelecteds');
    Route::resource('/posts', 'PostController');

    Route::delete('/menus/deleteSelecteds', 'MenuController@destroySelecteds');
    Route::resource('/menus', 'MenuController');

    Route::delete('/pages/deleteSelecteds', 'PageController@destroySelecteds');
    Route::resource('/pages', 'PageController');

    Route::delete('/sliders/deleteSelecteds', 'SliderController@destroySelecteds');
    Route::resource('/sliders', 'SliderController');

    Route::delete('/banners/deleteSelecteds', 'BannerController@destroySelecteds');
    Route::resource('/banners', 'BannerController');

    Route::delete('/offers/deleteSelecteds', 'OfferController@destroySelecteds');
    Route::resource('/offers', 'OfferController');

    Route::delete('/users/deleteSelecteds', 'UserController@destroySelecteds');
    Route::resource('/users', 'UserController');

    Route::delete('/roles/deleteSelecteds', 'RoleController@destroySelecteds');
    Route::resource('/roles', 'RoleController');

    Route::delete('/permissions/deleteSelecteds', 'PermissionController@destroySelecteds');
    Route::resource('/permissions', 'PermissionController');

    Route::delete('/languages/deleteSelecteds', 'LanguageController@destroySelecteds');
    Route::resource('/languages', 'LanguageController');

    Route::get('/translation_group/{translation_group}/translations', 'TranslationGroupController@translations')->name('translation_group.translations');
    Route::delete('/translation_groups/deleteSelecteds', 'TranslationGroupController@destroySelecteds');
    Route::resource('/translation_groups', 'TranslationGroupController');

    Route::get('/translations/exportView', 'TranslationController@exportView')->name('translations.exportView');
    Route::get('/translations/export', 'TranslationController@export')->name('translations.export');
    Route::get('/translations/create/{group?}', 'TranslationController@create');
    Route::delete('/translations/deleteSelecteds', 'TranslationController@destroySelecteds');
    Route::resource('/translations', 'TranslationController');

    Route::post('/mediaUpload', 'AdminController@mediaUpload')->name('mediaUpload');
    Route::post('/generateSlug', 'AdminController@generateSlug')->name('generateSlug');
    Route::post('/generateOrderNumberInParent', 'AdminController@generateOrderNumberInParent')->name('generateOrderNumberInParent');
    Route::post('/reorder', 'AdminController@reorder')->name('reorder');

    Route::get('/config', 'AdminController@index')->name('config');
    Route::get('/site', 'AdminController@index')->name('site');
});






