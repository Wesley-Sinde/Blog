<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Add Form</h4>
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <strong>Warning!</strong>
    Please be patient when adding fees because it effects on selected students and after that you will change manually.
    <br>
</div>
{!! Form::open(['route' => $base_route.'.student-guardian.send', 'id' => 'fee_add_form']) !!}

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Fee Head</th>
            <th>Due Date</th>
            <th>Amount</th>
            <th>
                <button type="button" class="btn btn-xs btn-primary pull-right" id="load-fee-html">
                    <i class="fa fa-plus" aria-hidden="true"></i> Insert Rows
                </button>
            </th>
        </tr>
        </thead>

        <tbody id="fee_wrapper">

            @if (isset($data['row']))

                @foreach($data['product_attribute_array'] as $attribute)

                    @include($view_path.'.includes.fee_tr_edit', ['attribute_groups' => $data['attribute_groups'],'attribute' => $attribute])

                @endforeach

            @endif

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
        <button class="btn btn-success" type="submit" id="fee-add-btn">
            <i class="fa fa-save bigger-110"></i>
            Add Fee
        </button>
    </div>
</div>
<div class="hr-double hr-18"></div>
