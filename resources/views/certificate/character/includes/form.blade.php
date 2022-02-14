{{--'date_of_issue', 'course', 'period', 'character', 'ref_text','status'--}}
<div class="form-group">

    {!! Form::label('cc_num', 'CC.No.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        @if(isset($data['row']) && !isset($data['cc_num']))
            {!! Form::text('cc_num', $data['row']->cc_num, ["class" => "form-control border-form","required","readonly"]) !!}
        @else
            {!! Form::text('cc_num', $data['cc_num'], ["class" => "form-control border-form","required","readonly"]) !!}
        @endif
        @include('includes.form_fields_validation_message', ['name' => 'cc_num'])
    </div>

    {!! Form::label('date_of_issue', 'Issue Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date_of_issue', null, ["class" => "form-control date-picker border-form input-mask-date"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date_of_issue'])
    </div>

    {!! Form::label('year', 'Year', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::text('year', null, ["placeholder" => "YYYY", "class" => "form-control border-form "]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'year'])
    </div>

    {!! Form::label('character', 'Character', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('character', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'character'])
    </div>
</div>
<hr class="hr-2">
@include('certificate.includes.student-detail')