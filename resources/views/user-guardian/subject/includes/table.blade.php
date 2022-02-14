<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
            {{ \App\Facades\ViewHelperFacade::getFacultyTitle($data['semester']->faculty()->first()->id) }} |  
            {{ \App\Facades\ViewHelperFacade::getSemesterTitle($data['semester']->id) }}
        </h4>

        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Course Title</th>
                    <th>Marking</th>
                    <th>Info</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['subject']) && $data['subject']->count() > 0)
                    @php($i=1)
                    @foreach($data['subject'] as $subject)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $subject->title }}
                                <hr class="hr hr-2  ">
                                <div class="label label-primary arrowed-right arrowed-in">
                                    {{ $subject->code }}
                                </div>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>FM (T) - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->full_mark_theory }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PM (T) - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->pass_mark_theory }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FM (P) - </td>
                                        <td>
                                            <div class="label label-warning arrowed-right arrowed-in">
                                                {{ $subject->full_mark_practical }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PM (P) - </td>
                                        <td>
                                            <div class="label label-warning arrowed-right arrowed-in">
                                                {{ $subject->pass_mark_practical }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td >
                                <table>
                                    <tr>
                                        <td>Credit Hour - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->credit_hour }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subject Type - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->sub_type }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class Type - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->class_type }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher/Staff - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ ViewHelper::getStaffNameById($subject->staff_id) }}
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
</div>