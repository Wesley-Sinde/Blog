<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>
<div class="row">
    <div class="col-md-12">
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
            <label class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-3">
                <select name="subjects_id" class="form-control semester_subject" >
                    <option> Select Subject </option>
                </select>
            </div>

            {!! Form::label('publish_date', 'Publish Date', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('publish_date', null, ["placeholder" => "", "class" => "form-control border-form input-mask-date date-picker","data-date-format" => "yyyy-mm-dd"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'publish_date'])
            </div>


            {!! Form::label('end_date', 'End Date', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('end_date', null, ["placeholder" => "", "class" => "form-control border-form input-mask-date date-picker","data-date-format" => "yyyy-mm-dd"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'end_date'])
            </div>

        </div>
    </div>
    <div class="col-md-12 email">
        <div class="form-group">
            {!! Form::label('title', 'QuestionTitle', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('title', null, ["class" => "form-control border-form"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'title'])
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Detail', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description', null, ["class" => "form-control border-form", "id"=>"summernote", "rows"=>"4"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'description'])
            </div>
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('attach_file', 'Attachment File', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::file('attach_file', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'attach_file'])
        </div>
    </div>

    @if (isset($data['row']))

        <div class="space-4"></div>

        <div class="form-group">
            {!! Form::label('old_file', 'Old File', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8 ace-file-input">
                @if ($data['row']->file)
                    <a href="{{ asset('assignments'.DIRECTORY_SEPARATOR.'questions'.DIRECTORY_SEPARATOR.$data['row']->file) }}" target="_blank">
                        <i class="ace-icon fa fa-download bigger-120"></i> &nbsp;{{ $data['row']->title }}
                    </a>
                @else
                    <p>No File.</p>
                @endif
            </div>
        </div>

    @endif

</div>
<div class="hr hr-24"></div>