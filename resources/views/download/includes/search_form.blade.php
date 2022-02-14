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
                {!! Form::open(['route' => $base_route,'method' => 'GET', 'class' => 'form-horizontal', "enctype" => "multipart/form-data"]) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Faculty/Class</label>
                        <div class="col-sm-5">
                            {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}

                        </div>

                        <label class="col-sm-1 control-label">Sem./Sec.</label>
                        <div class="col-sm-4">
                            <select name="semesters_id" class="form-control semesters_id" onChange="loadSubject(this)" >
                                <option value=""> Select Sem./Sec. </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Course/Subject</label>
                        <div class="col-sm-4">
                            <select name="subjects_id" class="form-control semester_subject" >
                                <option value=""> Select Subject </option>
                            </select>
                        </div>

                        {!! Form::label('title', 'Title', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
                            @include('includes.form_fields_validation_message', ['name' => 'title'])
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('created_date', 'Upload Date', ['class' => 'col-sm-2 control-label']) !!}
                        <div class=" col-sm-4">
                            <div class="input-group ">
                                {!! Form::text('created_date_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-exchange"></i>
                                </span>
                                {!! Form::text('created_date_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label" for="status"> Status </label>

                            <div class="col-sm-5">
                                <div class="control-group">
                                    <div class="radio">
                                        <label>
                                            {!! Form::radio('status', 'active', false, ['class' => 'ace']) !!}
                                            <span class="lbl"> Active</span>
                                        </label>
                                        <label>
                                            {!! Form::radio('status', 'in-active', false, ['class' => 'ace']) !!}
                                            <span class="lbl"> Inactive</span>
                                        </label>
                                    </div>
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
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>