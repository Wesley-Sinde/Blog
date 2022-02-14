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
                    <h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{ $panel }}</h4>

                    <div class="form-group">
                        {!! Form::label('type', 'Type', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('type', $data['exchange_type'], null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::label('ref_no', 'REF No.', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('ref_no', isset($data['ref_no'])?$data['ref_no']:null, ["placeholder" => "", "class" => "form-control border-form", "autofocus"]) !!}
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

                    </div>

                    <div class="form-group">
                        {!! Form::label('subject', 'Subject', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('subject', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('from', 'From', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('from', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                        </div>

                        {!! Form::label('to', 'To', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('to', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
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