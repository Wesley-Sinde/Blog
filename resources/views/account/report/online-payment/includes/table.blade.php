<hr class="hr hr-2">
<div class="row align-center">
    <span class="receipt-copy">Online Payments List</span>
</div>
<hr class="hr hr-2">

<table width="100%" class="table-bordered">
    <thead>
    <tr>
        <th >S.N.</th>
        <th>Faculty/Class</th>
        <th>Sem./Sec.</th>
        <th>Reg.Num.</th>
        <th>Name</th>
        <th>Date</th>
        <th>Gateway</th>
        <th>Amount</th>
        <th>PaidBy</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($data['student']) && $data['student']->count() > 0)
        @php($i=1)
        @foreach($data['student'] as $student)
            <tr>
                <td>{{ $i }}</td>
                <td> {{  ViewHelper::getFacultyTitle( $student->faculty )}}</td>
                <td> {{ ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                <td> {{ $student->reg_no }}</td>
                <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($student->date)->format('Y-m-d')}} </td>
                <td>{{ $student->payment_gateway }}</td>
                <td class="text-right">{{ $student->amount }}</td>
                <td class="text-center">{{ ViewHelper::getUserNameId($student->paid_by) }}</td>
                <td class="text-center">
                    {{$student->payment_status == 0?'Not Verify':'Verified'}}
                </td>
            @php($i++)
        @endforeach
    @else
        <tr>
            <td colspan="10">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
        <tr style="font-size: 14px; font-weight: bold; background: orangered;color: white;">
            <td colspan="7" class="text-right">Total</td>
            <td  class="text-right">{{ $data['student']->sum('amount') }}</td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
