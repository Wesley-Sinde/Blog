<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div>
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
                            <th>Sem/Sec</th>
                            <th>Subject</th>
                            <th>Title</th>
                            <th>Uploaded By</th>
                            <th>Date&Time</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['download']) && $data['download']->count() > 0)
                            @php($i=1)
                            @foreach($data['download'] as $download)
                                <tr>
                                    <td class="center first-child">
                                        <label>
                                            <input type="checkbox" name="chkIds[]" value="{{ encrypt($download->id) }}" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{ $i }}</td>
                                    <td>{{ isset($download->semesters_id)?ViewHelper::getSemesterById($download->semesters_id):'' }}</td>
                                    <td>{{ isset($download->subjects_id)?ViewHelper::getSubjectById($download->subjects_id):'' }}</td>
                                    <td>
                                        <a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank">
                                            {{ $download->title }}
                                        </a>
                                    </td>
                                    <td> {{$download->created_by_name}} </td>
                                    <td> {{$download->created_at}} </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $download->status == 'active'?"btn-info":"btn-warning" }}" >
                                                {{ $download->status == 'active'?"Active":"In Active" }}
                                                <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                            </button>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route($base_route.'.active', ['id' => encrypt($download->id)]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                </li>

                                                <li>
                                                    <a href="{{ route($base_route.'.in-active', ['id' => encrypt($download->id)]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank" class="btn btn-primary btn-minier">
                                                <i class="ace-icon fa fa-download bigger-130"></i>
                                            </a>
                                            {{--<a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank" class="btn btn-primary btn-minier">
                                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                            </a>--}}

                                            <a href="{{ route($base_route.'.edit', ['id' => encrypt($download->id)]) }}" class="btn btn-success btn-minier">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>

                                            <a href="{{ route($base_route.'.delete', ['id' => encrypt($download->id)]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>