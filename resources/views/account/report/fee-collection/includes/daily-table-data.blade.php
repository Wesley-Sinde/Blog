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
            <th>Method</th>
            <th>Head</th>
            <th>Discount</th>
            <th>Fine</th>
            <th>Paid</th>
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
                    <td colspan="6"></td>
                </tr>
                @if(isset($student->paids) && $student->paids->count() > 0)
                    @foreach($student->paids as $paid)
                        <tr>
                            <td colspan="5"></td>
                            <td class="text-center">{{\Carbon\Carbon::parse($paid->date)->format('Y-m-d')}}</td>
                            <td>{{$paid->payment_mode}}</td>
                            <td>{{ ViewHelper::getFeeHeadById($paid->fee_masters_id) }}</td>
                            <td class="text-right">{{$paid->discount>0?$paid->discount:''}}</td>
                            <td class="text-right">{{$paid->fine>0?$paid->fine:''}}</td>
                            <td class="text-right">{{$paid->paid_amount>0?$paid->paid_amount:''}}</td>
                        </tr>

                    @endforeach
                    @if($data['student']->count() > 1)
                    <tr style="font-size: 14px; font-weight: bold; background: #438eb9;color: white;">
                        <td colspan="8" class="text-right">Total</td>
                        <td class="text-right">{{$student->total_discount>0?$student->total_discount:''}}</td>
                        <td class="text-right">{{$student->total_fine > 0 ? $student->total_fine:''}}</td>
                        <td class="text-right">{{$student->total_paid_amount>0?$student->total_paid_amount:''}}</td>
                    </tr>
                    @endif
                @endif
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
            <td colspan="8" class="text-right"> Grand Total</td>
            <td  class="text-right">{{ $data['student']->sum('total_discount') }}</td>
            <td  class="text-right">{{ $data['student']->sum('total_fine') }}</td>
            <td  class="text-right">{{ $data['student']->sum('total_paid_amount') }}</td>
        </tr>
        </tfoot>
    </table>

    <div class="space-8"></div>
