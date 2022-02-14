<div class="row">
    <div class="col-xs-12">
    @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>S.N.</th>
                        <th>Reg. Num.</th>
                        <th>Name of Student</th>
                        <th>Sem./Sec.</th>
                        <th>Fee Head</th>
                        <th>Due Date</th>
                        <th>Fee Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['fee_master']) && $data['fee_master']->count() > 0)
                        @php($i=1)
                        @foreach($data['fee_master'] as $fee_master)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $fee_master->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td> <a href="{{ route('student.view', ['id' => $fee_master->students_id]) }}">{{ $fee_master->reg_no }}</a></td>
                                <td> <a href="{{ route('student.view', ['id' => $fee_master->students_id]) }}">{{ $fee_master->first_name.' '.$fee_master->middle_name.' '. $fee_master->last_name }}</a></td>
                                <td> {{ ViewHelper::getSemesterById($fee_master->semester)  }}</td>
                                <td>{{ ViewHelper::getFeeHeadById($fee_master->fee_head) }} </td>
                                <td>{{ \Carbon\Carbon::parse($fee_master->fee_due_date)->format('Y-m-d')}} </td>
                                <td class="text-right">{{ $fee_master->fee_amount }} </td>
                                <td>
                                    @if($fee_master->feeCollect()->count() > 0)
                                        <div class="btn btn-primary btn-minier action-buttons">
                                            <a class="white" href="{{ route('account.fees.collection.view', ['id' => $fee_master->students_id]) }}">
                                                <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                            </a>
                                        </div>
                                    @else
                                        <div class="btn btn-primary btn-minier action-buttons">
                                            <a class="white" href="{{ route('account.fees.collection.view', ['id' => $fee_master->students_id]) }}">
                                                <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                            </a>
                                        </div>

                                        <div class="btn btn-success btn-minier action-buttons">
                                            <a class="white" href="{{ route($base_route.'.edit', ['id' => $fee_master->id]) }}">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>
                                        </div>
                                        @ability('super-admin','fees-master-delete')
                                            <div class="btn btn-danger btn-minier action-buttons">
                                                <a class="white bootbox-confirm"  href="{{ route($base_route.'.delete', ['id' => $fee_master->id]) }}">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>
                                        @endability
                                    @endif
                                </td>

                            </tr>
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
                        <td colspan="7" class="text-right">Total</td>
                        <td  class="text-right">{{ $data['fee_master']->sum('fee_amount') }}</td>
                        <td> </td>
                    </tr>
                    </tfoot>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


