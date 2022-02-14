@php($i=1)
@foreach($exist as $student)
    <tr class="option_value" style="background:lightgrey">
        <td>
            {{ $i }}
        </td>
        <td>
            @if($student->student_image != '')
                <img class="editable img-responsive" alt="" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" width="50px" />
            @else
                <img class="editable img-responsive" alt="" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" width="50px"/>
            @endif
        </td>
        <td>
            <input type="hidden" name="students_id[]" value="{{ $student->students_id }}">
            {{ $student->reg_no }}
        </td>
        <td>
            {{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}
        </td>
        <td>
            @foreach($attendanceStatus as $status)
                <label class="pos-rel">
                    {!! Form::radio($student->students_id, $status->id, ($student->$day==$status->id?true:false), ['class' => 'ace status-'.$status->id,"required"]) !!}
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
