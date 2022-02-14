<div class="text-center">
    @if(isset($generalSetting->print_footer))
        <div class="hr hr-2"></div>
        {!! $generalSetting->print_footer !!}
    @endif
    <span class="invoice-info-label">User:</span>
    <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>,
    <span class="invoice-info-label">Date:</span>
    <span class="blue">{{$date =  \Carbon\Carbon::parse(now())->format('Y-m-d')}}</span>

</div>
