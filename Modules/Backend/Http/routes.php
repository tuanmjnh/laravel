<?php

//Auth
Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Backend\Http\Controllers'], function () {
    Route::get('/auth', ['as' => 'auth', 'uses' => 'AdminAuthController@index']);
    Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'AdminAuthController@login']);
    Route::get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'AdminAuthController@logout']);
    Route::get('/auth/user', ['as' => 'auth.user', 'uses' => 'AdminAuthController@get_user']);
    Route::get('/auth/check', ['as' => 'auth.check', 'uses' => 'AdminAuthController@check']);
});

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Backend\Http\Controllers'], function () {
//    Route::get('/', 'backendController@index'); auth:admin,api
    Route::get('/', ['as' => 'dashboard', 'uses' => 'dashboardController@index', function () {
    }]);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'dashboardController@index']);

    //Roles
    Route::get('/roles/{id}/delete', ['as' => 'roles.delete', 'uses' => 'RolesController@destroy']);
    Route::get('/roles/datatable', ['as' => 'roles.datatable', 'uses' => 'RolesController@datatable']);
    Route::resource('roles', 'RolesController');

    //Language
    Route::get('/language/{id}/delete', ['as' => 'language.delete', 'uses' => 'languageController@destroy']);
    Route::get('/language/datatable', ['as' => 'language.datatable', 'uses' => 'languageController@datatable']);
    //Route::resource('api/language', 'API\languageAPIController');
    Route::resource('language', 'LanguageController');
    Route::get('/set-language/', ['as' => 'admin.language.set-language', 'uses' => 'languageController@set_language']);

    //Setting
    Route::get('settings/{id}/delete', ['as' => 'settings.delete', 'uses' => 'settingsController@destroy']);
    //Route::resource('api/settings', 'API\settingAPIController');
    Route::resource('settings', 'settingsController');

    //Test
    Route::get('/test', function () {
        //$config = new setting;

        // $config->CVKey = 'setting';
        // $config->CVSKey = 'theme';
        // $config->CVValue = 'default';
        // $config->CVDesc = 'This is default theme';
        // $config->CVPlus = '';

        // $config->save();

        //$list = setting::all();
        //dd($list->toArray());
    });

    //Clear cache
    Route::get('/clear-cache', ['as' => 'clear-cache', 'uses' => 'clearController@index']);
});