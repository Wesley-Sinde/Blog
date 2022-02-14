<div class="row">
    <div class="col-md-2 align-left">
        @if(isset($generalSetting->logo))
            <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="150px">
        @endif
    </div>
    <div class="col-md-10">
        <div class="text-center">
            <h6 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 14px">
                {{isset($generalSetting->salogan)?$generalSetting->salogan:""}}
            </h6>
            <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 30px">
                <strong>{{isset($generalSetting->institute)?$generalSetting->institute:""}}</strong>
            </h2>
            <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 18px">
                {{isset($generalSetting->address)?$generalSetting->address:""}}
            </h5>
            <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 16px">
                {{isset($generalSetting->phone)?$generalSetting->phone:""}}{{isset($generalSetting->email)?' ,'.$generalSetting->email:""}}
            </h5>
            <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 16px">
                {{isset($generalSetting->website)?$generalSetting->website:""}}
            </h5>
            {{--<h3 class="text-uppercase no-margin-top" style="font-family: 'Merienda', cursive; font-size: 22px">REGISTRATION DETAIL</h3>--}}
        </div>
    </div>
</div>