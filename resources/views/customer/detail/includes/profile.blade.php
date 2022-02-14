<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="{{ route($base_route.'.edit', ['id' =>  encrypt($data['customer']->id)]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
            <span class="green">
                <i class="ace-icon fa fa-pencil-square-o bigger-200"></i>
            </span>
        </a> |
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>

    <div class="col-xs-12 col-sm-3 col-print-3">
        <div>
            <span class="profile-picture">
               @if($data['customer']->customer_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['customer']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'customerProfile'.DIRECTORY_SEPARATOR.$data['customer']->customer_image) }}" width="300px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['customer']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif
            </span>

            <div class="space-4"></div>
            {{--<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                <div class="inline position-relative">
                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                        <i class="ace-icon fa fa-circle light-green"></i>
                        &nbsp;
                        <span class="white">Alex M. Doe</span>
                    </a>

                    <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                        <li class="dropdown-header"> Change Status </li>

                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-circle green"></i>
                                &nbsp;
                                <span class="green">Available</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-circle red"></i>
                                &nbsp;
                                <span class="red">Busy</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-circle grey"></i>
                                &nbsp;
                                <span class="grey">Invisible</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>--}}

        </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-print-9">
        {{--<div class="center">
            <span class="btn btn-app btn-sm btn-light no-hover">
                <span class="line-height-1 bigger-170 blue"> 1,411 </span>
                <br>
                <span class="line-height-1 smaller-90"> Views </span>
            </span>
            <span class="btn btn-app btn-sm btn-yellow no-hover">
                <span class="line-height-1 bigger-170"> 32 </span>
                <br>
                <span class="line-height-1 smaller-90"> Followers </span>
            </span>
            <span class="btn btn-app btn-sm btn-pink no-hover">
                <span class="line-height-1 bigger-170"> 4 </span>
                <br>
                <span class="line-height-1 smaller-90"> Projects </span>
            </span>
            <span class="btn btn-app btn-sm btn-grey no-hover">
                <span class="line-height-1 bigger-170"> 23 </span>
                <br>
                <span class="line-height-1 smaller-90"> Reviews </span>
            </span>
            <span class="btn btn-app btn-sm btn-success no-hover">
                <span class="line-height-1 bigger-170"> 7 </span>
                <br>
                <span class="line-height-1 smaller-90"> Albums </span>
            </span>
            <span class="btn btn-app btn-sm btn-primary no-hover">
                <span class="line-height-1 bigger-170"> 55 </span>
                <br>
                <span class="line-height-1 smaller-90"> Contacts </span>
            </span>
        </div>--}}

        <div class="space-3"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">
            {{ $data['customer']->name}} |
            <span class="" style="color: yellow;">
                <em>({{  ViewHelper::getCustomerStatus( $data['customer']->customer_status ) }})</em>
            </span>
        </div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> RegNo : </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['customer']->reg_no }}</span>
                </div>

                <div class="profile-info-name"> Address : </div>
                <div class="profile-info-value">
                    <span class="editable" id="address">{{ $data['customer']->address }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">

            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['customer']->email }}</span>
                </div>

                <div class="profile-info-name"> Telephone No : </div>
                <div class="profile-info-value">
                    <span class="editable" id="tel">{{ $data['customer']->tel }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Mobile 1 : </div>
                <div class="profile-info-value">
                    <span class="editable" id="mobile_1">{{ $data['customer']->mobile_1 }}</span>
                </div>

                <div class="profile-info-name"> Mobile 2 : </div>
                <div class="profile-info-value">
                    <span class="editable" id="mobile_2">{{ $data['customer']->mobile_2 }}</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->