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
                <div class="clearfix">
                    <div class="form-horizontal" id="filterDiv">
                        <div class="form-group">
                            {!! Form::label('reg_no', 'RegNo', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
                            </div>

                            {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'name'])
                            </div>

                            {!! Form::label('email', 'E-mail', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('email', null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'email'])
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('tel', 'Tel', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('tel', null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'tel'])
                            </div>

                            {!! Form::label('mobile', 'Mobile', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('mobile', null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'mobile'])
                            </div>


                            <label class="col-sm-1 control-label">Status</label>
                            <div class="col-sm-3">
                                <select class="form-control border-form" name="status" id="cat_id">
                                    <option value="all"> Select Status </option>
                                    <option value="active" >Active</option>
                                    <option value="in-active" >In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="align-right">
                        <button class="btn btn-info" type="submit" id="filter-btn">
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
