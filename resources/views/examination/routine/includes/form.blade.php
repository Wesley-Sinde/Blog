<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Meet Your Target Exam</h4>
<div class="form-horizontal ">
    <div class="clearfix">
        <div class="form-group">
            {!! Form::label('years_id', 'Year', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('years_id', $data['years'], null, ["class" => "form-control border-form","required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'years_id'])
            </div>

            {!! Form::label('months_id', 'Month', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('months_id', $data['months'], null, ["class" => "form-control border-form","required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'months_id'])
            </div>

            {!! Form::label('exams_id', 'Exam', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('exams_id', $data['exams'], null, ["class" => "form-control border-form chosen-select","required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'exams_id'])
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Faculty/Class</label>
            <div class="col-sm-5">
                {!! Form::select('target_faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}
            </div>

            <label class="col-sm-2 control-label">Sem./Sec.</label>
            <div class="col-sm-3">
                <select name="semester_select" class="form-control semester_select">
                    <option> Select Sem./Sec. </option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix form-actions">
        <div class="align-right">
            <button class="btn btn-info" type="submit" id="print-btn">
                <i class="fa fa-print bigger-110"></i>
                Print Routine/Schedule
            </button>
        </div>
    </div>
    <div class="hr hr-24"></div>
</div>
