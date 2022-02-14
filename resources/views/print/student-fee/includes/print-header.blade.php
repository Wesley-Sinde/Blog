<div class="col-sm-12 align-right hidden-print">
    <div class="space-10"></div>
    <a href="#" class="btn-primary btn-lg" onclick="window.print();">
        <i class="ace-icon fa fa-print"></i> Print
    </a>
    <div class="space-10"></div>
</div>
{{--
<div class="widget-header widget-header-large">
    --}}
{{--<h3 class="widget-title grey lighter no-margin-bottom">
        <i class="ace-icon fa fa-calculator green"></i> Receipt No: #{{ \Carbon\Carbon::parse(now())->format('dmy')}}-{{$data['student']->reg_no}}
    </h3>--}}{{--


    <div class="widget-toolbar no-border invoice-info">
        <span class="invoice-info-label">User:</span>
        <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>,
        <span class="invoice-info-label">Date:</span>
        <span class="blue">{{$date =  \Carbon\Carbon::parse(now())->format('Y-m-d')}}</span>
    </div>

    <div class="widget-toolbar hidden-480">
        <a href="#" onclick="window.print()">
            <i class="ace-icon fa fa-print bigger-180"></i>
        </a>
    </div>
</div>--}}
