<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('transport/user*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('transport.user') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;User</a>
        <a class="{!! request()->is('transport/route*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('transport.route') }}"><i class="fa fa-chain" aria-hidden="true"></i>&nbsp;Route</a>
        <a class="{!! request()->is('transport/vehicle*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('transport.vehicle') }}"><i class="fa fa-bus" aria-hidden="true"></i>&nbsp;Vehicle</a>

    </div>
</div>
<hr class="hr-6">