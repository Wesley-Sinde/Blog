@php($i=1)
@foreach($staffs as $staff)
    <tr class="option_value">
        <td>
            {{$i}}
        </td>
        <td>
            @if($staff->staff_image != '')
                <img class="editable img-responsive" alt="" src="{{ asset('images'.DIRECTORY_SEPARATOR.'staffProfile'.DIRECTORY_SEPARATOR.$staff->staff_image) }}" width="50px" />
            @else
                <img class="editable img-responsive" alt="" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" width="50px"/>
            @endif
        </td>
        <td>
            <input type="hidden" name="staffs_id[]" value="{{ $staff->id }}">
            {{ $staff->reg_no }}
        </td>
        <td>
            {{ $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name }}
        </td>
        <td>
            @foreach($attendanceStatus as $status)
                <label class="pos-rel">
                    {!! Form::radio($staff->id, $status->id, false, ['class' => 'ace status-'.$status->id,"required"]) !!}
                    <span class="lbl"></span> <span class="{{ $status->display_class }} btn-sm">{{$status->title}}</span>
                </label>
            @endforeach
        </td>
        <td>
            <div class="btn-group">
                <label class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </label>
            </div>
        </td>
    </tr>
    @php($i++)
 @endforeach
