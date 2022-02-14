<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Student</h4>
<div class="form-horizontal">
    <div class="form-group">
        {!! Form::label('Date', 'Date', ['class' => 'col-sm-2 control-label']) !!}
        <div class=" col-sm-3">
                {!! Form::text('date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required", "onChange"=>"loadStaff(this);"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'date'])
        </div>

        <label class="col-sm-2 control-label">Designation</label>
        <div class="col-sm-5">
            {!! Form::select('designation', $data['designation'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadStaff(this);']) !!}
        </div>
    </div>
    <div class="hr hr-18 dotted hr-double"></div>
</div>
<!-- Option Values -->


