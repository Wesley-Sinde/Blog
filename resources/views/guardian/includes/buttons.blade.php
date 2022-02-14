<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('guardian')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('guardian') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('guardian/registration*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('guardian.registration') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
    </div>
    <hr class="hr-6 ">
</div>
