<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div>
            @if (isset($data['row']) && $data['row']->count() > 0)
                @foreach($data['row'] as $event)
                    <a href="#{{$event->event}}" class=""><span class="label label-info" style="margin-bottom: 5px !important;"># {{$event->event}}</span></a>
                @endforeach
            @endif
        </div>

        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>

        <div class="table-header">
            {{ $panel }}  Record list on table. Filter {{ $panel }} using the filter.
        </div>

        <!-- div.table-responsive -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Event</th>
                    <th>Alert</th>
                    <th>Template</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['row']) && $data['row']->count() > 0)
                    @php($i=1)
                    @foreach($data['row'] as $event)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <p class="" id="{{ $event->event }}" >{{ $event->event }}</p>
                            </td>
                            <td>
                                @if($event->sms==1)
                                <div class="btn-group">
                                    <span data-toggle="dropdown" class="btn btn-primary btn-minier {{ $event->sms==1?"btn-info":"btn-warning" }}" >
                                        SMS
                                    </span>
                                </div>
                                @endif

                                @if($event->email==1)
                                    <div class="btn-group">
                                        <span data-toggle="dropdown" class="btn btn-primary btn-minier {{ $event->email==1?"btn-info":"btn-warning" }}" >
                                            E-Mail
                                        </span>
                                    </div>
                                    @endif
                            </td>
                            <td>
                                @if($event->subject)
                                    <span class="label label-info arrowed-right arrowed-in">
                                        {{ $event->subject }}
                                    </span>
                                    <br>
                                @endif
                                {{ $event->template }}
                            </td>
                            <td class="hidden-480 ">
                                <div class="btn-group">
                                    <span data-toggle="dropdown" class="btn btn-primary btn-minier {{ $event->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $event->status == 'active'?"Active":"In Active" }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="btn btn-success btn-xs" href="{{ route($base_route.'.edit', ['id' => $event->id]) }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i> Edit
                                    </a>
                                </div>
                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="{{ route($base_route.'.edit', ['id' => $event->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>