<div class="form-group">
    {!! Form::label('reg_no', 'Reg. No.', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('document_file', 'Select File', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::file('document_file', null, ["placeholder" => "", "class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'document_file'])
    </div>
</div>

@if (isset($data['row']))

    <div class="space-4"></div>

    <div class="form-group">
        {!! Form::label('old_file', 'Old File', ['class' => 'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            @if ($data['row']->file)
                <a href="{{ asset($folder_name.DIRECTORY_SEPARATOR.'customer'.DIRECTORY_SEPARATOR.ViewHelper::getCustomerById( $data['row']->member_id ).DIRECTORY_SEPARATOR.$data['row']->file) }}" target="_blank">
                    <i class="ace-icon fa fa-download bigger-120"></i> &nbsp;{{ $data['row']->title }}
                </a>
            @else
                <p>No File.</p>
            @endif
        </div>
    </div>

@endif

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description', null, ["placeholder" => "", "class" => "form-control border-form", "rows"=>"2"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>

