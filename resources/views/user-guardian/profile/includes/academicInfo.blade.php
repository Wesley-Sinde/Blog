<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Academic Info</h4>
        <div class="table-responsive">
            @if (isset($data['academicInfos']))
                @foreach($data['academicInfos'] as $academicInfo)
            <table id="responsive" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="80%">
                            {{ $academicInfo->board }} | {{$academicInfo->pass_year}}
                        </th>
                        <th>
                            @ability('super-admin', 'student-delete-academic-info')
                                <a href="{{ route('student.delete-academicInfo', ['id' => $academicInfo->id]) }}" class="btn btn-danger btn-minier bootbox-confirm align-right" >
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i> Delete
                                </a>
                            @endability
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="option_value">
                        <td colspan="2">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                        Institution
                                    </td>
                                    <td>
                                       {{ $academicInfo->institution }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Board/Training
                                    </td>
                                    <td>
                                        {{ $academicInfo->board }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pass Year
                                    </td>
                                    <td>
                                        {{$academicInfo->pass_year}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Symbol Number
                                    </td>
                                    <td>
                                        {{$academicInfo->symbol_no}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Percentage
                                    </td>
                                    <td>
                                        {{$academicInfo->percentage}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Division / Grade
                                    </td>
                                    <td>
                                        {{$academicInfo->division_grade}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Major Subject
                                    </td>
                                    <td>
                                        {{$academicInfo->major_subjects}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Remark
                                    </td>
                                    <td>
                                        {{$academicInfo->remark}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </tbody>

            </table>
                @endforeach
            @endif
        </div>
    </div>

</div><!-- /.row -->