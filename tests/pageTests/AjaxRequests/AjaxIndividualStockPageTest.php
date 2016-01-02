<?php

use App\Models\Historicals;

class AjaxIndividualStockPageTest extends TestCase{
	public function testCurrentStockPrice(){
		$this->visit('ajax/currentPrice/CBA');
	}

	public function testDayChange(){
		$this->visit('ajax/dayChange/CBA');
	}

	public function testRelatedStocks(){
		$this->visit('/ajax/relatedstocks/CBA')
			->see('Related Stocks')
			->see('ANZ')
			->see('Australia And New Zealand Banking Group Limited')
			->see('WBC')
			->see('Westpac Banking Corporation');
	}

	public function testStockGraph(){
		$mostRecentDateInGraph = Historicals::getMostRecentHistoricalDate('CBA');
		$mostRecentMonth = jdmonthname(explode("-", $mostRecentDateInGraph)[1], 0);
		$mostRecentYear = explode("-", $mostRecentDateInGraph)[0];

		$this->visit('/stockGraph/CBA/last_month/Price')
			->see('Date')
			->see('Price')
			->see($mostRecentMonth)
			->see($mostRecentYear);

		$this->visit('/stockGraph/CBA/all_time/Price')
			->see('Date')
			->see('Price')
			->see('Feb 1, 2000')
			->see($mostRecentMonth)
			->see($mostRecentYear);
	}
}