<?php

Route::group(['middleware' => 'web', 'prefix' => 'dblog', 'namespace' => 'App\\Components\DBLog\Http\Controllers'], function()
{
    Route::get('/', 'DBLogController@index');
});
