<div class="form-group">
    <label class="col-sm-2 control-label">Faculty/Class</label>
    <div class="col-sm-4">
        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}
    </div>

    <label class="col-sm-2 control-label">Sem./Sec.</label>
    <div class="col-sm-4">
        <select name="semester_select" class="form-control semester_select" >
            <option value="0"> Select Sem./Sec. </option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Assets</label>
    <div class="col-sm-4">
        {!! Form::select('assets', $data['assets'], null, ['class' => 'form-control chosen-select']) !!}
    </div>

    {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('quantity', null, ["class" => "form-control border-form", "required",]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'quantity'])
    </div>

</div>