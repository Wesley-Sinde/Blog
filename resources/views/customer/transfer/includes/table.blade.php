<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        {!! Form::open(['route' => $base_route.'.transfering', 'id' => 'bulk_action_form']) !!}
        <div class="clearfix">
            <div>
                    <label class="col-sm-1 control-label">Faculty</label>
                    <div class="col-sm-3">
                        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);','id'=>'transfer-faculty', "required"]) !!}

                    </div>

                    <label class="col-sm-1 control-label">Semester</label>
                    <div class="col-sm-2">
                        <select name="semester_select" class="form-control semester_select" id='transfer-semester'  required>
                            <option> Select Semester </option>
                        </select>
                    </div>
                <label class="col-sm-1 control-label">Status</label>
                <div class="col-sm-2">
                    {!! Form::select('student_status', $data['student_status'], null, ['class' => 'form-control','id'=>'transfer-status' , "required"]) !!}

                </div>
                <button type="submit" class="btn btn-success btn-sm" id="student-transfer-btn"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Transfer</button>
                <button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Reset</button>
            </div>
            <hr class="hr-8">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter list using search box as your Wish.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
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
                        <th>Faculty</th>
                        <th>Semester</th>
                        <th>Reg. Date</th>
                        <th>Reg. Number</th>
                        <th>Name of Student</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['student']) && $data['student']->count() > 0)
                        @php($i=1)
                        @foreach($data['student'] as $student)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $student->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i }}</td>
                                <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                                <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->reg_date)->format('Y-m-d')}}
                                </td>
                                <td><a href="{{ route($base_route.'.view', ['id' => $student->id]) }}">{{ $student->reg_no }}</a></td>
                                <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>

                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No {{ $panel }} data found.</td>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


