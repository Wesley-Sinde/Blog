<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>



    <div class="col-xs-12 col-sm-12">
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">            
            <a href="{{ route('hostel.view', ['id' => $data['rooms']->hostels_id]) }}" class="white">
                Hostel: {{ ViewHelper::getHostelNameById($data['rooms']->hostels_id) }}
            </a>
        </div>
        <div class="label label-success label-xlg arrowed-in arrowed-right arrowed">
                Room Number: {{ $data['rooms']->room_number }}           
        </div>

        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Room Type: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden">{{ ViewHelper::getRoomTypeTitleById($data['rooms']->room_type) }}</span>
                </div>

                <div class="profile-info-name"> Beds: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden">{{ $data['rooms']->beds()->count() }}</span>
                </div>

                <div class="profile-info-name">Rate/Bed: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden_contact">{{ $data['rooms']->rate_perbed }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Status: </div>
                <div class="profile-info-value">
                    <span class="editable" id="status">{{ $data['rooms']->status=='active'?'Active':'In-Active' }}</span>
                </div>

                <div class="profile-info-name"> Description: </div>
                <div class="profile-info-value">
                    <span class="editable" id="warden">{{ $data['rooms']->description }}</span>
                </div>
            </div>
        </div>
        <div class="space-6"></div>
    </div>
</div><!-- /.row -->




