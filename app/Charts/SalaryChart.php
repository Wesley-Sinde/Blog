<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SalaryChart extends Chart
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
            ->title('Salary Pay')
            ->loaderColor('#FF6384')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);
    }
}
