<?php

Route::group(['middleware' => 'web', 'prefix' => 'MQTT', 'namespace' => 'Modules\MQTT\Http\Controllers'], function()
{
    Route::get('/', 'MQTTController@index');
});
