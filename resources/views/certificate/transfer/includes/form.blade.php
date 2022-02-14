<div class="form-group">
    {!! Form::label('tc_num', 'TC.No.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        @if(isset($data['row']) && !isset($data['tc_num']))
            {!! Form::text('tc_num', $data['row']->tc_num, ["class" => "form-control border-form","required","readonly"]) !!}
        @else
            {!! Form::text('tc_num', $data['tc_num'], ["class" => "form-control border-form","required","readonly"]) !!}
        @endif
        @include('includes.form_fields_validation_message', ['name' => 'tc_num'])
    </div>

    {!! Form::label('date_of_issue', 'Issue Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date_of_issue', null, ["class" => "form-control date-picker border-form input-mask-date"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date_of_issue'])
    </div>

    {!! Form::label('date_of_leaving', 'Leave Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('date_of_leaving', null, ["class" => "form-control date-picker border-form input-mask-date"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date_of_leaving'])
    </div>

    {!! Form::label('character', 'Character', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('character', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'character'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('leaving_time_class', 'Leaveing Time Level/Class', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('leaving_time_class', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'leaving_time_class'])
    </div>

    {!! Form::label('paid_fee_status', 'Fee Paid Status', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('paid_fee_status', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'paid_fee_status'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('qualified_to_promote', 'Qualified to Promote', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('qualified_to_promote', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'qualified_to_promote'])
    </div>
</div>

<hr class="hr-2">
@include('certificate.includes.student-detail')