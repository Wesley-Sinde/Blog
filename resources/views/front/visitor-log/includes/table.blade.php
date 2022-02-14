<div class="form-horizontal">
    <div class="row">
        <div class="col-xs-12">
            @include('includes.data_table_header')
            <!-- div.table-responsive -->
                <div class="table-responsive">
                    {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>S.N.</th>
                                    <th>Purpose</th>
                                    <th>Token</th>
                                    <th>Date</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{--'date', 'purpose', 'name', 'phone', 'email', 'id_doc', 'id_num', 'in_time', 'out_time', 'token', 'note', 'attachment', 'status'--}}
                            <tbody>
                                @if (isset($data['visitor']) && $data['visitor']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['visitor'] as $visitor)
                                        <tr>
                                            <td class="center first-child">
                                                <label>
                                                    <input type="checkbox" name="chkIds[]" value="{{ $visitor->id }}" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td>{{$visitor->purpose}} </td>
                                            <td>{{$visitor->token}}</td>
                                            <td> {{\Carbon\Carbon::parse($visitor->date)->format('d-M-Y')}} </td>
                                            <td>
                                                <div id="faq-list-4" class="panel-group accordion-style1 accordion-style2">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div href="#{{$visitor->id}}" data-parent="#faq-list-4" data-toggle="collapse" class="accordion-toggle collapsed">
                                                                <i class="smaller-80 fa fa-plus" data-icon-hide="icon-minus" data-icon-show="icon-plus"></i>
                                                                &nbsp;
                                                                {{$visitor->name}} - In : {{$visitor->in_time}} - Out : {{$visitor->out_time}}

                                                                <hr class="hr-2">

                                                                <div class="panel-collapse collapse" id="{{$visitor->id}}">
                                                                    <div class="panel-body">
                                                                        <table class="table table-striped table-bordered table-hover" >
                                                                            <tr>
                                                                                <td width="20%">Phone:</td>
                                                                                <td>{{$visitor->pdone}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20%">Email :</td>
                                                                                <td>{{$visitor->email}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20%">Id:</td>
                                                                                <td>{{$visitor->id_doc}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="20%">Number:</td>
                                                                                <td>{{$visitor->id_num}}</td>
                                                                            </tr>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $visitor->status == 'active'?"btn-success":"btn-warning" }}" >
                                                            {{ $visitor->status == 'active'?"Visiting":"Complete" }}
                                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                                        </button>

                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route($base_route.'.active', ['id' => $visitor->id]) }}"> Visiting</a>
                                                            </li>

                                                            <li>
                                                                <a href="{{ route($base_route.'.in-active', ['id' => $visitor->id]) }}"> Complete</a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    @if(isset($visitor->attachment))
                                                        <a href="{{ asset('visitorLog'.DIRECTORY_SEPARATOR.$visitor->attachment) }}" target="_blank">
                                                            <i class="ace-icon fa fa-download bigger-130"></i>
                                                        </a>
                                                    @endif

                                                    <a class="green" href="{{ route($base_route.'.edit', ['id' => encrypt($visitor->id)]) }}">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>

                                                    <a href="{{ route($base_route.'.delete', ['id' => encrypt($visitor->id)]) }}" class="red bootbox-confirm">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @php($i++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>

