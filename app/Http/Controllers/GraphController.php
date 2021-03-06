<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SectorIndexHistoricals;
use App\Models\Stock;
use App\Models\StockMetrics;
use Khill\Lavacharts\Lavacharts;

class GraphController extends Controller
{
    public function stock($stockCode, $timeFrame, $dataType){
        $graphData = Stock::getGraphData($stockCode, $timeFrame, $dataType);
        $prices = \Lava::DataTable();
        $prices->addStringColumn('Date')
            ->addNumberColumn($dataType)
            ->addNumberColumn('50 Day Moving Average')
            ->addNumberColumn('200 Day Moving Average')
            ->addRows($graphData);
        return $prices->toJson();
    }

    public function sector($sectorName, $timeFrame, $dataType){
        $graphData = SectorIndexHistoricals::getIndividualSectorGraphData($sectorName, $timeFrame, $dataType);
        $prices = \Lava::DataTable();
        $prices->addStringColumn('Date')
            ->addNumberColumn($dataType)
            ->addRows($graphData);
        return $prices->toJson();
    }

    public function sectorCapsPieChart($numberOfSectors){
        $graphData = SectorIndexHistoricals::getAllSectorGraphData($numberOfSectors);
        $sectorCaps = \Lava::DataTable();
        $sectorCaps->addStringColumn('Sector Name') 
            ->addNumberColumn('Percent')
            ->addRows($graphData);
        return $sectorCaps->toJson();
    }

    public function stocksInSectorPieChart($sectorName, $numberOfStocks){
        $graphData = StockMetrics::getMarketCapsInSectorGraphData($sectorName, $numberOfStocks);
        $stockMarketCaps = \Lava::DataTable();
        $stockMarketCaps->addStringColumn('Company Name')
            ->addNumberColumn('Percent')
            ->addRows($graphData);
        return $stockMarketCaps->toJson();
    }
}
