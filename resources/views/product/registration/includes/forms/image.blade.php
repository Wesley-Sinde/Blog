<h4 class="header large lighter blue"><i class="ace-icon glyphicon glyphicon-plus"></i>Image</h4>
<div class="form-group">
    {!! Form::label('main_image', 'Product', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::file('main_image', ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'main_image'])
    </div>

    @if (isset($data['row']))
        @if ($data['row']->product_image)
            <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$data['row']->product_image) }}" class="img-responsive" width="100px">
        @endif
    @else
        <img id="" class="img-responsive" alt="Avatar" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" width="100px">
    @endif
</div>
