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
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-4">
                                {!! Form::select('category_id', $data['category'], null, ['class' => 'form-control', 'onChange' => 'loadCategory(this);', "required"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'category_id'])
                            </div>
                            <div class="col-sm-6">
                                <select name="sub_category_id" class="form-control subcategory" required >
                                    <option value="0">Select Sub Category....</option>
                                </select>
                                @include('includes.form_fields_validation_message', ['name' => 'subcategory'])
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('code', 'Code', ['class' => 'col-sm-2 control-label',]) !!}
                            <div class="col-sm-2">
                                {!! Form::text('code', null, ["class" => "form-control border-form upper"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'code'])
                            </div>

                            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label',]) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ["class" => "form-control border-form upper"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'name'])
                            </div>


                        </div>

                        <div class="form-group">
                            {!! Form::label('warranty', 'Warranty/Expire', ['class' => 'col-sm-2 control-label',]) !!}
                            <div class="col-sm-2">
                                {!! Form::text('warranty', null, ["class" => "form-control border-form upper"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'warranty'])
                            </div>
                            {{-- {!! Form::label('stock', 'Stock', ['class' => 'col-sm-2 control-label']) !!}
                             <div class="col-sm-2 align-center">
                                 {!! Form::text('stock_from', null, ["class" => "form-control border-form"]) !!}-TO-
                                 {!! Form::text('stock_to', null, ["class" => "form-control border-form"]) !!}
                                 @include('includes.form_fields_validation_message', ['name' => 'stock'])
                             </div>--}}

                            {!! Form::label('sale_price', 'Price', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2 align-center">
                                {!! Form::text('sale_price_from', null, ["class" => "form-control border-form"]) !!}-TO-
                                {!! Form::text('sale_price_to', null, ["class" => "form-control border-form"]) !!}
                                @include('includes.form_fields_validation_message', ['name' => 'sale_price'])
                            </div>

                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-2">
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

