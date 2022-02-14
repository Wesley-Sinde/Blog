<div class="row" >
    <div class="col-md-1 align-left" style="height: 100px;">
        @if(isset($generalSetting->logo))
            <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="100px">
        @endif
    </div>
    <div class="col-md-11 text-center">
        {{--Anton|Archivo+Black|Josefin+Sans|Poppins|Russo+One|--}}
        <h6 class="no-margin-top" style="font-size: 14px">
            {{isset($generalSetting->salogan)?$generalSetting->salogan:""}}
        </h6>
        <h2 class="no-margin-top text-uppercase" style="font-family: 'Bowlby+One+SC'; font-size: 30px; font-weight: 600">
            <strong>{{isset($generalSetting->institute)?$generalSetting->institute:""}}</strong>
        </h2>
        <h5 class="no-margin-top" style="font-size: 16px;">
            {{isset($generalSetting->address)?$generalSetting->address:""}}, {{isset($generalSetting->phone)?$generalSetting->phone:""}}
        </h5>
        <h5 class="no-margin-top" style="font-size: 16px;">
            {{isset($generalSetting->email)?$generalSetting->email:""}}, {{isset($generalSetting->website)?$generalSetting->website:""}}
        </h5>

    </div>
</div>
<div class="space-4"></div>

{{--
<div class="row">
    <div class="col-md-1 align-left">
        @if(isset($generalSetting->logo))
            <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="150px">
        @endif
    </div>
    <div class="col-md-11 text-center">
        <h6 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 14px">
            {{isset($generalSetting->salogan)?$generalSetting->salogan:""}}
        </h6>
        <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 30px">
            <strong>{{isset($generalSetting->institute)?$generalSetting->institute:""}}</strong>
        </h2>
        <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 16px">
            {{isset($generalSetting->address)?$generalSetting->address:""}}
        </h5>
        <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 14px">
            {{isset($generalSetting->phone)?$generalSetting->phone:""}}, {{isset($generalSetting->email)?$generalSetting->email:""}}
        </h5>
        <h5 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 14px">
            {{isset($generalSetting->website)?$generalSetting->website:""}}
        </h5>
        --}}
{{--<h3 class="text-uppercase no-margin-top" style="font-family: 'Merienda', cursive; font-size: 22px">REGISTRATION DETAIL</h3>--}}{{--

    </div>
</div>--}}