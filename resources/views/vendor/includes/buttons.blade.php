<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left ">
        <a class="{!! request()->is('vendor')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('vendor') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('vendor/registration*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('vendor.registration') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
        <a class="{!! request()->is('vendor/import*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('vendor.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Registration</a>
        <a class="{!! request()->is('vendor/document*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('vendor.document') }}"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;Documents</a>
        <a class="{!! request()->is('vendor/note*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('vendor.note') }}"><i class="fa fa-sticky-note" aria-hidden="true"></i>&nbsp;Notes</a>
    </div>
    <hr class="hr-6 ">
</div>
