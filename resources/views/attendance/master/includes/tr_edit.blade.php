<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Edit Form</h4>
{!! Form::open(['route' => $base_route.'.store', 'id' => 'bulk_action_form']) !!}

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Year</th>
            <th>Month</th>
            <th>Day in Month</th>
            <th>Holiday</th>
            <th>Open Day</th>
        </tr>
        </thead>

        <tbody id="fee_wrapper">

        <tr class="option_value">

            <td>
                {!! Form::hidden('year', null, ['class' => 'form-control', 'disabled']) !!}
                {!! Form::text('year_title', null, ['class' => 'form-control', 'disabled']) !!}
            </td>
            <td >
                {!! Form::hidden('month', null, ['class' => 'form-control', 'disabled']) !!}
                {!! Form::text('month_title', null, ['class' => 'form-control', 'disabled']) !!}
            </td>
            <td >
                {!! Form::text('day_in_month', null, ['class' => 'form-control']) !!}
            </td>
            <td >
                {!! Form::text('holiday', null, ['class' => 'form-control']) !!}
            </td>
            <td >
                {!! Form::text('open', null, ["class" => "col-xs-10 col-sm-11", "required"]) !!}
            </td>

        </tr>

        </tbody>

    </table>
    <div class="clearfix form-actions align-right">
        <div class="col-md-12">
            <button class="btn btn-info" type="submit">
                <i class="fa fa-save bigger-110"></i>
                Update {{$panel}}
            </button>
        </div>
    </div>
</div>


