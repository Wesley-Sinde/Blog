<div class="form-group">
    {!! Form::label('fee_head_title', 'Head', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('fee_head_title', null, ["placeholder" => "e.g. Monthly Fee", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'fee_head_title'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('fee_head_amount', 'Amount', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('fee_head_amount', null, ["placeholder" => "e.g. 5000", "class" => "form-control border-form upper"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'fee_head_amount'])
    </div>
</div>

<div class="hr hr-24"></div>
