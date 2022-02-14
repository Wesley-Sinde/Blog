<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="{{ route($base_route.'.edit', ['id' =>  encrypt($data['product']->id)]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
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
               @if($data['product']->product_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['product']->name }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$data['product']->product_image) }}" width="300px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['product']->name }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
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
            {{ $data['product']->code}} - {{ $data['product']->name}}
        </div>
        <div class="space-6"></div>

        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Category : </div>
                <div class="profile-info-value">
                    <span class="editable" id="category_id">{{  ViewHelper::getProductCategory( $data['product']->category_id ) }}</span>
                </div>

                <div class="profile-info-name"> Sub Category : </div>
                <div class="profile-info-value">
                    <span class="editable" id="sub_category_id">{{  ViewHelper::getProductSubCategory( $data['product']->sub_category_id ) }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            {{--'warranty',
                    'product_image', 'cost_price', 'sale_price', 'stock', 'description','status'--}}
            <div class="profile-info-row">
                <div class="profile-info-name"> Warranty : </div>
                <div class="profile-info-value">
                    <span class="editable" id="warranty">{{ $data['product']->warranty }}</span>
                </div>

                <div class="profile-info-name"> Price : </div>
                <div class="profile-info-value">
                    <span class="editable" id="price">{{ $data['product']->getProductSellPrice() }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Stock : </div>
                <div class="profile-info-value">
                    <span class="editable" id="stock">{{$data['product']->getProductStock()}}</span>
                </div>

                <div class="profile-info-name"> Status : </div>
                <div class="profile-info-value">
                    <span class="editable" id="status">{{ $data['product']->status }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Description : </div>
                <div class="profile-info-value">
                    <span class="editable" id="description">{{  $data['product']->description  }}</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->