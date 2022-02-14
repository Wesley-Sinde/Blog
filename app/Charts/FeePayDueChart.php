<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class FeePayDueChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($a,$b)
    {
        parent::__construct();

        $this->labels([$a, $b])
            ->title('Fee Compare')
            ->loaderColor('#46b8da')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);
    }
}
