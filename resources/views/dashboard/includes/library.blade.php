<div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-book blue"></i>Library
        </h4>

        <div class="widget-toolbar no-border">
            <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                    <a data-toggle="tab" href="#issue-tab">Book Issue</a>
                </li>

                <li>
                    <a data-toggle="tab" href="#returnOver-tab">
                        Return Period Over <span class="badge badge-warning"> {{ $data['book_return_over']->count() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-4">
            <div class="tab-content padding-8">
                <div id="issue-tab" class="tab-pane active">
                    @include('dashboard.includes.library.bookissue')
                </div>

                <div id="returnOver-tab" class="tab-pane">
                    @include('dashboard.includes.library.returnover')
                </div>
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.widget-box -->