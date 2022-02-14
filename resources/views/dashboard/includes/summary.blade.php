<div class="widget-box transparent">
    <div class="widget-header widget-header-flat">
        <h4 class="widget-title lighter">
            <i class="ace-icon fa fa-star orange"></i>
            Overal Summary
        </h4>

        <div class="widget-toolbar">
            <a href="#" data-action="collapse">
                <i class="ace-icon fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table class="table table-bordered table-striped">
                <thead class="thin-border-bottom">
                <tr>
                    <th colspan="2"> <i class="ace-icon fa fa-users green"></i>Student Status
                    </th>
                </tr>
                </thead>

                <tbody>
                @if (isset($data['student_active_status']) && $data['student_active_status']->count() > 0)
                    @php($i=1)
                    @foreach($data['student_active_status'] as $student_count)
                        <tr>
                            <td>{{ $student_count->status == 'active'?"Active":"In Active" }}</td>
                            <td>
                                <b>{{ $student_count->total }}</b>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b class="blue">Total Student:</b></td>

                        <td>
                            <b class="green">{{ $data['academic_status_count']->sum('total') }}</b>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11">No data found.</td>
                    </tr>
                @endif

                </tbody>
            </table>

            <table class="table table-bordered table-striped">
                <thead class="thin-border-bottom">
                <tr>
                    <th colspan="2"> <i class="ace-icon fa fa-users blue"></i>Academic Status
                    </th>
                </tr>
                </thead>

                <tbody>
                @if (isset($data['academic_status_count']) && $data['academic_status_count']->count() > 0)
                    @php($i=1)
                    @foreach($data['academic_status_count'] as $student_count)
                        <tr>
                            <td>{{ ViewHelper::getAcademicStatus($student_count->academic_status) }}</td>

                            <td>
                                <b>{{ $student_count->total }}</b>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b class="blue">Total Student:</b></td>

                        <td>
                            <b class="green">{{ $data['academic_status_count']->sum('total') }}</b>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11">No data found.</td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
    <hr class="hr-double hr-8">
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table class="table table-bordered table-striped">
                <thead class="thin-border-bottom">
                <tr>
                    <th colspan="2"> <i class="ace-icon fa fa-user-secret green"></i>Staff Status
                    </th>
                </tr>
                </thead>

                <tbody>
                @if (isset($data['staff_status']) && $data['staff_status']->count() > 0)
                    @php($i=1)
                    @foreach($data['staff_status'] as $staff_count)
                        <tr>
                            <td>{{ $staff_count->status == 'active'?"Active":"In Active" }}</td>
                            <td>
                                <b>{{ $staff_count->total }}</b>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b class="blue">Total Staff:</b></td>

                        <td>
                            <b class="green">{{ $data['staff_status']->sum('total') }}</b>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11">No data found.</td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
    <hr class="hr-double hr-8">
    <div class="widget-body">
        <div class="widget-main no-padding">
            <table class="table table-bordered table-striped">
                <thead class="thin-border-bottom">
                <tr>
                    <th colspan="2"> <i class="ace-icon fa fa-book green"></i>Book Status
                    </th>
                </tr>
                </thead>

                <tbody>
                @if (isset($data['books_status']) && $data['books_status']->count() > 0)
                    @php($i=1)
                    @foreach($data['books_status'] as $book_count)
                        <tr>
                            <td>{{ ViewHelper::getBookStatusById($book_count->book_status) }}</td>
                            <td>
                                <b>{{ $book_count->total }}</b>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b class="blue">Total Book:</b></td>

                        <td>
                            <b class="green">{{ $data['books_status']->sum('total') }}</b>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11">No data found.</td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
    <hr class="hr-double hr-8">
    {{--
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title lighter smaller">
                <i class="ace-icon fa fa-comment blue"></i>
                Conversation
            </h4>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <div class="dialogs">
                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Alexa's Avatar" src="assets/images/avatars/avatar1.png" />
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="ace-icon fa fa-clock-o"></i>
                                <span class="green">4 sec</span>
                            </div>

                            <div class="name">
                                <a href="#">Alexa</a>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="John's Avatar" src="assets/images/avatars/avatar.png" />
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="ace-icon fa fa-clock-o"></i>
                                <span class="blue">38 sec</span>
                            </div>

                            <div class="name">
                                <a href="#">John</a>
                            </div>
                            <div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Bob's Avatar" src="assets/images/avatars/user.jpg" />
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="ace-icon fa fa-clock-o"></i>
                                <span class="orange">2 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Bob</a>
                                <span class="label label-info arrowed arrowed-in-right">admin</span>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Jim's Avatar" src="assets/images/avatars/avatar4.png" />
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="ace-icon fa fa-clock-o"></i>
                                <span class="grey">3 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Jim</a>
                            </div>
                            <div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="itemdiv dialogdiv">
                        <div class="user">
                            <img alt="Alexa's Avatar" src="assets/images/avatars/avatar1.png" />
                        </div>

                        <div class="body">
                            <div class="time">
                                <i class="ace-icon fa fa-clock-o"></i>
                                <span class="green">4 min</span>
                            </div>

                            <div class="name">
                                <a href="#">Alexa</a>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

                            <div class="tools">
                                <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <form>
                    <div class="form-actions">
                        <div class="input-group">
                            <input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
                            <span class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius" type="button">
																		<i class="ace-icon fa fa-share"></i>
																		Send
																	</button>
																</span>
                        </div>
                    </div>
                </form>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div><!-- /.widget-box -->
    --}}
</div><!-- /.widget-box -->