@foreach($subjects as $subject)
    <tr class="option_value">
        <td>
            {{ $subject->code }}
        </td>
        <td>
            <input type="hidden" name="sem_subject_id[]" value="{{ $subject->id }}">
            <input type="hidden" name="action[]" value="update">
            <p>{{ $subject->title }}</p>
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

