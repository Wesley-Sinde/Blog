<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>


    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['hostel']->name }}</div>

    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                @if($data['hostel']->image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['hostel']->name }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$data['hostel']->image) }}" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['hostel']->name }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif

            </span>
            <div class="space-6"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Hostel: </div>
                <div class="profile-info-value">
                    <span class="editable" id="name">{{ $data['hostel']->name }}</span>
                </div>
                <div class="profile-info-name"> Type: </div>
                <div class="profile-info-value">
                    <span class="editable" id="type">{{ $data['hostel']->type }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Address: </div>
                <div class="profile-info-value">
                    <span class="editable" id="address">{{ $data['hostel']->address }}</span>
                </div>
            </div>
        </div>

        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Warden: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden">{{ $data['hostel']->warden }}</span>
                </div>

                <div class="profile-info-name">Contact No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden_contact">{{ $data['hostel']->warden_contact }}</span>
                </div>
            </div>
        </div>

        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Rooms: </div>
                <div class="profile-info-value">
                    <span class="editable" id="rooms">{{ $data['hostel']->rooms()->count() }}</span>
                </div>
                <div class="profile-info-name">Beds: </div>
                <div class="profile-info-value">
                    <span class="editable" id="status">{{ $data['hostel']->beds()->count() }}</span>
                </div>
                <div class="profile-info-name">Status: </div>
                <div class="profile-info-value">
                    <span class="editable" id="status">{{ $data['hostel']->status=='active'?'Active':'In-Active' }}</span>
                </div>
            </div>
        </div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Contact Detail: </div>
                <div class="profile-info-value">
                    <span class="editable" id="contact_detail">{{ $data['hostel']->contact_detail }}</span>
                </div>

                <div class="profile-info-name">Description: </div>
                <div class="profile-info-value">
                    <span class="editable" id="description">{{ $data['hostel']->description }}</span>
                </div>
            </div>
        </div>

        <div class="space-6"></div>
    </div>
</div><!-- /.row -->




