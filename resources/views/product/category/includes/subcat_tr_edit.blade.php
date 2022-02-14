<tr class="option_value">
    <td>
        {!! Form::hidden('catID[]', $sub_category->id, ['class' => 'form-control', 'required']) !!}
        {!! Form::text('name[]', $sub_category->title, ['class' => 'form-control upper', 'required']) !!}
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