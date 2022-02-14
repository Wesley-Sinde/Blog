<div class="form-group">
    {!! Form::label('date_of_issue', 'Issue Date', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date_of_issue', null, ["class" => "form-control date-picker border-form input-mask-date","readonly"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date_of_issue'])
    </div>
    {!! Form::label('year_of_study', 'Year of Study', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('year_of_study', null, ["placeholder" =>"2018-19","class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'year_of_study'])
    </div>

    {!! Form::label('percentage_of_attendance', 'Percentage of Attendance', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('percentage_of_attendance', null, ["class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'percentage_of_attendance'])
    </div>
</div>

<hr class="hr-2">
@include('certificate.includes.student-detail')