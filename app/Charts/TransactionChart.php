<?php

namespace App\Charts;

use App\Models\Month;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TransactionChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $months = Month::get()->pluck('title');

        $this->labels($months)
            ->title('Transaction')
            ->loaderColor('#FF6384')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);
    }
}
