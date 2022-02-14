<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>


    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['books']->title }}</div>

    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                @if($data['books']->image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['books']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$data['books']->image) }}" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['books']->title }}" src="{{ asset('assets/images/avatars/book.png') }}" />
                @endif

            </span>
            <div class="space-6"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> ISBN: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->isbn_number }}</span>
                </div>

                <div class="profile-info-name"> Book Code: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->code }}</span>
                </div>

                <div class="profile-info-name"> Book Category: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ ViewHelper::getBookCategoryById($data['books']->categories) }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Author: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->author }}</span>
                </div>

                <div class="profile-info-name"> Editor: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->editor }}</span>
                </div>

                <div class="profile-info-name"> Language: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->language }}</span>
                </div>

            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Edition: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->edition }}</span>
                </div>

                <div class="profile-info-name"> Edition Year: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->edition_year }}</span>
                </div>

                <div class="profile-info-name"> Series: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->edition_year }}</span>
                </div>



            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Publisher: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->publisher }}</span>
                </div>

                <div class="profile-info-name">Publish Year: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->publish_year }}</span>
                </div>



                <div class="profile-info-name">Rack Location: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->rack_location }}</span>
                </div>

            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Quantity: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->bookCollection()->count() }}</span>
                </div>

                <div class="profile-info-name"> Price: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->price }}</span>
                </div>

                <div class="profile-info-name">Total Page: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->total_pages }}</span>
                </div>

            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Source: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->source }}</span>
                </div>

                <div class="profile-info-name"> Note: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->notes }}</span>
                </div>

                <div class="profile-info-name">Status: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['books']->status }}</span>
                </div>

            </div>


        </div>

        <div class="space-6"></div>
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

    </div>
</div><!-- /.row -->




