@if(auth()->user()->roles[0]->slug == "super_admin" || auth()->user()->roles[0]->slug == "college_admin")
    <div class="row">
        <div class="infobox infobox-blue infobox-small infobox-dark">
            <div class="infobox-chart">
                <span class="sparkline" data-values="3,4,2,3,4,4,2,2">
                    <canvas width="39" height="19" style="display: inline-block; width: 39px; height: 19px; vertical-align: top;"></canvas>
                </span>
            </div>

            <div class="infobox-data">
                <div class="infobox-content">Fee</div>
                <div class="infobox-content">
                    {{$data['feeCollectionIndicator']?$data['feeCollectionIndicator']:''}}
                </div>
            </div>
        </div>
        <div class="infobox infobox-orange infobox-small infobox-dark">
            <div class="infobox-chart">
                <span class="sparkline" data-values="3,4,2,3,4,4,2,2">
                    <canvas width="39" height="19" style="display: inline-block; width: 39px; height: 19px; vertical-align: top;"></canvas>
                </span>
            </div>

            <div class="infobox-data">
                <div class="infobox-content">Salary</div>
                <div class="infobox-content">
                    {{$data['salaryPayIndicator']?$data['salaryPayIndicator']:''}}
                </div>
            </div>
        </div>

    </div>
@endif
