<div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-calculator blue"></i>Accounting
        </h4>

        <div class="widget-toolbar no-border">
            <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                    <a data-toggle="tab" href="#fee-tab">Fees Collection</a>
                </li>

                <li>
                    <a data-toggle="tab" href="#payroll-tab">Staff Payroll</a>
                </li>

                <li>
                    <a data-toggle="tab" href="#transaction-tab">Transaction</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-4">
            <div class="tab-content padding-8">
                <div id="fee-tab" class="tab-pane active">
                    @include('dashboard.includes.account.fees')
                </div>

                <div id="payroll-tab" class="tab-pane">
                    @include('dashboard.includes.account.payroll')
                </div>

                <div id="transaction-tab" class="tab-pane">
                    @include('dashboard.includes.account.transaction')
                </div><!-- /.#member-tab -->
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.widget-box -->