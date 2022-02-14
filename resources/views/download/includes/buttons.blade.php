<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('download')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('download') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('download/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('download.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New {{$panel}}</a>
    </div>
</div>
<hr class="hr-4">