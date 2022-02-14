<?php

namespace App\Charts;

use App\Models\Month;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class FeesChart extends Chart
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
            ->title('Fees Collection')
            ->loaderColor('#46b8da')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);

        /*$this->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->title('Fees Collection')
            ->loaderColor('#46b8da')
            ->options([
                'legend' => [
                    'display' => true,
                ]
            ]);*/

    }
}
