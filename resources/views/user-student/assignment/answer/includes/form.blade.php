<h4 class="header large lighter blue"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Give Your Answer</h4>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 email">
            <div class="form-group">
                {!! Form::label('answer_text', 'Answer Text', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('answer_text', null, ["class" => "form-control border-form", "id"=>"summernote", "rows"=>"4"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'answer_text'])
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
                        <a href="{{ asset('assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR.$data['row']->file) }}" target="_blank">
                            <i class="ace-icon fa fa-download bigger-120"></i> &nbsp;{{ $data['row']->file }}
                        </a>
                    @else
                        <p>No File.</p>
                    @endif
                </div>
            </div>

        @endif
    </div>

</div>
<div class="hr hr-24"></div>