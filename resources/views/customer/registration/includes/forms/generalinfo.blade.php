<span class="label label-info arrowed-in arrowed-right arrowed responsive">Red mark input field are required. </span>
<hr class="hr-16">

<div class="form-group">
    {!! Form::label('reg_no', 'RegNo', ['class' => 'col-sm-1 control-label',]) !!}
    <div class="col-sm-2">
        {!! Form::text('reg_no', isset($data['CustomerRegCode'])?$data['CustomerRegCode']:null, ["class" => "form-control border-form upper","readonly"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
    </div>

    {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label',]) !!}
    <div class="col-sm-4">
        {!! Form::text('name', null, ["class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('email', 'E-mail', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('email', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>


</div>

<div class="form-group">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-1 control-label',]) !!}
    <div class="col-sm-7">
        {!! Form::text('address', null, ["class" => "form-control border-form upper"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>

    @if (!isset($data['row']))
        <label class="col-sm-1 control-label">Type</label>
        <div class="col-sm-3">
            {!! Form::select('customer_status', $data['customer_status'], 1, ['class' => 'form-control', "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'customer_status'])
        </div>
    @else
        <label class="col-sm-1 control-label">Status</label>
        <div class="col-sm-3">
            {!! Form::select('customer_status', $data['customer_status'], null, ['class' => 'form-control']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'customer_status'])
        </div>
    @endif
</div>

<div class="form-group">
    {!! Form::label('tel', 'Tel', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('tel', null, ["class" => "form-control border-form input-mask-phone"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'tel'])
    </div>

    {!! Form::label('mobile_1', 'Mobile 1', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('mobile_1', null, ["class" => "form-control border-form input-mask-mobile"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'mobile_1'])
    </div>

    {!! Form::label('mobile_2', 'Mobile 2', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('mobile_2', null, ["class" => "form-control border-form input-mask-mobile"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'mobile_2'])
    </div>
</div>
@if(isset($data['CustomerRegCode']))
<div class="form-group">
    <label for="account_type" class="col-sm-4 control-label">Opening Balance <i class="text-danger">*</i></label>
    <div class="col-sm-4">
        <select class="form-control" id="account_type" name="account_type" autocomplete="off">
            <option value="dr_amt">Debit (+)</option>
            <option value="cr_amt">Credit (-)</option>
        </select>
    </div>
    <div class="col-sm-4">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"  autocomplete="off">
    </div>
</div>
@endif

<div class="form-group">
    {!! Form::label('extra_info', 'Extra Info', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('extra_info', null, ["class" => "form-control border-form", "rows"=>"3"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'extra_info'])
    </div>
</div>



