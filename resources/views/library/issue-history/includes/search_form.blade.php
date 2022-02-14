<div id="accordion" class="accordion-style1 panel-group hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                    <h3 class="header large lighter blue">
                        <i class="bigger-110 ace-icon fa fa-angle-double-right" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa-angle-double-right"></i>
                        Filter Book Issue History
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
                            {!! Form::label('book', 'Book', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('book', $data['books'], null, ['class' => 'form-control chosen-select']) !!}
                            </div>

                            {!! Form::label('category', 'Category', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::select('category', $data['categories'], null, ['class' => 'form-control chosen-select']) !!}
                            </div>

                            <label class="col-sm-1 control-label">Status</label>
                            <div class="col-sm-2">
                                <select class="form-control border-form" name="status">
                                    <option value="all"> Select Status </option>
                                    <option value="issue" >Issued</option>
                                    <option value="return" >Return</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('issued', 'Issued', ['class' => 'col-sm-1 control-label']) !!}
                            <div class=" col-sm-3">
                                <div class="input-group ">
                                    {!! Form::text('issued_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                    <span class="input-group-addon">
                                        <i class="fa fa-exchange"></i>
                                    </span>
                                    {!! Form::text('issued_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                </div>
                            </div>

                            {!! Form::label('due', 'Due', ['class' => 'col-sm-1 control-label']) !!}
                            <div class=" col-sm-3">
                                <div class="input-group ">
                                    {!! Form::text('due_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                    <span class="input-group-addon">
                                        <i class="fa fa-exchange"></i>
                                    </span>
                                    {!! Form::text('due_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                </div>
                            </div>

                            {!! Form::label('return_on', 'Return', ['class' => 'col-sm-1 control-label']) !!}
                            <div class=" col-sm-3">
                                <div class="input-group ">
                                    {!! Form::text('return_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                    <span class="input-group-addon">
                                        <i class="fa fa-exchange"></i>
                                    </span>
                                    {!! Form::text('return_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                </div>
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