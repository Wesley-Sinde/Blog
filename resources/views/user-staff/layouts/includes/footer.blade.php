<div class="footer">
    <div class="footer-inner hidden-print">
        <div class="footer-content">
			<span class="bigger-120">
                <span class="blue bolder">
                    @if(isset($generalSetting->copyright))
                        {!! $generalSetting->copyright !!}
                    @else
                        <a href="http://businesswithtechnology.com" target="_blank">©BusinessWithTechnology</a>
                    @endif
                    {{--[ License Info :- User : {{isset($generalSetting->buyer)?$generalSetting->buyer:''}} | Expired On : {{isset($generalSetting->license)?\Carbon\Carbon::parse($generalSetting->license)->format('d-m-Y'):''}}| Support Until : {{isset($generalSetting->support)?$generalSetting->support:''}}]--}}
                </span>
            </span>
        </div>
    </div>
	{{--<footer class="onlyprint">footer text for print<!--Content Goes Here--></footer>--}}
</div>

<!-- basic scripts -->
<!--[if !IE]> -->
<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>--}}
<!-- <![endif]-->

<!--[if IE]>
<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

{{--<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>--}}

<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

