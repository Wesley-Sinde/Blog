<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Assignment List</h4>
        <div class="clearfix">

    <span class="easy-link-menu">
        <a class="btn-primary btn-sm bulk-action-btn" attr-action-type="active"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</a>
        <a class="btn-warning btn-sm bulk-action-btn" attr-action-type="in-active"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;In-Active</a>
        <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
    </span>

            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => 'assignment.bulk-action', 'id' => 'bulk_action_form']) !!}
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
                    <th>SEM/SEC</th>
                    <th>Subject</th>
                    <th>Question</th>
                    <th>AvailableOn</th>
                    <th>Submit</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['assignment']) && $data['assignment']->count() > 0)
                    @php($i=1)
                    @foreach($data['assignment'] as $assignment)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $assignment->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td>{{ isset($assignment->semesters_id)?ViewHelper::getSemesterById($assignment->semesters_id):'' }}</td>
                            <td>{{ isset($assignment->subjects_id)?ViewHelper::getSubjectById($assignment->subjects_id):'' }}</td>
                            <td>
                                <a href="{{ route('assignment.view', ['id' => encrypt($assignment->id)]) }}">
                                    {{ $assignment->title }}
                                </a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($assignment->publish_date)->format('M d, Y')}} TO
                                {{ \Carbon\Carbon::parse($assignment->end_date)->format('M d, Y')}}
                            </td>
                            <td>
                                {{ $assignment->answers()->count() }}
                            </td>
                            <td> {{$assignment->created_by_name}} </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $assignment->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $assignment->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('assignment.active', ['id' => encrypt($assignment->id)]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('assignment.in-active', ['id' => encrypt($assignment->id)]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('assignment.view', ['id' => encrypt($assignment->id)]) }}" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>

                                    <a href="{{ route('assignment.edit', ['id' => encrypt($assignment->id)]) }}" class="btn btn-success btn-minier">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a href="{{ route('assignment.delete', ['id' => encrypt($assignment->id)]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


