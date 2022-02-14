{{--'date_of_issue', 'course', 'period', 'character', 'ref_text','status'--}}
<div class="form-group">
    {!! Form::label('date_of_issue', 'Issue Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date_of_issue', null, ["class" => "form-control date-picker border-form input-mask-date"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date_of_issue'])
    </div>

    {!! Form::label('period', 'Period', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::text('period', null, ["placeholder" => "YYYY-YYYY", "class" => "form-control border-form "]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'period'])
    </div>

    {!! Form::label('course', 'Course', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('course', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'course'])
    </div>

    {!! Form::label('character', 'Character', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('character', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'character'])
    </div>
</div>
<hr class="hr-2">
@include('certificate.includes.student-detail')