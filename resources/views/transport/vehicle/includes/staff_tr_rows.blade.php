@foreach($staffs as $staff)
    <tr class="option_value">
        <td>
            <input type="hidden" name="staffs_id[]" value="{{ $staff->id }}">
            <input type="hidden" name="action[]" value="update">
            {{ $staff->first_name.' '. $staff->middle_name .' ' . $staff->last_name }}
        </td>
        <td>
            {{ ViewHelper::getDesignationId($staff->designation) }}
        </td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach

