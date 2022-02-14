<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('assignment')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('assignment') }}"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Assignment Detail</a>
        <a class="{!! request()->is('assignment/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('assignment.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Assignment</a>
    </div>
</div>
<hr class="hr-4">