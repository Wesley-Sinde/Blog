<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Edit Form</h4>
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <strong>Warning!</strong>
        Please be patient when adding fees because it effects on selected students and after that you will change manually.
</div>
{!! Form::open(['route' => $base_route.'.store', 'id' => 'bulk_action_form']) !!}
<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Reg No</th>
                <th>Student Name</th>
                <th>Sem./Sec.</th>
                <th>Due Date</th>
                <th>Fee Head</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody id="fee_wrapper">
            <tr class="option_value">
                <td>
                    {!! Form::text('reg_no', null, ['class' => 'form-control', 'disabled']) !!}
                </td>
                <td >
                    {!! Form::text('student_name', null, ['class' => 'form-control', 'disabled']) !!}
                </td>
                <td >
                    {!! Form::text('semester', null, ['class' => 'form-control', 'disabled']) !!}
                </td>
                <td >
                    {!! Form::text('fee_due_date', null, ["placeholder" => "YYYY-MM-DD", "class" => "col-xs-10 col-sm-11 input-mask-date date-picker", "required"]) !!}
                </td>
                <td >
                {!! Form::text('fee_head', null, ['class' => 'form-control', 'disabled']) !!}
                </td>
                <td>
                    {!! Form::text('fee_amount', null, ["placeholder" => "", "class" => "col-xs-10 col-sm-11" , "required"]) !!}
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


