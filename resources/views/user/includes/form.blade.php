<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form","autofocus", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::email('email', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form","autofocus","id"=>"pass", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'password'])
    </div>

    {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('contact_number', 'ContactNumber', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('contact_number', null, ["placeholder" => "", "class" => "form-control border-form","autofocus", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'contact_number'])
    </div>

    {!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('address', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>
</div>
@if(isset($data['roles']) && $data['roles']->count() > 0)
    <div class="form-group">
        {!! Form::label('Access Level', 'User Access Level', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            <div class="checkbox">
                @foreach($data['roles'] as $role)
                    <label>
                        @if (!isset($data['row']))
                            {!! Form::radio('role[]', $role->id, false, ['class' => 'ace']) !!}
                        @else
                            {!! Form::radio('role[]', $role->id, array_key_exists($role->id, $data['active_roles']), ['class' => 'ace']) !!}
                        @endif
                        <span class="lbl"> {{ $role->display_name }} </span>
                    </label>
                @endforeach
            </div>
            <div class="control-group">
            </div>
        </div>
    </div>
@endif

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('main_image', 'Profile Image', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::file('main_image') !!}
        @include('includes.form_fields_validation_message', ['name' => 'main_image'])
    </div>
</div>
<div class="space-4"></div>

@if (isset($data['row']))
    <div class="form-group">
        <label class="col-sm-2 control-label">Existing Image</label>
        <div class="col-sm-10">
            @if ($data['row']->profile_image)
                <img src="{{ asset('images/user/'.$data['row']->profile_image) }}" width="200px" >
            @else
                <p>No image.</p>
            @endif

        </div>
    </div>
@endif
<div class="space-4"></div>
