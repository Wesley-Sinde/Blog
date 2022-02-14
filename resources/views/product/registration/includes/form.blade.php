<!-- 'name', 'email', 'password', 'profile_image', 'email', 'contact_number', 'address','user_type', -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#registrationinfo">Product Info</a>
        </li>
        {{--<li class="">--}}
            {{--<a data-toggle="tab" href="#profileimage">Images</a>--}}
        {{--</li>--}}
    </ul>

    <div class="tab-content">
        <div id="registrationinfo" class="tab-pane active">
            @include('product.registration.includes.forms.generalinfo')
            @include('product.registration.includes.forms.image')
        </div>
        {{--<div id="profileimage" class="tab-pane">--}}
            {{--@include('product.registration.includes.forms.image')--}}
        {{--</div>--}}
    </div>



    <div class="space-4"></div>



    <div class="hr hr-24"></div>
</div>