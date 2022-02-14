<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{$panel}}</h4>

<div class="form-group">
    {!! Form::label('name', 'Hostel', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('name', null, ["class" => "form-control border-form", "required", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('address', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('contact_detail', 'Contact Detail', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::textarea('contact_detail', null, ["class" => "form-control border-form", "rows"=>"3"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'contact_detail'])
    </div>
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::textarea('description', null, ["placeholder" => "", "class" => "form-control border-form", "rows"=>"3"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>


<div class="form-group">
    {!! Form::label('warden', 'Warden', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('warden', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'warden'])
    </div>

    {!! Form::label('warden_contact', 'WardenContact', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('warden_contact', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'warden_contact'])
    </div>

</div>

<div class="form-group">
    {!! Form::label('type', 'Type', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('type', ["Boys"=>"Boys","Girls"=>"Girls", "Both"=>"Both"], null, ['class' => 'form-control', "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'type'])
    </div>

    {!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('status', ["all"=>"Select Status","active"=>"Active", "in-active"=>"InActive"], null, ['class' => 'form-control', "required"]) !!}
    </div>
</div>

@if(!isset($data['row']))
    <div class="form-group">
        {!! Form::label('rooms', 'Total Room', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::number('rooms', null, ["class" => "form-control border-form", "required", "min"=>"0"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'rooms'])
        </div>

        {!! Form::label('room_type', 'RoomType', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('room_type', $data['room_type'], null, ['class' => 'form-control', "required"]) !!}
        </div>
    </div>
@endif
