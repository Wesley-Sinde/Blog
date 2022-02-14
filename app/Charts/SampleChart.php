<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->title('Fees Collection/Salary Pay')
            ->loaderColor('red')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);
    }

    public function chart(){
        $chart = new SampleChart;
        // Additional logic depending on the chart approach
        return view('dashboard.chart', ['chart' => $chart]);
    }
}
