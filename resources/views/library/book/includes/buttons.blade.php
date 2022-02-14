<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('library/book')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.book') }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Book Detail</a>
        <a class="{!! request()->is('library/book/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.book.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Book</a>
        <a class="{!! request()->is('library/book/import')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.book.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Import</a>
        <a class="{!! request()->is('library/book/category')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.book.category') }}"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Book Category</a>
    </div>
</div>
<hr class="hr-4">