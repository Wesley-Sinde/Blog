<div id="accordion" class="accordion-style1 panel-group hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter {{$panel}}
                        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
                    </h3>
                </a>
            </h4>
        </div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                {{--{!! Form::open(['route' => $base_route,'method' => 'GET', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}--}}
                <div class="clearfix form-horizontal">
                    <div class="form-group">
                        {!! Form::label('purpose', 'Purpose', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::select('purpose', $data['purpose'], null, ['class' => 'form-control']) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'purpose'])
                        </div>

                        {!! Form::label('date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
                        <div class=" col-sm-3">
                            <div class="input-group">
                                {!! Form::text('start_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-exchange"></i>
                                </span>
                                {!! Form::text('end_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                            </div>
                        </div>

                        {!! Form::label('in_time', 'In Time', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-1">
                            {!! Form::time('in_time', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'in_time'])
                        </div>

                        {!! Form::label('out_time', 'Out Time', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-1">
                            {!! Form::time('out_time', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'out_time'])
                        </div>

                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'name'])
                        </div>

                        {!! Form::label('phone', 'Phone', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('phone', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'phone'])
                        </div>

                        {!! Form::label('email', 'Email', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::email('email', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'email'])
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('id_doc', 'ID Doc.', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('id_doc', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'id_doc'])
                        </div>

                        {!! Form::label('id_num', 'ID Number', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('id_num', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'id_num'])
                        </div>

                        {!! Form::label('token', 'Token/Pass', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('token', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'token'])
                        </div>

                        {!! Form::label('status', 'Status', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-2">
                            <select class="form-control border-form" name="status">
                                <option value="all"> Select Status </option>
                                <option value="active" >Visiting</option>
                                <option value="in-active" >Complete</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="align-right">
                        <button class="btn btn-info" purpose="submit" id="filter-btn">
                            <i class="fa fa-filter bigger-110"></i>
                            Filter
                        </button>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}

            </div>
        </div>
    </div>
</div>