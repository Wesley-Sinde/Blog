<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('front/visitor')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('front.visitor') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Log Detail</a>
        <a class="{!! request()->is('front/visitor/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('front.visitor.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Visitor</a>
        <a class="{!! request()->is('front/visitor/purpose')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('front.visitor.purpose') }}"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;Visit Purpose</a>
    </div>
</div>
<hr class="hr-4">