<div class="clearfix hidden-print" >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('certificate/course-completion*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.course-completion') }}"><i class="fa fa-calendar" aria-hidden="true"></i> {{$panel}} Detail</a>
        {{--<a class="{!! request()->is('certificate/template')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.template') }}"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Certificate Template</a>--}}
    </div>
</div>
<hr class="hr-4">