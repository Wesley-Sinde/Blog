<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

<div class="form-group">
    {!! Form::label('user_type', 'Type', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::select('user_type', ["0"=>"Select Type","1"=>"Student","2"=>"Staff"], null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::label('reg_no', 'REG No.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
    </div>

    {!! Form::label('hostel', 'Hostel', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('hostel', $data['hostels'], null, ['class' => 'form-control', "required", "onChange" => "loadRooms(this)"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'hostel'])
    </div>
</div>

@if(!isset($data['row']))
    <div class="form-group">
        <label class="col-sm-2 control-label">Room</label>
        <div class="col-sm-4">
            <select name="room_select" class="form-control room_select" onChange="loadBeds(this)">
                <option> Select Room </option>
            </select>
        </div>

        <label class="col-sm-2 control-label">Bed</label>
        <div class="col-sm-4">
            <select name="bed_select" class="form-control bed_select">
                <option> Select Bed </option>
            </select>
        </div>
    </div>
@endif
