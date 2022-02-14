<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
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
                    <th>{{ $panel }}</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['subject']) && $data['subject']->count() > 0)
                    @php($i=1)
                    @foreach($data['subject'] as $subject)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $subject->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td>
                                <hr class="hr-4">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td colspan="3">
                                            <div class="width-100 label label-info label-xlg align-left">
                                                <div class="inline position-relative">
                                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                        <span class="white">{{ '['.$subject->code.'] '.$subject->title }}</span>
                                                    </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-uppercase">Credit Hour - </td>
                                        <td>{{ $subject->credit_hour }}</td>
                                        <td rowspan="4">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="width-100 label label-info label-xlg">
                                                            <div class="inline position-relative">
                                                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="white">Marking</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="blue text-uppercase">FM (T) - </td>
                                                    <td> {{ $subject->full_mark_theory }} </td>
                                                </tr>
                                                <tr>
                                                    <td class="blue text-uppercase">PM (T) - </td>
                                                    <td> {{ $subject->pass_mark_theory }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="blue text-uppercase">FM (P) - </td>
                                                    <td> {{ $subject->full_mark_practical }} </td>
                                                </tr>
                                                <tr>
                                                    <td class="blue text-uppercase">PM (P) - </td>
                                                    <td>  {{ $subject->pass_mark_practical }}  </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-uppercase">Subject Type - </td>
                                        <td>{{ $subject->sub_type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-uppercase">Class Type - </td>
                                        <td>{{ $subject->class_type }}</td>
                                    </tr>
                                    <tr>
                                        <td class="blue text-uppercase">Teacher/Staff - </td>
                                        <td>{{ ViewHelper::getStaffNameById($subject->staff_id) }}</td>
                                    </tr>

                                </table>
                            </td>
                            <td class="hidden-480 ">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $subject->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $subject->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('subject.active', ['id' => $subject->id]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('subject.in-active', ['id' => $subject->id]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="green" href="{{ route($base_route.'.edit', ['id' => $subject->id]) }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.delete', ['id' => $subject->id]) }}" class="red bootbox-confirm">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>
                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="{{ route($base_route.'.edit', ['id' => $subject->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.delete', ['id' => $subject->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                    <span class="red ">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
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
                        <td colspan="7">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>