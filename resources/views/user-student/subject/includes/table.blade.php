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
                    <th width="5%">S.N.</th>
                    <th>Course Title</th>
                    <th width="10%">Marking</th>
                    <th width="30%">Info</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['subject']) && $data['subject']->count() > 0)
                    @php($i=1)
                    @foreach($data['subject'] as $subject)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $subject->title }} - [{{ $subject->code }} ]
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td class="blue text-right">FM (T) - </td>
                                        <td class="text-left">
                                            {{ $subject->full_mark_theory }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">PM (T) - </td>
                                        <td class="text-left">
                                            {{ $subject->pass_mark_theory }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">FM (P) - </td>
                                        <td class="text-left">
                                            {{ $subject->full_mark_practical }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">PM (P) - </td>
                                        <td class="text-left">
                                            {{ $subject->pass_mark_practical }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td >
                                <table>
                                    <tr>
                                        <td class="blue text-right">Credit Hour - </td>
                                        <td class="text-left">
                                            {{ $subject->credit_hour }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">Subject Type - </td>
                                        <td class="text-left">
                                            {{ $subject->sub_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">Class Type - </td>
                                        <td class="text-left">
                                            {{ $subject->class_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-right">Teacher/Staff - </td>
                                        <td class="text-left">
                                            {{ ViewHelper::getStaffNameById($subject->staff_id) }}
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