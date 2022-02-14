<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">{{$data['print_head']}}</span>
</div>
<hr class="hr hr-2">

<table width="100%" class="table-bordered">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Faculty/Class</th>
            <th>Sem./Sec.</th>
            <th>Reg.No.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Discount</th>
            <th>Fine</th>
            <th>PaidAmount</th>
        </tr>
    </thead>
    <tbody>
    @if (isset($data['student']) && $data['student']->count() > 0)
        @php($i=1)
        @foreach($data['student'] as $student)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ ViewHelper::getFacultyTitle($student->faculty) }}</td>
                <td>{{ ViewHelper::getSemesterTitle($student->semester) }}</td>
                <td>{{$student->reg_no}}</td>
                <td>{{$student->first_name.$student->middle_name.$student->last_name}}</td>
                <td class="text-center">{{$student->date}}</td>
                <td class="text-right">{{$student->discount>0?$student->discount:''}}</td>
                <td class="text-right">{{$student->fine > 0 ? $student->fine:''}}</td>
                <td class="text-right">{{$student->paid_amount>0?$student->paid_amount:''}}</td>
            </tr>
            @php($i++)
        @endforeach
    @else
        <tr>
            <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
        <tr style="font-size: 14px; font-weight: bold; background: orangered;color: white;">
            <td colspan="6" class="text-right">Total</td>
            <td  class="text-right">{{ $data['student']->sum('discount') }}</td>
            <td  class="text-right">{{ $data['student']->sum('fine') }}</td>
            <td  class="text-right">{{ $data['student']->sum('paid_amount') }}</td>
        </tr>
    </tfoot>
</table>
