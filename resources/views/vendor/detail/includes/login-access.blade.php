{{--vendor user--}}
<div class="row">
    @if( !$data['vendor_login'])
    {{--create--}}
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Create Customer Login Access</h4>

        {!! Form::open(['route' => 'vendor.user.create', 'method' => 'POST', 'class' => 'form-horizontal',
                       'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
            {!! Form::hidden('role_id', 9) !!}
            {!! Form::hidden('hook_id', $data['vendor']->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('name', $data['vendor']->name, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'name'])
                </div>

                {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::email('email', $data['vendor']->email, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'email'])
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form", "id"=>"pass", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'password'])
                </div>

                {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                    @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
                </div>
            </div>
            <div class="space-4"></div>

            <div class="clearfix form-actions">
                <div class="col-md-12 align-right">
                    <button class="btn" type="reset">
                        <i class="icon-undo bigger-110"></i>
                        Reset
                    </button>

                    <button class="btn btn-info" type="submit">
                        <i class="icon-ok bigger-110"></i>
                        Create Login Access
                    </button>
                </div>
            </div>

            <div class="hr hr-24"></div>
        {!! Form::close() !!}
    </div>
    @else
    {{--edit--}}
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;Edit Customer Login Access</h4>
        <a href="{{ route('vendor.user.active', ['id' => $data['vendor_login']->id]) }}" title="Active" class="btn-success btn-sm"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Un-Lock User</a>
        <a href="{{ route('vendor.user.in-active', ['id' => $data['vendor_login']->id]) }}" title="In-Active" class="btn-warning btn-sm"><i class="fa fa-lock" aria-hidden="true"></i> Lock User</a>
        <a href="{{ route('vendor.user.delete', ['id' => $data['vendor_login']->id]) }}" title="Delete" class="btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete User</a>
        <div class="hr hr-24"></div>

        {!! Form::model($data['vendor_login'], ['route' => ['vendor.user.update', $data['vendor_login']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                  'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        {!! Form::hidden('id', $data['vendor_login']->id) !!}
        {!! Form::hidden('role_id', 5) !!}
        {!! Form::hidden('hook_id', $data['vendor']->id) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
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
                {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form", "id"=>"pass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'password'])
            </div>

            {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
                @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
            </div>
        </div>
        <div class="col-sm-4">
            <label data-toggle="dropdown" class="label {{ $data['vendor_login']->status == 'active'?"label-success":"label-danger" }}" >
                {{ $data['vendor_login']->status == 'active'?"Active User":"User Locked" }}
            </label>
        </div>
        <div class="clearfix hr-8"></div>

        <div class="clearfix form-actions">
            <div class="col-md-12 align-right">
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                </button>

                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Update Detail
                </button>
            </div>
        </div>


        <div class="hr hr-24"></div>
        {!! Form::close() !!}
    </div>
    @endif

</div>
