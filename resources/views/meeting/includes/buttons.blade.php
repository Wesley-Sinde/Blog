<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('meeting')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('meeting') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('meeting/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('meeting.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New {{$panel}}</a>
        @ability('super-admin','meeting-zoom-index')
        <a class="{!! request()->is('meeting/zoom-index')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('meeting.zoom-index') }}"><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;Zoom Index</a>
        @endability
    </div>
</div>
<hr class="hr-4">