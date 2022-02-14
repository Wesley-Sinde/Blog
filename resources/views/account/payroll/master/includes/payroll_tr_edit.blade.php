<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Edit Form</h4>

{!! Form::open(['route' => $base_route.'.store', 'id' => 'bulk_action_form']) !!}

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Tag Line</th>
            <th>Payroll Head</th>
            <th>Due Date</th>
            <th>Amount</th>
        </tr>
        </thead>

        <tbody id="fee_wrapper">

        <tr class="option_value">

            <td width="35%">
                {!! Form::text('tag_line', null, ['class' => 'form-control', 'required']) !!}
            </td>
            <td width="30%">
                {!! Form::select('payroll_head', $data['payroll_heads'], null, ['class' => 'form-control', 'required']) !!}
            </td>
            <td width="15%">
                {!! Form::text('due_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "col-xs-10 col-sm-11 input-mask-date date-picker", "required"]) !!}
            </td>
            <td width="20%">
                {!! Form::text('amount', null, ["placeholder" => "", "class" => "col-xs-10 col-sm-11" , "required"]) !!}
            </td>

        </tr>

        </tbody>

    </table>
    <div class="clearfix form-actions align-right">
        <div class="col-md-12">
            <button class="btn btn-info" type="submit">
                <i class="fa fa-save bigger-110"></i>
                Update
            </button>
        </div>
    </div>
</div>


