<?php
Route::get('/', 'SearchController@show');
Route::resource('search', 'SearchController');

Route::get('sector/daychanges', 'SectorController@sectorDayChanges');
Route::get('sector/otherstocksinsector', 'SectorController@otherStocksInSector');
Route::resource('sector', 'SectorController');

Route::get('graph/{stockCode}/{timeFrame}/{dataType}', 'StockController@graph');
Route::get('relatedstocks/{stockCode}', 'StockController@relatedStocks');
Route::resource('stock', 'StockController');

Route::get('/marketstatus','SearchController@marketStatus');
Route::get('/marketchange', 'SearchController@marketChange');

/*route::get('/test', function(){
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/