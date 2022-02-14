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
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    {{--<th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>--}}
                    <th>S.N.</th>
                    <th>Reg. Num.</th>
                    <th>Name of Staff</th>
                    <th>Designation</th>
                    <th>Total</th>
                    <th>Balance</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['staff']) && $data['staff']->count() > 0)
                    @php($i=1)
                    @foreach($data['staff'] as $staff)
                        @php($balance = ($staff->payrollMaster()->sum('amount')+$staff->paySalary()->sum('allowance'))-($staff->paySalary()->sum('paid_amount'))
                        - $staff->paySalary()->sum('fine'))
                        @if($balance > 0)
                        <tr>
                            {{--<td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $staff->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>--}}
                            <td>{{ $i }}</td>
                            <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}">{{ $staff->reg_no }}</a></td>
                            <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}"> {{ $staff->first_name.' '.$staff->middle_name.' '. $staff->last_name }}</a></td>
                            <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                            <td>
                                {{ $staff->payrollMaster()->sum('amount') }}
                            </td>
                            <td>
                                {{ $balance }}
                            </td>
                            <td>
                                <div class="btn btn-primary btn-minier action-buttons ">
                                    <a class="white" href="{{ route('account.salary.payment.view', ['id' => $staff->id]) }}">
                                        <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
                <tfoot>
                <tr style="font-size: 14px; background: orangered;color: white;">
                    <td colspan="4" class="text-right">Total</td>
                    <td  class="text-right">{{ $data['staff']->sum('amount') }}</td>
                    <td  class="text-right">
                        {{ $data['staff']->sum('balance') }}
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


