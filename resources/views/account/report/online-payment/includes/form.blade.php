<div class="form-group">
    {!! Form::label('bank_name', 'Bank', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('bank_name', null, ["class" => "form-control border-form","required","autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'bank_name'])
    </div>

    {!! Form::label('ac_name', 'Account Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('ac_name', null, ["class" => "form-control border-form", "required",]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'ac_name'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('ac_number', 'Account Number', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('ac_number', null, ["class" => "form-control border-form", "required",]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'ac_number'])
    </div>

    {!! Form::label('branch', 'Branch', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('branch', null, ["class" => "form-control border-form", "required",]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'branch'])
    </div>

</div>