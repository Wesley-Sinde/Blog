<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
    <!-- div.table-responsive -->
        <div class="table-responsive">
            <table  class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th width="15%">Gateway</th>
                        <th>Config</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['paymentGateway']) && $data['paymentGateway']->count() > 0)
                        @php($i = 1)
                        @foreach($data['paymentGateway'] as $Gateway)

                            {!! Form::model($Gateway, ['route' => [$base_route.'.update', $Gateway->id], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                                <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    <a href="{{$Gateway->link}}" target="_blank">
                                        <img id="avatar" class="editable img-responsive" alt="{{ $Gateway->identity }}" src="{{ asset('assets/images/paymenticon/'.$Gateway->logo.'.png') }}" width="300px" />
                                    </a>
                                </td>
                                <td>
                                    @php($configuarations = json_decode($Gateway->config, true))
                                    @if(isset($configuarations))
                                        @foreach($configuarations as $key => $conf)
                                            <label class="col-sm-4 control-label">{{ $key }}</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{$conf}}" name="{{$key}}" {{ $Gateway->status=="active"?"":"disabled" }} class="form-control border-form">
                                            </div>
                                            <hr class="hr-2">
                                        @endforeach
                                    @endif
                                </td>
                                <td class="hidden-480 ">
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $Gateway->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $Gateway->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route($base_route.'.active', ['id' => $Gateway->id]) }}" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.in-active', ['id' => $Gateway->id]) }}" title="In-Active"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <button class="btn btn-info" type="submit">
                                        <i class="fa fa-save bigger-110"></i>
                Update
                                    </button>
                                </td>
                            </tr>
                            {!! Form::close() !!}
                            @php($i++)
                        @endforeach
                    @else
                        <tr><td colspan="7">No data found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>