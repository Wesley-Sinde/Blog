<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('setting/general')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.general') }}"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;General Setting</a>
        <a class="{!! request()->is('setting/sms')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.sms') }}"><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;SMS Setting</a>
        <a class="{!! request()->is('setting/email')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.email') }}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;E-Mail Setting</a>
        <a class="{!! request()->is('setting/alert*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.alert') }}"><i class="fa fa-bell icon-animated-bell" aria-hidden="true"></i>&nbsp;Alert Setting</a>
        <a class="{!! request()->is('setting/payment-gateway')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.payment-gateway') }}"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;Payment Gateway</a>
        <a class="{!! request()->is('setting/meeting')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('setting.meeting') }}"><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp; Meeting - Remote Class</a>

    </div>
</div>
<hr class="hr-4">