<!-- 'name', 'email', 'password', 'profile_image', 'email', 'contact_number', 'address','user_type', -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#registrationinfo">General Information</a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#profileimage">Profile Images</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="registrationinfo" class="tab-pane active">
            @include('customer.registration.includes.forms.generalinfo')
        </div>
        <div id="profileimage" class="tab-pane">
            @include('customer.registration.includes.forms.profileimage')
        </div>
    </div>



    <div class="space-4"></div>



    <div class="hr hr-24"></div>
</div>