<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div>
            <table class="table table-striped table-bordered table-hover">
                <tr >
                    <td class="label-info white">Year</td>
                    <td>{{ ViewHelper::getYearById($data['assignment']->years_id) }}</td>
                    <td class="label-info white">Semester/Sec.</td>
                    <td>{!! ViewHelper::getSemesterById($data['assignment']->semesters_id) !!}</td>
                    <td class="label-info white">Subject</td>
                    <td>{{ViewHelper::getSubjectById($data['assignment']->subjects_id)}}</td>
                </tr>
                <tr >
                    <td class="label-info white">Date</td>
                    <td>
                        {{ \Carbon\Carbon::parse($data['assignment']->publish_date)->format('M d, Y')}} TO
                        {{ \Carbon\Carbon::parse($data['assignment']->end_date)->format('M d, Y')}}
                    </td>
                    <td class="label-info white">File</td>
                    <td>
                        @if($data['assignment']->file)
                            <a href="{{ asset('assignments'.DIRECTORY_SEPARATOR.'questions'.DIRECTORY_SEPARATOR.$data['assignment']->file) }}" target="_blank" >
                                Attachment File
                                <i class="ace-icon fa fa-download bigger-120"></i>
                            </a>
                        @endif
                    </td>
                    <td class="label-info white">Status</td>
                    <td>
                        <button class="btn btn-primary btn-minier dropdown-toggle {{$data['assignment']->status == 'active'?"btn-info":"btn-warning" }}" >
                            {{$data['assignment']->status == 'active'?"Active":"In Active" }}
                        </button>
                    </td>
                </tr>
                <tr >
                    <td class="label-info white">Title</td>
                    <td colspan="5">{!! $data['assignment']->title !!}</td>
                </tr>
                <tr >
                    <td class="label-info white">Detail</td>
                    <td colspan="5">{!! $data['assignment']->description !!}</td>
                </tr>
            </table>
        </div>
    </div>
</div><!-- /.row -->




