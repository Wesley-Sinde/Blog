<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Certificate History List</h4>
            <div class="clearfix">
                    <span class="pull-right tableTools-container"></span>
            </div>
            <div class="table-header">
                {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
            </div>
            <!-- div.table-responsive -->
            <div class="table-responsive">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead >
                    {{--" ""certificate" => "attendance"
                            "certificate_id" => 9
                            "history_type" => "Updated"
                            "ref_text" => "{"_token":"--}}
                        <tr>
                            <th>S.N.</th>
                            <th>Faculty/Class</th>
                            <th>Sem./Sec.</th>
                            <th>Reg.Num</th>
                            <th>Student Name</th>
                            <th>Certificate </th>
                            <th>History</th>
                            <th>Created At</th>
                            <th>Ref_Text</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['history']) && $data['history']->count() > 0)
                        @php($i=1)
                        @foreach($data['history'] as $history)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> {{  ViewHelper::getFacultyTitle( $history->faculty ) }}</td>
                                <td> {{  ViewHelper::getSemesterTitle( $history->semester ) }}</td>
                                <td><a href="{{ route('student.view', ['id' => $history->students_id]) }}">{{ $history->reg_no }}</a></td>
                                <td><a href="{{ route('student.view', ['id' => $history->students_id]) }}"> {{ $history->first_name.' '.$history->middle_name.' '. $history->last_name }}</a></td>
                                <td class="text-uppercase">{{ $history->certificate }}</td>
                                <td>
                                    <label class="label label-primary">{{$history->history_type}}</label>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d')}} </td>
                                <td>
                                    <div id="accordion" class="accordion-style1 panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$i}}" aria-expanded="false">
                                                        <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                        Reference Text
                                                    </a>
                                                </h4>
                                            </div>

                                            <div class="panel-collapse collapse" id="collapse-{{$i}}" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    @if($history->ref_text)
                                                        @php($refText = json_decode($history->ref_text))
                                                        <table class="table table-striped table-bordered table-hover">
                                                            @foreach($refText as $key => $value)
                                                                <tr>
                                                                    <td class="text-uppercase" width="20%" style="font-weight: 600">{{str_replace('_',' ',$key)}}</td>
                                                                    <td>{{$value}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">No Certificate history data found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

