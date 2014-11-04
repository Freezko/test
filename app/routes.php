<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Return view file (for Angular)
|--------------------------------------------------------------------------
|
| Выдаем вьюшку если попадает под условия.
|
*/
Route::get('views/{path}.{extension}', function($path,$extension)
{

	if(strpos($path,'./') !== false){
		Redirect::to('/');
	}
	return View::make( 'ng/' . $path );

})->where('extension', 'php|html');



/*
|--------------------------------------------------------------------------
| Api routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'api'), function() {

	\Debugbar::disable();
	Route::get('statuses/{id}', 'StatusController@index')
		->where('id', '[A-Za-z0-9]{10,20}');

	Route::get('status/{id?}', function(){
			return Response::json(['status' => 400, 'message' => 'Неверный формат трекинг номера'], 400);
	});
});


/*
|--------------------------------------------------------------------------
| Catch All
|--------------------------------------------------------------------------
*/

App::missing(function($exception)
{
	return View::make('layouts.master');
});
