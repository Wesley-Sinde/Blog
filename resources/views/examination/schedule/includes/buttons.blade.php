<div class="clearfix hidden-print ">
    <div class="easy-link-menu">
        <a class="{!! request()->is('exam/schedule')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('exam.schedule') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Schedules List</a>
        <a class="{!! request()->is('exam/schedule/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('exam.schedule.add') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Schedule/Modify</a>
    </div>
</div>
<hr class="hr-6">