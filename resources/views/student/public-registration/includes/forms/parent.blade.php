<hr class="hr-8">
<div class="label label-warning arrowed-in arrowed-right arrowed">Parent's Detail</div>
<div class="space-8"></div>
<div class="form-group">
    {!! Form::label('father_name', 'NAME OF FATHER', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('father_first_name', null, [ "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'father_first_name'])
    </div>
    <div class="col-sm-3">
        {!! Form::text('father_middle_name', null, ["class" => "form-control border-form upper"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'father_first_name'])
    </div>
    <div class="col-sm-3">
        {!! Form::text('father_last_name', null, [ "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'father_last_name'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('mother_name', 'NAME OF MOTHER', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('mother_first_name', null, [ "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'mother_first_name'])
    </div>
    <div class="col-sm-3">
        {!! Form::text('mother_middle_name', null, ["class" => "form-control border-form upper"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'mother_first_name'])
    </div>
    <div class="col-sm-3">
        {!! Form::text('mother_last_name', null, [ "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'mother_last_name'])
    </div>
</div>

<hr class="hr-8">
<div class="label label-warning arrowed-in arrowed-right arrowed">Guardian's Detail</div>

<div class="control-group col-sm-12">
    <div class="radio">
        <label>
            {!! Form::radio('guardian_is', 'father_as_guardian', false, ['class' => 'ace', "onclick"=>"FatherAsGuardian(this.form)"]) !!}
            <span class="lbl"> Father is Guardian</span>
        </label>
        <label>
            {!! Form::radio('guardian_is', 'mother_as_guardian', false, ['class' => 'ace',"onclick"=>"MotherAsGuardian(this.form)"]) !!}
            <span class="lbl"> Mother is Guardian</span>
        </label>
        <label>
            {!! Form::radio('guardian_is', 'other_guardian', true, ['class' => 'ace', "onclick"=>"OtherGuardian(this.form)"]) !!}
            <span class="lbl"> Other's</span>
        </label>
        {{--<label>
            {!! Form::radio('guardian_is', 'link_guardian', false, ['class' => 'ace', "onclick"=>"linkGuardian(this.form)"]) !!}
            <span class="lbl"> Link Guardian</span>
        </label>--}}
    </div>
</div>
<hr>
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
        {!! Form::label('guardian_mobile_1', 'Mobile 1', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('guardian_mobile_1', null, ["class" => "form-control border-form input-mask-mobile","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_mobile_1'])
        </div>

        {!! Form::label('guardian_email', 'E-mail', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_email', null, ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_email'])
        </div>

        {!! Form::label('guardian_relation', 'Relation', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('guardian_relation', null, ["class" => "form-control border-form upper","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_relation'])
        </div>
    </div>

    <div class="form-group">


       {{-- {!! Form::label('guardian_address', 'Guardian Address', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('guardian_address', null, ["class" => "form-control border-form upper", "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'guardian_address'])
        </div>--}}
    </div>
</div>
