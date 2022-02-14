<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">Fee Balance Statement</span>
</div>
<hr class="hr hr-2">

<table width="100%" class="table-bordered">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Faculty/Class</th>
            <th>Sem./Sec.</th>
            <th>Reg. Num.</th>
            <th>Name of Student</th>
            <th>Guardian</th>
            <th>ContactNo.</th>
            {{--<th>Total Fee</th>--}}
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
    @if (isset($data['student']) && $data['student']->count() > 0)
        @php($i=1)
        @foreach($data['student'] as $student)
            <tr>
                <td>{{ $i }}</td>
                <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                <td>{{ $student->reg_no }}</td>
                <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                <td> {{ $student->guardian_first_name.' '.$student->guardian_middle_name.' '. $student->guardian_last_name }}</td>
                <td> {{ $student->guardian_mobile_1 }}</td>
               {{-- <td>
                    {{ $student->fee_amount }}
                </td>--}}
                <td class="text-right">
                    {{ $student->balance }}
                </td>
            </tr>
            @php($i++)
        @endforeach
    @else
        <tr>
            <td colspan="8">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
        <tr style="font-size: 14px;font-weight: bold; background: orangered;color: white;">
            <td colspan="7" class="text-right">Total</td>
            {{--<td  class="text-right">{{ $data['student']->sum('fee_amount') }}</td>--}}
            <td  class="text-right"> {{ $data['student']->sum('balance') }} </td>
        </tr>
    </tfoot>
</table>
