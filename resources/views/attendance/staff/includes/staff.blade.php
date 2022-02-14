<h4 class="header large lighter blue"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>
<div class="col-sm-3"></div>
<!-- div.table-responsive -->
<table id="staffsTable" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>S.N.</th>
            <th> </th>
            <th>Reg.Num</th>
            <th>Staff Name</th>
            <th>
                {{--Attendance Status--}}
                @foreach($data['attendance_status'] as $status)
                    <label class="pos-rel">
                        {!! Form::radio('mark-all', $status->id, false, ['class' => 'ace','id' => 'mark-'.$status->id,"required"]) !!}
                        <span class="lbl"></span> <span class="{{ $status->display_class }} btn-sm">{{$status->title}} All</span>
                    </label>
                @endforeach
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody id="staff_wrapper">

    </tbody>
</table>
