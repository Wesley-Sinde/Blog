<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Add Form</h4>
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <strong>Warning!</strong>
    Please be patient when adding fees because it effects on selected students and after that you will change manually.
    <br>
</div>
{!! Form::open(['route' => $base_route.'.store', 'id' => 'fee_add_form']) !!}

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Due Date</th>
            <th>Fee Head</th>
            <th>Amount</th>
            <th>
                <button type="button" class="btn btn-xs btn-primary pull-right" id="load-fee-html">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Fee Row
                </button>
            </th>
        </tr>
        </thead>

        <tbody id="fee_wrapper">
        <tr class="option_value">
            <td width="5%">
                <div class="btn-group">
                <span class="btn btn-xs btn-primary" >
                    <i class="fa fa-arrows" aria-hidden="true"></i>
                </span>
                </div>
            </td>
            <td width="25%">
                {!! Form::text('fee_due_date[]', null, ["placeholder" => "YYYY-MM-DD", "class" => "col-xs-10 col-sm-11 input-mask-date date-picker", "required"]) !!}
            </td>
            <td width="40%">
                {!! Form::select('fee_head[]', $data['feeHead'], null, ['class' => 'form-control chosen-select feeHead', 'required','onChange' => 'setAmount(this);'], $data['fee_head_attributes']) !!}
            </td>
            <td width="25%">
                {!! Form::text('fee_amount[]', null, ["id" => $data['randId'], "class" => "col-xs-10 col-sm-11 feeAmount" , "required"]) !!}
            </td>
            <td width="10%">
                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </button>
                </div>

            </td>
        </tr>

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

