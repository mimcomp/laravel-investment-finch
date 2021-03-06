<?php
Route::get('/', 'PageController@index');
Route::resource('stock', 'StockController'); //'stock' and 'stocks' can both be routed
Route::resource('stocks', 'StockController'); //'stock' and 'stocks' can both be routed
Route::resource('sectors', 'SectorController');
Route::get('search/autocomplete', ['uses' => 'SearchController@autocomplete', 'as' => 'search.autocomplete']);
Route::get('index/{marketIndex}', 'StockController@index');
Route::get('performance', 'PageController@performance');

Route::get('about', 'PageController@about');
Route::get('contact', 'PageController@contact');
Route::get('privacy', 'PageController@privacy');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/discontinued', 'DashboardController@discontinued');
	Route::get('/marketCapAdjustments/{stockCode}/{addOrRemove}', 'DashboardController@changeStockAdjustmentStatus');
	Route::get('/addToBillionCapList/{stockCode}', 'DashboardController@addToBillionCapList');
	Route::get('/marketCapAdjustments', 'DashboardController@marketCapAdjustmentsPage');
	Route::post('/adminOptions', 'DashboardController@adminOptions');

	Route::group(['prefix' => 'ajax'], function(){
		Route::get('marketCapAdjustments', 'DashboardController@ajaxMarketCapAdjustments');
	});
});

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function(){
	Route::resource('watchlist', 'WatchlistController');
	Route::resource('portfolio', 'PortfolioController');
	Route::resource('account', 'UserController');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'ajax'], function(){
	Route::get('stock/stockChange/{stockCode}', 'StockController@stockChange');
	Route::get('stocks/highestVolume', 'StockController@highestVolume');
	Route::get('stocks/{marketIndex}', 'StockController@stocks');
	Route::get('relatedstocks/{stockCode}', 'StockController@relatedStocks');
	Route::get('sectors/topPerforming/{topOrBottom}', 'SectorController@topPerformingSectors');
	Route::get('sectors/{sectorName}/daychanges', 'SectorController@sectorDayChanges');
	Route::get('sectors/{sectorName}/otherstocksinsector', 'SectorController@otherStocksInSector');
	Route::get('/marketstatus','MarketController@status');
	Route::get('/marketchange', 'MarketController@change');
	Route::get('/marketOpenClosed', 'MarketController@openClosed');
	Route::get('/marketTime', 'MarketController@time');
	Route::get('/simpleMarketChange', 'MarketController@simpleChange');

	Route::group(['prefix' => 'graph'], function(){
		Route::get('stock/{stockCode}/{timeFrame}/{dataType}', 'GraphController@stock');
		Route::get('sector/{sectorName}/{timeFrame}/{dataType}', 'GraphController@sector');
		Route::get('sectorPie/{numberOfSectors}', 'GraphController@sectorCapsPieChart');
		Route::get('sectors/stocksInSectorPieChart/{sectorName}/{numberOfStocks}', 'GraphController@stocksInSectorPieChart');
	});
});

/*route::get('/test', function(){
});*/