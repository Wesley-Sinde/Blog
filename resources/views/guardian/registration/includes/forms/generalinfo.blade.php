<span class="label label-info arrowed-in arrowed-right arrowed responsive">Red mark input are required. </span>
<div id="guardian-detail">
    <hr class="hr-8">
    <div class="form-group">
        {!! Form::label('guardian_name', 'NAME OF GUARDIAN', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('guardian_first_name', null, [ "class" => "form-control border-form upper","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_first_name'])
        </div>
        <div class="col-sm-3">
            {!! Form::text('guardian_middle_name', null, ["class" => "form-control border-form upper"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_first_name'])
        </div>
        <div class="col-sm-3">
            {!! Form::text('guardian_last_name', null, [ "class" => "form-control border-form upper","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_last_name'])
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('guardian_eligibility', 'Eligibility', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_eligibility', null, ["placeholder" => "", "class" => "form-control border-form upper"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_eligibility'])
        </div>

        {!! Form::label('guardian_occupation', 'Occupation', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_occupation', null, ["placeholder" => "", "class" => "form-control border-form upper"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_occupation'])
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('guardian_office', 'Office', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_office', null, ["placeholder" => "", "class" => "form-control border-form upper"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_office'])
        </div>

        {!! Form::label('guardian_office_number', 'Office Number', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_office_number', null, ["placeholder" => "", "class" => "form-control border-form input-mask-mobile"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_office_number'])
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('guardian_residence_number', 'Residence Number', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_residence_number', null, ["class" => "form-control border-form input-mask-phone"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_residence_number'])
        </div>

        {!! Form::label('guardian_mobile_1', 'Mobile 1', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_mobile_1', null, ["class" => "form-control border-form input-mask-mobile","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_mobile_1'])
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('guardian_mobile_2', 'Mobile 2', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_mobile_2', null, ["class" => "form-control border-form input-mask-mobile"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_mobile_2'])
        </div>

        {!! Form::label('guardian_email', 'E-mail', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_email', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_email'])
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('guardian_relation', 'Relation', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_relation', null, ["class" => "form-control border-form upper","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_relation'])
        </div>

        {!! Form::label('guardian_address', 'Guardian Address', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_address', null, ["class" => "form-control border-form upper", "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_address'])
        </div>
    </div>
</div>