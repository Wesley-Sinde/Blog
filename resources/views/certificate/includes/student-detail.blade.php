<div id="accordion" class="accordion-style1 panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                    Show Student Detail <em>[Note: Student records pull from registration. If you want to change any, please change registration record.]</em>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                {!! Form::hidden('students_id', $data['row']->id, ["class" => "form-control border-form"]) !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Faculty/Class</label>
                    <div class="col-sm-4">
                        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control',"readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'faculty'])
                    </div>

                    <label class="col-sm-1 control-label">Sem./Sec.</label>
                    <div class="col-sm-2">
                        {!! Form::select('semester', $data['semester'], null, ['class' => 'form-control',"readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'semester'])
                    </div>

                    <label class="col-sm-1 control-label">Batch</label>
                    <div class="col-sm-2">
                        {!! Form::select('semester', $data['batch'], null, ['class' => 'form-control',"readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'semester'])
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('reg_no', 'REG.NO.', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
                    </div>

                    {!! Form::label('reg_date', 'Date of Admission', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('reg_date', null, ["class" => "form-control date-picker border-form input-mask-date","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'reg_date'])
                    </div>

                    {!! Form::label('university_reg', 'UNIVERSITY REG. NO.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('university_reg', null, ["placeholder" => "", "class" => "form-control border-form","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'university_reg'])
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('first_name', 'NAME OF STUDENT', ['class' => 'col-sm-3 control-label',]) !!}
                    <div class="col-sm-3">
                        {!! Form::text('first_name', null, ["class" => "form-control border-form upper","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'first_name'])
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('middle_name', null, ["class" => "form-control border-form upper","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'middle_name'])
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('last_name', null, ["class" => "form-control border-form upper","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'last_name'])
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('date_of_birth', 'Date of Birth', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('date_of_birth', null, ["data-date-format" => "dd-mm-yyyy", "class" => "form-control border-form input-mask-date","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'date_of_birth'])
                    </div>

                    {!! Form::label('gender', 'Gender', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::select('gender', ['' => '','MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'OTHER' => 'OTHER'], null, ['class'=>'form-control border-form',"required","readonly"]); !!}
                        @include('includes.form_fields_validation_message', ['name' => 'gender'])
                    </div>

                    {!! Form::label('blood_group', 'BloodGroup', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('blood_group', null, ["class" => "form-control border-form","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'blood_group'])
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('nationality', 'Nationality', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('nationality', null, ["class" => "form-control border-form","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'nationality'])
                    </div>

                    {!! Form::label('religion', 'Religion', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('religion', null, ["class" => "form-control border-form","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'religion'])
                    </div>

                    {!! Form::label('caste', 'Caste', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('caste', null, ["class" => "form-control border-form","required","readonly"]) !!}
                        @include('includes.form_fields_validation_message', ['name' => 'caste'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>