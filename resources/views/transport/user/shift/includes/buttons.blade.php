<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('hostel/resident')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('hostel.resident') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('hostel/resident/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('hostel.resident.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
        <a class="{!! request()->is('hostel/resident/history')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('hostel.resident.history') }}"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;History</a>
    </div>
</div>