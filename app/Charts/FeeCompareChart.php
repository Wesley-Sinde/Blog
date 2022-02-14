<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\ChartJs\Chart;

class FeeCompareChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->labels(['Collected Fee', 'Due Fee'])
            ->title('Fee Compare')
            ->loaderColor('#46b8da')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);
    }
}
