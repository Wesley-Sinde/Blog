<tr class="option_value">
    <td>
        {!! Form::hidden('gsID[]', $grade_scale->id, ['class' => 'form-control', 'required']) !!}
        {!! Form::text('name[]', $grade_scale->name, ['class' => 'form-control upper', 'required']) !!}
    </td>
    <td>
        {!! Form::number('percentage_from[]', $grade_scale->percentage_from, ['class' => 'form-control', 'step' => 'any', 'required']) !!}
    </td>
    <td>
        {!! Form::number('percentage_to[]', $grade_scale->percentage_to, ['class' => 'form-control', 'step' => 'any',  'required']) !!}
    </td>
    <td>
        {!! Form::text('grade_point[]', $grade_scale->grade_point, ['class' => 'form-control']) !!}
    </td>
    <td>
        {!! Form::textarea('description[]', $grade_scale->description, ['class' => 'form-control','rows'=>'1']) !!}
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>

    </td>
</tr>

<script>
    $(document).ready(function () {
        /*Change Field Value on Capital Letter When Keyup*/
        $(function () {
            $('.upper').keyup(function () {
                this.value = this.value.toUpperCase();
            });
        });
        /*end capital function*/
    });
</script>