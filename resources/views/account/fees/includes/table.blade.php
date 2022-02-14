<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th >S.N.</th>
                            <th>Reg. Num.</th>
                            <th>Name</th>
                            <th>Sem/Sec</th>
                            <th>Head</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Fi.</th>
                            <th>Dis.</th>
                            <th>Method</th>
                            <th>User</th>
                            <th>Note</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['feesCollection']) && $data['feesCollection']->count() > 0)
                        @php($i=1)
                        @foreach($data['feesCollection'] as $feesCollection)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> <a href="{{ route('student.view', ['id' => $feesCollection->students_id]) }}">{{ $feesCollection->reg_no }}</a></td>
                                <td> <a href="{{ route('student.view', ['id' => $feesCollection->students_id]) }}">{{ $feesCollection->first_name.' '.$feesCollection->middle_name.' '. $feesCollection->last_name }}</a></td>
                                <td> {{  ViewHelper::getSemesterTitle( $feesCollection->semester ) }}</td>
                                <td>{{ ViewHelper::getFeeHeadById($feesCollection->fee_head) }}</td>
                                <td>{{ \Carbon\Carbon::parse($feesCollection->date)->format('Y-m-d')}} </td>
                                <td class="text-right">{{ $feesCollection->paid_amount }}</td>
                                <td class="text-right">{{ $feesCollection->fine }}</td>
                                <td class="text-right">{{ $feesCollection->discount }}</td>
                                <td>{{ $feesCollection->payment_mode }}</td>
                                <td> {{  ViewHelper::getUserNameId( $feesCollection->created_by ) }}</td>
                                <td>{{ $feesCollection->note }}</td>
                                <td>
                                    <div class="btn btn-primary btn-minier action-buttons">
                                        <a class="white" href="{{ route('account.fees.collection.view', ['id' => $feesCollection->students_id]) }}">
                                            <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                        </a>
                                    </div>
                                </td>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                        <tr style="font-size: 14px; background: orangered;color: white;">
                            <td colspan="6" class="text-right">Total</td>
                            <td  class="text-right">{{ $data['feesCollection']->sum('paid_amount') }}</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tfoot>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


