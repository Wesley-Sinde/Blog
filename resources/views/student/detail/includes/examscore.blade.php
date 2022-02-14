@if($data['examScore'] && $data['examScore']->count() > 0)
    @foreach($data['examScore'] as $key => $examScore )
        <h4 class="header large lighter text-uppercase blue">
            <i class="blue ace-icon fa fa-certificate bigger-140"></i>
            {{ ViewHelper::getYearById($examScore[0]->years_id) }} |
            {{ ViewHelper::getMonthById($examScore[0]->months_id) }} |
            {{ ViewHelper::getExamById($examScore[0]->exams_id) }} |
            {{  ViewHelper::getSemesterTitle( $examScore[0]->semesters_id ) }}
        </h4>
        <div class="main-content ">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="widget-box transparent">
                                <div class=row">
                                    <div class="table-responsive">
                                    <table width="100%" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">SN</th>
                                            <th rowspan="2" class="text-center">SUBJECT CODE</th>
                                            <th rowspan="2" class="text-center">SUBJECT TITLE</th>
                                            <th colspan="2" class="text-center">FULL MARK</th>
                                            <th colspan="2" class="text-center">PASS MARK</th>
                                            <th colspan="2" class="text-center">OBTAINED MARK</th>
                                            <th rowspan="2" class="text-center">TOTAL</th>
                                            <th rowspan="2" class="text-center">REMARK</th>
                                        </tr>
                                        <tr>
                                            <th>TH</th>
                                            <th>PR</th>
                                            <th>TH</th>
                                            <th>PR</th>
                                            <th>TH</th>
                                            <th>PR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($examScore && $examScore->count() > 0)
                                            @php($i=1)
                                            @foreach($examScore as $subject)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ViewHelper::getSubjectCodeById($subject->subjects_id)}}</td>
                                                    <td>{{ViewHelper::getSubjectById($subject->subjects_id)}}</td>
                                                    <td>{{$subject->full_mark_theory?$subject->full_mark_theory:'-'}}</td>
                                                    <td>{{$subject->full_mark_practical?$subject->full_mark_practical:'-'}}</td>
                                                    <td>{{$subject->pass_mark_theory?$subject->pass_mark_theory:'-'}}</td>
                                                    <td>{{$subject->pass_mark_practical?$subject->pass_mark_practical:'-'}}</td>
                                                    <td>{{$subject->obtain_mark_theory?$subject->obtain_mark_theory.$subject->th_remark:'-'}}</td>
                                                    <td>{{$subject->obtain_mark_practical?$subject->obtain_mark_practical.$subject->pr_remark:'-'}}</td>
                                                    <td>{{$subject->total_obtain_mark?$subject->total_obtain_mark:'-'}}</td>
                                                    <td>{{$subject->remark?$subject->remark:''}}</td>
                                                </tr>
                                                @php($i++)
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot style="font-weight: 600">
                                            <td colspan="9" class="text-right">TOTAL</td>
                                            <td>{{$examScore->sum('total_obtain_mark')?$examScore->sum('total_obtain_mark'):'-'}}</td>
                                            <td>
                                                @php($fullMark = $examScore->sum('full_mark_theory')+$examScore->sum('full_mark_practical'))
                                                @php($totalMark = $examScore->sum('total_obtain_mark'))
                                                @php($percent = ($totalMark * 100)/$fullMark)
                                                {{ number_format((float)$percent, 2, '.', '').'%' }}
                                                @php($remark = $examScore->pluck('remark')->toArray())
                                                @php($pr_remark = $examScore->pluck('pr_remark')->toArray())

                                                @if(in_array('*',$remark) || in_array('*',$pr_remark))
                                                    [Fail]
                                                @else
                                                    [Pass]
                                                    <br>
                                                    Rank: {{ ViewHelper::getStudentRankingInExam($examScore[0]->years_id, $examScore[0]->months_id, $examScore[0]->exams_id,$examScore[0]->faculty_id, $examScore[0]->semesters_id, $data['student']->id) }}
                                                @endif
                                                <br>
                                                Position : {{ ViewHelper::getStudentPositionInExam($examScore[0]->years_id, $examScore[0]->months_id, $examScore[0]->exams_id,$examScore[0]->faculty_id, $examScore[0]->semesters_id, $data['student']->id) }}
                                            </td>
                                        </tfoot>
                                    </table>

                                    </div>
                                </div>
                            </div>
                        </div><!-- /.page-content -->
                    </div>
                </div>
            </div>
        </div><!-- /.main-content -->
    @endforeach
@endif