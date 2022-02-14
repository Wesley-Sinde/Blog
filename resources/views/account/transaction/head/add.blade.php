{{--<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search/Create {{ $panel }}</h4>--}}
    <!-- PAGE CONTENT BEGINS -->
<div class="">
    <div class="easy-link-menu align-right">
        <a class="btn-primary btn-sm" href="#" id="create_ledger_btn"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New Ledger</a>
        <a class="btn-primary btn-sm" href="#" id="search_ledger_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
    </div>
</div>
<hr class="hr-6">

<div id="create_ledger_form">
    {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        @include($view_path.'.includes.form')
        <div class="clearfix form-actions align-right">
            <div class="col-md-12 align-right">
                <button class="btn btn-info" type="submit">
                    <i class=" fa fa-save bigger-110"></i>
                    Create
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <div class="hr hr-18 dotted hr-double"></div>
</div>

<div id="search_ledger_form">
    {!! Form::open(['route' => $base_route, 'method' => 'GET', 'class' => 'form-horizontal',
   'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
    @include($view_path.'.includes.search-form')
    <div class="clearfix form-actions align-right">
        <div class="col-md-12 align-right">
            <button class="btn btn-info" type="submit" id="filter-btn">
                <i class="fa fa-filter bigger-110"></i>
                Filter
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="hr hr-18 dotted hr-double"></div>
</div>