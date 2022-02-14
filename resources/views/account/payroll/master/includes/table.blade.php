<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Staffs List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            Staffs  Record list on table. Filter Staffs using the filter.
        </div>
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
                    <th>Join Date</th>
                    <th>Name of Staff</th>
                    <th>Designation</th>
                    <th>Contact Number</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['staff']) && $data['staff']->count() > 0)
                    @php($i=1)
                    @foreach($data['staff'] as $staff)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $staff->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td>{{ ViewHelper::getStaffById($staff->id)}}</td>
                            <td>{{ \Carbon\Carbon::parse($staff->join_date)->format('Y-m-d')}} </td>
                            <td>{{ $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name }} </td>
                            <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                            <td><div class="label label-info arrowed">{{ $staff->mobile_1 }} </div></td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $staff->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $staff->status == 'active'?"Active":"In Active" }}
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="btn btn-primary btn-minier action-buttons">
                                    <a class="white" href="{{ route('account.salary.payment.view', ['id' => $staff->id]) }}" target="_blank">
                                        <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No Staffs data found. Please Filter Staffs to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


