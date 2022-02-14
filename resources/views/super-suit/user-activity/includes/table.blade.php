<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">

    <span class="easy-link-menu">
        <a class="btn-danger btn-sm bulk-action-btn" attr-action-type="delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a>
    </span>

            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>
        <!-- div.table-responsive -->
            <!-- div.table-responsive -->
        <div class="table-responsive">
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
                        <th>User</th>
                        <th>User Type</th>
                       {{-- <th>Audi.Type</th>
                        <th>Audi.Id</th>--}}
                        <th>Event</th>
                        <th width="20%">Old Values</th>
                        <th width="20%">New Values</th>
                        <th>URL</th>
                        <th>IP Address</th>
                        {{--<th>User Agent</th>--}}
                        <th>Tags</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($data['user-activity']) && $data['user-activity']->count() > 0)
                    @php($i=1)
                    @foreach($data['user-activity'] as $activity)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $activity->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td> {{  $activity->name }} </td>
                            <td> {{  $activity->display_name }} </td>
                            <td>{{ $activity->event }}</td>
                            <td>
                                <div id="accordion" class="accordion-style1 panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOld-{{$i}}" aria-expanded="false">
                                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                    Old Values
                                                </a>
                                            </h4>
                                        </div>

                                        <div class="panel-collapse collapse" id="collapseOld-{{$i}}" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                @if($activity->old_values)
                                                    <table class="table table-striped table-bordered table-hover">
                                                        @foreach($activity->old_values as $key => $value)
                                                            <tr>
                                                                <td class="text-uppercase" style="font-weight: 600">{{str_replace('_',' ',$key)}}</td>
                                                                @if($key == 'ref_text')
                                                                    <td>
                                                                        <table class="table table-striped table-bordered table-hover">
                                                                            @php($refText  =json_decode($value))
                                                                            @foreach($refText as $keyfield => $text)
                                                                                <tr>
                                                                                    @if($key == 'ref_text')
                                                                                        <td class="text-uppercase" width="10%" style="font-weight: 600">{{str_replace('_',' ',$keyfield)}}</td>
                                                                                        <td> {{$text}} </td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </td>
                                                                @else
                                                                    <td>{{$value}}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="accordion" class="accordion-style1 panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNew-{{$i}}" aria-expanded="false">
                                                    <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                    New Values
                                                </a>
                                            </h4>
                                        </div>

                                        <div class="panel-collapse collapse" id="collapseNew-{{$i}}" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                @if($activity->new_values)
                                                    <table class="table table-striped table-bordered table-hover">
                                                        @foreach($activity->new_values as $key => $value)
                                                            <tr>
                                                                {{--<td class="text-uppercase" style="font-weight: 600">{{$key}}</td>--}}
                                                                <td class="text-uppercase" style="font-weight: 600">{{str_replace('_',' ',$key)}}</td>
                                                                @if($key == 'ref_text')
                                                                    <td>
                                                                        <table class="table table-striped table-bordered table-hover">
                                                                            @php($refText  =json_decode($value))
                                                                            @foreach($refText as $keyfield => $text)
                                                                                <tr>
                                                                                    @if($key == 'ref_text')
                                                                                        <td class="text-uppercase" width="10%" style="font-weight: 600">{{str_replace('_',' ',$keyfield)}}</td>
                                                                                        <td> {{$text}} </td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </td>
                                                                @else
                                                                    <td>{{$value}}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>{{ $activity->url }}</td>
                            <td>{{ $activity->ip_address }}</td>
                            {{--<td>{{ $activity->user_agent }}</td>--}}
                            <td>{{ $activity->tags }}</td>
                            <td>{{ $activity->created_at }}</td>
                            <td>{{ $activity->updated_at }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route($base_route.'.delete', ['id' => $activity->id]) }}" class="btn btn-danger btn-minier bootbox-confirm" >
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="16">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}

        </div>
    </div>
</div>