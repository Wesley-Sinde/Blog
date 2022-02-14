<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        {!! Form::open(['route' => 'print-out.general-certificate', 'id' => 'bulk_action_form']) !!}
        <div class="clearfix">
            <div>
                    <label class="col-sm-2 control-label">Certificate Template</label>
                    <div class="col-sm-6">
                        {!! Form::select('certificate', $data['certificates'], null, ['class' => 'form-control', 'id'=>'certificate-template', "required"]) !!}

                    </div>
                <button type="submit" class="btn btn-success btn-sm" id="certificate-generate-btn"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Print Certificates</button>
            </div>
            <hr class="hr-8">
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
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>S.N.</th>
                        <th>Faculty/Class</th>
                        <th>Sem./Sec.</th>
                        <th>Reg. Date</th>
                        <th>Reg. Num.</th>
                        <th>Name of Student</th>
                        <th></th>
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
                                <td><a href="{{ route('student.view', ['id' => $student->id]) }}">{{ $student->reg_no }}</a></td>
                                <td> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                                <td>
                                    {{ ViewHelper::getAcademicStatus($student->academic_status)}}
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $student->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $student->status == 'active'?"Active":"In Active" }}
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">Data not found.</td>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


