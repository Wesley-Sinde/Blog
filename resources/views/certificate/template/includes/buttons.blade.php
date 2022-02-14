<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('certificate/generate')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.generate') }}"><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;Generate Certificate</a>
        <a class="{!! request()->is('certificate/template')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('certificate.template') }}"><i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;Template Detail</a>
        <a class="{!! request()->is('certificate/template/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('certificate.template.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Template</a>
    </div>
</div>
<hr class="hr-4">