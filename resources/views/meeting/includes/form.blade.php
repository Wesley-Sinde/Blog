<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>
<div class="row">
    <div class="form-group">
        <label class="col-sm-2 control-label">Faculty/Class</label>
        <div class="col-sm-5">
            {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}
        </div>

        <label class="col-sm-2 control-label">Sem./Sec.</label>
        <div class="col-sm-3">
            <select name="semesters_id" class="form-control semesters_id" onChange="loadSubject(this)" >
                <option value=""> Select Sem./Sec. </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-1 control-label">Subject</label>
        <div class="col-sm-3">
            <select name="subjects_id" class="form-control semester_subject" >
                <option> Select Subject </option>
            </select>
        </div>

        {!! Form::label('topic', 'Topic', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-7">
            {!! Form::text('topic', null, ["class" => "form-control","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'topic'])
        </div>

    </div>

    <div class="form-group">
        {!! Form::label('start_time', 'Start Date & Time ', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::datetime('start_time', null, ["id" => "date-timepicker1","class" => "form-control border-form","required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'start_time'])
        </div>

        {!! Form::label('duration', 'Duration', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-1">
            {!! Form::text('duration', null, ["class" => "form-control","required"]) !!} <em>In Minute</em>
            @include('includes.form_fields_validation_message', ['name' => 'duration'])
        </div>

        {!! Form::label('send_alert', 'Send Alert', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-4">
            <div class="checkbox">
            <label>{!! Form::radio('send_alert', 1 ,false, ["class" => "ace"]) !!}<span class="lbl"> Send Immediately</span></label>
            <label>{!! Form::radio('send_alert', 0 ,true, ["class" => "ace"]) !!}<span class="lbl">Not Send</span></label>
            </div>
        </div>
    </div>
</div>
<div class="hr hr-24"></div>
