<div class="form-group">
    {!! Form::label('ac_name', 'AccName', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ac_name', null, ["placeholder" => "", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'ac_name'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('ac_type', 'AccType', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ac_type', null, ["placeholder" => "", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'ac_type'])
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Debit</label>
    <div class="col-sm-10">
        <select class="form-control border-form" name="dr">
            <option value=""> Select +/- </option>
            <option value="Increase" >Increase</option>
            <option value="Decrease" >Decrease</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Credit</label>
    <div class="col-sm-10">
        <select class="form-control border-form" name="cr">
            <option value=""> Select +/- </option>
            <option value="Increase" >Increase</option>
            <option value="Decrease" >Decrease</option>
        </select>
    </div>
</div>