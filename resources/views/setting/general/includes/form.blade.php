<!-- 'name', 'email', 'password', 'profile_image', 'email', 'contact_number', 'address','user_type', -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#general"><i class="fa fa-list-alt bigger-110"></i> General Information & Branding</a>
        </li>
        <li>
            <a data-toggle="tab" href="#module"><i class="fa fa-list bigger-110"></i> Module Activation </a>
        </li>
        <li>
            <a data-toggle="tab" href="#print"><i class="fa fa-print bigger-110"></i> Print</a>
        </li>
        <li>
            <a data-toggle="tab" href="#social"><i class="fa fa-facebook bigger-110"></i> Social Media</a>
        </li>
        {{--<li>
            <a data-toggle="tab" href="#timezone"><i class="fa fa-clock-o bigger-110"></i> TimeZone</a>
        </li>--}}
    </ul>

    <div class="tab-content">
        <div id="general" class="tab-pane active">
            @include('setting.general.includes.forms.general')
            @include('setting.general.includes.forms.timezone')
        </div>
        <div id="module" class="tab-pane">
            @include('setting.general.includes.forms.module')
        </div>
        <div id="print" class="tab-pane">
            @include('setting.general.includes.forms.print')
        </div>
        <div id="social" class="tab-pane">
            @include('setting.general.includes.forms.social')
        </div>
        {{--<div id="timezone" class="tab-pane">
        </div>--}}
    </div>

    <div class="hr hr-24"></div>
</div>
