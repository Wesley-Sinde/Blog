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
                    <th>S.N.</th>
                    <th>Reg. Num.</th>
                    <th>Join Date</th>
                    <th>Staff Name</th>
                    <th>Designation</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>BloodGroup</th>
                    <th>Nationality</th>
                    <th>Mother Tongueue</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Temp. Address</th>
                    <th>Temp. State</th>
                    <th>Temp. Country</th>
                    <th>Home Phone</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Experience Info</th>
                    <th>Other Info</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($data['staff']) && $data['staff']->count() > 0)
                        @php($i=1)
                        @foreach($data['staff'] as $staff)
                            <tr>
                                {{--'id','reg_no', 'join_date',  'first_name',  'middle_name', 'last_name','designation',
           'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue',
            'address', 'state', 'country',
           'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
           'experience', 'experience_info', 'other_info','status'--}}
                                <td>{{ $i }}</td>
                                <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}">{{ $staff->reg_no }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($staff->join_date)->format('Y-m-d')}} </td>
                                <td><a href="{{ route('staff.view', ['id' => $staff->id]) }}"> {{ $staff->first_name.' '.$staff->middle_name.' '. $staff->last_name }}</a></td>
                                <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                                <td>{{ $staff->father_name }}</td>
                                <td>{{ $staff->mother_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($staff->date_of_birth)->format('Y-m-d')}} </td>
                                <td>{{ $staff->gender }}</td>
                                <td>{{ $staff->blood_group }}</td>
                                <td>{{ $staff->nationality }}</td>
                                <td>{{ $staff->mother_tongue }}</td>
                                <td>{{ $staff->address }}</td>
                                <td>{{ $staff->state }}</td>
                                <td>{{ $staff->country }}</td>
                                <td>{{ $staff->temp_address }}</td>
                                <td>{{ $staff->temp_state }}</td>
                                <td>{{ $staff->temp_country }}</td>
                                <td>{{ $staff->home_phone }}</td>
                                <td>
                                    @if(isset($staff->mobile_2))
                                    {{ $staff->mobile_1.', '.$staff->mobile_2}}
                                        @else
                                        {{ $staff->mobile_1}}
                                    @endif
                                </td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->qualification }}</td>
                                <td>{{ $staff->experience }}</td>
                                <td>{{ $staff->experience_info }}</td>
                                <td>{{ $staff->other_info }}</td>
                                <td>{{ $staff->status=="active"?"Active":"In-Active" }}</td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>