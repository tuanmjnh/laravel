<?php

Route::group(['middleware' => 'web', 'prefix' => '/', 'namespace' => 'Modules\Frontend\Http\Controllers'], function()
{
	Route::get('/', 'FrontendController@index');
});