<?php

class AjaxSectorPageTest extends TestCase{
	public function testSectorDayChanges(){
		$this->visit('/ajax/sectors/all/daychanges')
			->see('Sector')->see('Change')
			->dontSee('Toggle navigation')
			->dontSee('Home')
			->dontSee('Sectors')
			->dontSee('Stocks')
			->dontSee('Search');
	}

	public function testOtherStocksInSector(){
		$this->visit('/ajax/sectors/Bank/otherstocksinsector')
			->see('Bank')
			->see('Code')
			->see('Name')
			->see('Share Price')
			->see('Day Change')
			->see('Mkt Cap')
			->see('ANZ')
			->see('Australia And New Zealand Banking Group Limited');
	}
}