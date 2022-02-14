<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

<div class="form-group">
    {!! Form::label('user_type', 'Type', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::select('user_type', ["0"=>"Select Type","1"=>"Student","2"=>"Staff"], null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::label('reg_no', 'REG No.', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('reg_no', $data['reg_no'], ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
    </div>

    {!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::select('status', ["active"=>"Active","in-active"=>"In-Active"], null, ['class' => 'form-control']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'status'])
    </div>

</div>

@if(!isset($data['row']))
    <div class="form-group">
        {!! Form::label('route', 'Route', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('route', $data['routes'], null, ['class' => 'form-control', "onChange" => "loadVehicle(this)"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'route'])
        </div>
        <label class="col-sm-2 control-label">Vehicle</label>
        <div class="col-sm-4">
            <select name="vehicle_select" class="form-control vehicle_select">
                <option value="0"> Select Vehicle </option>
            </select>
        </div>
    </div>
@endif
