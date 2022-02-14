<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
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
                    <th>Sem/Sec</th>
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Uploaded By</th>
                    <th>Date&Time</th>
                    <th>Download</th>
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
                                <div class="action-buttons">
                                    <a href="{{ asset('downloads'.DIRECTORY_SEPARATOR.$download->file) }}" target="_blank" class="btn btn-primary btn-minier">
                                        <i class="ace-icon fa fa-download bigger-130"></i> Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">No {{ $panel }} data found. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
</div>