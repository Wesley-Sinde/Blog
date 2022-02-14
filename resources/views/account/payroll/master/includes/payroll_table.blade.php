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
                        <th>Name of Staff</th>
                        <th>Designation</th>
                        <th>Contact</th>
                        <th>Tag Line</th>
                        <th>Payroll Head</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['payroll_master']) && $data['payroll_master']->count() > 0)
                        @php($i=1)
                        @foreach($data['payroll_master'] as $payroll_master)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $payroll_master->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td><a href="{{ route('staff.view', ['id' => $payroll_master->staff_id]) }}">{{ $payroll_master->reg_no }}</a></td>
                                <td><a href="{{ route('staff.view', ['id' => $payroll_master->staff_id]) }}"> {{ $payroll_master->first_name.' '.$payroll_master->middle_name.' '. $payroll_master->last_name }}</a></td>
                                <td>{{ ViewHelper::getDesignationId($payroll_master->designation) }}</td>
                                <td><a href="tel:{{ $payroll_master->mobile_1 }}">{{ $payroll_master->mobile_1 }}</a> </td>
                                <td>{{ $payroll_master->tag_line }} </td>
                                <td>{{ ViewHelper::getPayrollHeadById($payroll_master->payroll_head) }} </td>
                                <td>{{ \Carbon\Carbon::parse($payroll_master->due_date)->format('Y-m-d')}} </td>
                                <td>{{ $payroll_master->amount }} </td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="{{ route($base_route.'.edit', ['id' => $payroll_master->id]) }}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $payroll_master->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </div>
                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="{{ route($base_route.'.edit', ['id' => $payroll_master->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                            <span class="green">
                                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                            </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.delete', ['id' => $payroll_master->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                            <span class="red ">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


