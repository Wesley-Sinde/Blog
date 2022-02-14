<h4 class="header large lighter blue"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;{{ $panel }} Add Form</h4>

{!! Form::open(['route' => $base_route.'.store', 'id' => 'bulk_action_form']) !!}
<div class="form-group">
    <div class="col-sm-4"></div>
    {!! Form::label('year', 'Year', ['class' => 'col-sm-1 control-label input-mask-date']) !!}
    <div class="col-sm-2">
        {!! Form::select('year', $data['year'], null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-sm-5"></div>
</div>

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th></th>
            <th>Month</th>
            <th>Day in Month</th>
            <th>Holiday</th>
            <th>Open Day</th>
            <th>
                <button type="button" class="btn btn-xs btn-primary pull-right" id="month-tr-html">
                    <i class="fa fa-plus" aria-hidden="true"></i> Get Active Months List
                </button>
            </th>
        </tr>
        </thead>

        <tbody id="month_wrapper">



        </tbody>

    </table>
</div>


<div class="clearfix form-actions">
    <div class="col-md-12 align-right">
        <button class="btn" type="reset">
            <i class="fa fa-undo bigger-110"></i>
            Reset
        </button>
        &nbsp; &nbsp; &nbsp;
        <button class="btn btn-success" type="submit" id="filter-btn">
            <i class="fa fa-save bigger-110"></i>
            Add {{$panel}}
        </button>
    </div>
</div>
<div class="hr-double hr-18"></div>
