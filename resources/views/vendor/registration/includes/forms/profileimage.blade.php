<h4 class="header large lighter blue"><i class="ace-icon glyphicon glyphicon-plus"></i>Profile Pictures</h4>
<div class="form-group">
    {!! Form::label('vendor_main_image', 'Customer', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::file('vendor_main_image', ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'vendor_main_image'])
    </div>

    @if (isset($data['row']))
        @if ($data['row']->vendor_image)
            <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'vendorProfile'.DIRECTORY_SEPARATOR.$data['row']->vendor_image) }}" class="img-responsive" width="100px">
        @endif
    @else
        <img id="" class="img-responsive" alt="Avatar" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" width="100px">
    @endif
</div>
