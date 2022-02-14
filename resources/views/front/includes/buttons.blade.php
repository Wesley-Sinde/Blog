<div class="clearfix hidden-print">
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('front/postal-exchange')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('front.postal-exchange') }}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Postal Exchange</a>
        <a class="{!! request()->is('front/visitor')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('front.visitor') }}"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Visitor Log</a>
    </div>
</div>
<hr class="hr-4">