@foreach($months as $key => $month)
    <tr class="option_value">
        <td width="5%">
            <div class="btn-group">
                    <span class="btn btn-xs btn-primary" >
                        <i class="fa fa-arrows" aria-hidden="true"></i>
                    </span>
            </div>
        </td>
        <td width="45%">
           {{--{!! Form::select('month[]', $month[$key], null, ['class' => 'form-control', 'required']) !!}--}}
            {!! Form::hidden('month[]', $key, ["class" => "col-xs-10 col-sm-11", "required","disable", "readonly"]) !!}
            {!! Form::text('month_display[]', $month, ["class" => "col-xs-10 col-sm-11", "required","disable", "readonly"]) !!}
        </td>
        <td width="15%">
            {!! Form::text('day_in_month[]', null, ["class" => "col-xs-10 col-sm-11", "required"]) !!}
        </td>
        <td width="15%">
            {!! Form::text('holiday[]', null, [ "class" => "col-xs-10 col-sm-11" , "required"]) !!}
        </td>
        <td width="15%">
            {!! Form::text('open[]', null, ["class" => "col-xs-10 col-sm-11" , "required"]) !!}
        </td>
        <td width="5%">
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </button>
            </div>

        </td>
    </tr>
@endforeach