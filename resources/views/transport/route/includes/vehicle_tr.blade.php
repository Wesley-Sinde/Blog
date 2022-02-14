<tr class="option_value">
    <td>
        <input type="hidden" name="vehicles_id[]" value="{{ $vehicle->id }}">
        {{ $vehicle->number.' | '.$vehicle->model }}
    </td>
    <td>
        {{ $vehicle->type }}
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>
    </td>
</tr>
