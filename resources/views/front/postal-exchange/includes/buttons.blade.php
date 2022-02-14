<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('front/postal-exchange')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('front.postal-exchange') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('front/postal-exchange/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('front.postal-exchange.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Exchange</a>
        <a class="{!! request()->is('front/postal-exchange/type')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('front.postal-exchange.type') }}"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;Exchange Type</a>
    </div>
</div>
<hr class="hr-4">