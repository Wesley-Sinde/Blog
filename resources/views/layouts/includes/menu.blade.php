<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state hidden-print">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <ul class="nav nav-list">
        {{-- Dashboard --}}
        <li class="{!! request()->is('/')?'active':'' !!}">
            <a href="{{ route('home') }}" >
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
        </li>

        @ability('super-admin','front-office')
            @if( isset($generalSetting) && $generalSetting->front_desk ==1)
                <li class="{!! request()->is('front*')?'active open':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-sign-out" aria-hidden="true"></i>
                    <span class="menu-text">Front Desk</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="{{ route('front.postal-exchange') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Postal Exchange
                        </a>
                    </li>

                    <li class="hover">
                        <a href="{{ route('front.visitor') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visitor Log
                        </a>
                    </li>

                   {{-- <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Inquiry
                        </a>
                    </li>--}}
                </ul>
            </li>
            @endif
        @endability

        {{-- Staff & Student --}}
        @ability('super-admin','student-staff')
            @if( isset($generalSetting) && $generalSetting->student_staff ==1)
                <li class="{!! request()->is('student*')||request()->is('staff*')?'active open':'' !!}  hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users" aria-hidden="true"></i>
                    <span class="menu-text"> Student&Staff</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('student*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Student
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('student')?'active':'' !!} hover">
                                <a href="{{ route('student') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Student Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('student/registration')?'active':'' !!} hover">
                                <a href="{{ route('student.registration') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('student/import')?'active':'' !!} hover">
                                <a href="{{ route('student.import') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Bulk Import
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('student/transfer')?'active':'' !!} hover">
                                <a href="{{ route('student.transfer') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Transfer Student
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('student/document')?'active':'' !!} hover">
                                <a href="{{ route('student.document') }}"  accesskey="U">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Document Upload
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('student/note')?'active':'' !!} hover">
                                <a href="{{ route('student.note') }}">
                                    <i class="menu-icon fa fa-caret-right"  accesskey="N"></i>
                                    Create Notes
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('report/student*')?'active':'' !!} hover">
                                <a href="{{ route('report.student') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Student Complete Records
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('guardian*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Guardian
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('guardian')?'active':'' !!} hover">
                                <a href="{{ route('guardian') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Guardian Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('guardian/registration')?'active':'' !!} hover">
                                <a href="{{ route('guardian.registration') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('staff*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Staff
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('staff')?'active':'' !!}  hover">
                                <a href="{{ route('staff') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Staff Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('staff/add')?'active':'' !!}  hover">
                                <a href="{{ route('staff.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('staff/import')?'active':'' !!} hover">
                                <a href="{{ route('staff.import') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Bulk Import
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('staff/document')?'active':'' !!} hover">
                                <a href="{{ route('staff.document') }}"  accesskey="U">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Document Upload
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('staff/note')?'active':'' !!} hover">
                                <a href="{{ route('staff.note') }}">
                                    <i class="menu-icon fa fa-caret-right"  accesskey="N"></i>
                                    Create Notes
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('staff/designation')?'active':'' !!} hover">
                                <a href="{{ route('staff.designation') }}">
                                    <i class="menu-icon fa fa-caret-right"  accesskey="N"></i>
                                    Designations
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('report/staff*')?'active':'' !!} hover">
                                <a href="{{ route('report.staff') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Staff Complete Records
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Account --}}
        @ability('super-admin','account')
            @if( isset($generalSetting) && $generalSetting->account ==1)
                <li class="{!! request()->is('account/*')?'active open':'' !!}  hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-calculator" aria-hidden="true"></i>
                    <span class="menu-text"> Account</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('account/fees*')?'active open':'' !!} hover">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <i class="fa fa-calculator"></i>  Fees Collection
                                <b class="arrow fa fa-angle-r"></b>
                            </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('account/fees')?'active':'' !!}  hover">
                                <a href="{{ route('account.fees') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Receive Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/quick-receive')?'active':'' !!}  hover">
                                <a href="{{ route('account.fees.quick-receive') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Quick Receive
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/collection')?'active':'' !!} hover">
                                <a href="{{ route('account.fees.collection') }}" accesskey="R">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Collect Fees
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/balance')?'active':'' !!}  hover">
                                <a href="{{ route('account.fees.balance') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Balance Fees Report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/master/add')?'active':'' !!} hover">
                                <a href="{{ route('account.fees.master.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add Fees
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/online-payment')?'active':'' !!} hover">
                                <a href="{{ route('account.fees.online-payment') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Online Payments
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/fees/head')?'active':'' !!}  hover">
                                <a href="{{ route('account.fees.head') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Fees Head
                                </a>
                                <b class="arrow"></b>
                            </li>

                            </ul>
                    </li>

                    <li class="{!! request()->is('account.transaction*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <i class="fa fa-newspaper-o"></i> Ledger & Transaction
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('account/transaction/add')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction.add') }}">
                                    <i class="menu-icon fa fa-plus"></i>
                                    Transaction
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/transaction/multi-add')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction.multi-add') }}">
                                    <i class="menu-icon fa fa-plus"></i>
                                    Multi Transaction
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/transaction')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction') }}" accesskey="R">
                                    <i class="menu-icon fa fa-list"></i>
                                    Transaction Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/transfer')?'active':'' !!} hover">
                                <a href="{{ route('account.transfer') }}">
                                    <i class="menu-icon fa fa-exchange"></i>
                                    Acc to Acc Transfer
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/transaction-head')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction-head') }}">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Ledger/Account
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/transaction/account-group')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction.account-group') }}">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Account Groups
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('account/transaction/account-group/chart-of-account')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction.account-group.chart-of-account') }}">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Charts of Account
                                </a>
                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('account/bank*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <i class="fa fa-bank"></i> Separate Banking
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('account/bank')?'active':'' !!} hover">
                                <a href="{{ route('account.bank') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Manage Bank Accounts
                                </a>
                            </li>
                            <li class="{!! request()->is('account/bank/add')?'active':'' !!} hover">
                                <a href="{{ route('account.bank.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add New Bank
                                </a>
                            </li>

                            <li class="{!! request()->is('account/bank-transaction')?'active':'' !!} hover">
                                <a href="{{ route('account.bank-transaction') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Transaction Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/bank-transaction/add')?'active':'' !!} hover">
                                <a href="{{ route('account.bank-transaction.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    New Transaction
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('account/payroll*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <i class="fa fa-user-secret"></i>  Payroll
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('account/payroll')?'active':'' !!}  hover">
                                <a href="{{ route('account.payroll') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Paid Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/salary/payment')?'active':'' !!} hover">
                                <a href="{{ route('account.salary.payment') }}" accesskey="R">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Salary Pay
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/payroll/master*')?'active':'' !!} hover">
                                <a href="{{ route('account.payroll.master.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add Payroll
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/payroll/balance')?'active':'' !!}  hover">
                                <a href="{{ route('account.payroll.balance') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Balance Salary Report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('account/payroll/head')?'active':'' !!}  hover">
                                <a href="{{ route('account.payroll.head') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Salary Head
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('account/report*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <i class="fa fa-print"></i> Account Report
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('account/report/cash-book*')?'active':'' !!} hover">
                                <a href="{{ route('account.report.cash-book') }}">
                                    <i class="menu-icon fa fa-rupee"></i>
                                    Cash Book
                                </a>
                            </li>

                            <li class="{!! request()->is('account/report/fee-collection')?'active':'' !!} hover">
                                <a href="{{ route('account.report.fee-collection') }}">
                                    <i class="menu-icon fa fa-calculator"></i>
                                    Fee Collection
                                </a>
                            </li>

                            <li class="{!! request()->is('account/report/fee-online-payment')?'active':'' !!} hover">
                                <a href="{{ route('account.report.fee-online-payment') }}">
                                    <i class="menu-icon fa fa-globe"></i>
                                    Online Payments
                                </a>
                            </li>

                            <li class="{!! request()->is('account/report/fee-collection-head*')?'active':'' !!} hover">
                                <a href="{{ route('account.report.fee-collection-head') }}">
                                    <i class="menu-icon fa fa-calculator"></i>
                                    Fee Collection Head
                                </a>
                            </li>

                            <li class="{!! request()->is('account/report/balance-fee*')?'active':'' !!} hover">
                                <a href="{{ route('account.report.balance-fee') }}">
                                    <i class="menu-icon fa fa-calculator"></i>
                                    Fee Balance
                                </a>
                            </li>

                            <li class="{!! request()->is('account/transaction-head/view*')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction-head.view') }}">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Statement of Ledger
                                </a>
                            </li>
                            <li class="{!! request()->is('account/transaction-head/balance-statement*')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction-head.balance-statement') }}" accesskey="B">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Ledger Balance
                                </a>
                            </li>

                            <li class="{!! request()->is('account/transaction/account-group/chart-of-account')?'active':'' !!} hover">
                                <a href="{{ route('account.transaction.account-group.chart-of-account') }}">
                                    <i class="menu-icon fa fa-newspaper-o"></i>
                                    Charts of Account
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            @endif
        @endability

        @ability('super-admin','inventory')
            @if( isset($generalSetting) && $generalSetting->inventory ==1)
                <li class="{!! request()->is('inventory*') || request()->is('product*') || request()->is('customer*') || request()->is('vendor*') ?'active open':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-shopping-cart"></i>
                    Inventory
                    <b class="arrow fa fa-angle-r"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="{!! request()->is('inventory/assets*') || request()->is('inventory/sem-assets*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <i class="fa fa-store"></i> Class Assets
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('inventory/assets')?'active':'' !!} hover">
                                <a href="{{ route('inventory.assets') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Assets
                                </a>
                            </li>
                            <li class="{!! request()->is('inventory/sem-assets')?'active':'' !!} hover">
                                <a href="{{ route('inventory.sem-assets') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Faculty/Sem Assets
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('product*')?'active open':'' !!}  hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <span class="menu-text">Product/Assets</span>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('product/registration*')?'active':'' !!} hover">
                                <a href="{{ route('product.registration') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <i class="fa fa-plus"></i> Product
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('product')?'active':'' !!} hover">
                                <a href="{{ route('product') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <i class="fa fa-list"></i> Product Detail
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('product/category*')?'active':'' !!} hover">
                                <a href="{{ route('product.category') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <i class="fa fa-list-alt"></i> Category
                                </a>
                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('customer*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Customer
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('customer')?'active':'' !!} hover">
                                <a href="{{ route('customer') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Customer Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('customer/registration')?'active':'' !!} hover">
                                <a href="{{ route('customer.registration') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('customer/document')?'active':'' !!} hover">
                                <a href="{{ route('customer.document') }}"  accesskey="U">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Document Upload
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('customer/note')?'active':'' !!} hover">
                                <a href="{{ route('customer.note') }}">
                                    <i class="menu-icon fa fa-caret-right"  accesskey="N"></i>
                                    Create Notes
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('vendor*')?'active open':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Vendor
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('vendor')?'active':'' !!} hover">
                                <a href="{{ route('vendor') }}" accesskey="S">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Vendor Detail
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('vendor/registration')?'active':'' !!} hover">
                                <a href="{{ route('vendor.registration') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('vendor/document')?'active':'' !!} hover">
                                <a href="{{ route('vendor.document') }}"  accesskey="U">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Document Upload
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('vendor/note')?'active':'' !!} hover">
                                <a href="{{ route('vendor.note') }}">
                                    <i class="menu-icon fa fa-caret-right"  accesskey="N"></i>
                                    Create Notes
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                   {{-- <li class="{!! request()->is('vendor')?'active':'' !!} hover">
                        <a href="{{ route('vendor') }}" accesskey="S">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Vendor Detail
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('vendor/registration')?'active':'' !!} hover">
                        <a href="{{ route('vendor.registration') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Registration
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('customer')?'active':'' !!} hover">
                        <a href="{{ route('customer') }}" accesskey="S">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Customer Detail
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('customer/registration')?'active':'' !!} hover">
                        <a href="{{ route('customer.registration') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Registration
                        </a>

                        <b class="arrow"></b>
                    </li>--}}

                </ul>
            </li>
            @endif
        @endability

        {{-- Library --}}
        @ability('super-admin','library')
            @if( isset($generalSetting) && $generalSetting->library ==1)
                <li class="{!! request()->is('library*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-book" aria-hidden="true"></i>
                    <span class="menu-text">Library</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('library/book*')?'active':'' !!} hover">
                        <a href="{{ route('library.book') }}" accesskey="L" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Books
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('library/member*')?'active':'' !!} hover">
                                <a href="{{ route('library.book') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Book Detail
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('library/book/add*')?'active':'' !!} hover">
                                <a href="{{ route('library.book.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                   Add New
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('library/book/import*')?'active':'' !!} hover">
                                <a href="{{ route('library.book.import') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Bulk Import
                                </a>

                                <b class="arrow"></b>
                            </li>


                            <li class="{!! request()->is('library/book/category*')?'active':'' !!} hover">
                                <a href="{{ route('library.book.category') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                   Category
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('library/member*') || request()->is('library/student*') || request()->is('library/staff*') ?'active':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Members
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('library/member*')?'active':'' !!} hover">
                                <a href="{{ route('library.member') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Membership
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('library/student*')?'active':'' !!} hover">
                                <a href="{{ route('library.student') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Student Member
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('library/staff*')?'active':'' !!} hover">
                                <a href="{{ route('library.staff') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Staff Member
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                    <li class="{!! request()->is('library/issue-history*')?'active':'' !!} hover">
                        <a href="{{ route('library.issue-history') }}">
                            <i class="menu-icon fa fa-history"></i>
                            Issue History
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('library/return-over*')?'active':'' !!} hover">
                        <a href="{{ route('library.return-over') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Return Period Over
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('library/circulation*')?'active':'' !!}  hover">
                        <a href="{{ route('library.circulation') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Circulation Setting
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Attendance --}}
        @ability('super-admin','attendance')
            @if( isset($generalSetting) && $generalSetting->attendance ==1)
                <li class="{!! request()->is('attendance*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
                    <span class="menu-text"> Attendance</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">


                    <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Student Attendance
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('attendance/student*')?'active':'' !!} hover">
                                <a href="{{ route('attendance.student') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Regular Attendance
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('attendance/subject*')?'active':'' !!} hover">
                                <a href="{{ route('attendance.subject') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Subject Wise Attendance
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('attendance/staff*')?'active':'' !!} hover">
                        <a href="{{ route('attendance.staff') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Staff Attendance
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('attendance/master*')?'active':'' !!} hover">
                        <a href="{{ route('attendance.master') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Monthly Calendar
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            @endif
        @endability


        @ability('super-admin','examination')
            @if( isset($generalSetting) && $generalSetting->exam == 1)
                <li class="{!! request()->is('exam*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-line-chart"  aria-hidden="true"></i>
                    <span class="menu-text"> Exam</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('exam/schedule*')?'active':'' !!} hover">
                        <a href="{{ route('exam.schedule') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Schedule Exam
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('exam/mark-ledger')?'active':'' !!}  hover">
                        <a href="{{ route('exam.mark-ledger') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mark Ledger
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('exam')?'active':'' !!} hover">
                        <a href="{{ route('exam') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Exams Head
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('exam/admit-card*')?'active':'' !!} hover">
                        <a href="{{ route('exam.admit-card') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Admit Card
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="{!! request()->is('exam/routine*')?'active':'' !!} hover">
                        <a href="{{ route('exam.routine') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Routine/Schedule
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="{!! request()->is('exam/mark-sheet*')?'active':'' !!} hover">
                        <a href="{{ route('exam.mark-sheet') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Grade/Mark/Ledger Sheet
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Examination --}}
        @ability('super-admin','certificate')
            @if( isset($generalSetting) && $generalSetting->certificate ==1)
                <li class="{!! request()->is('certificate*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-certificate"  aria-hidden="true"></i>
                    <span class="menu-text"> Certificate</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('certificate/issue')?'active':'' !!} hover">
                        <a href="{{ route('certificate.issue') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Issue Certificate
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/attendance*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.attendance') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Attendance Certificate
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/transfer*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.transfer') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transfer Certificate
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/character*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.character') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Character Certificate
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/bonafide*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.bonafide') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Bonafide Certificate
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/course-completion*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.course-completion') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Course Completion Cer.
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/issue-history*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.issue-history') }}">
                            <i class="menu-icon fa fa-history"></i>
                            Issue History
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="{!! request()->is('certificate/generate*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.generate') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Custom Print
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="{!! request()->is('certificate/template*')?'active':'' !!} hover">
                        <a href="{{ route('certificate.template') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Certificate Template
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Hostel --}}
        @ability('super-admin','hostel')
            @if( isset($generalSetting) && $generalSetting->hostel ==1)
                <li class="{!! request()->is('hostel*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-bed" aria-hidden="true"></i>
                    <span class="menu-text"> Hostels </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="{!! request()->is('hostel/resident*')?'active':'' !!} hover">
                        <a href="{{ route('hostel.resident') }}" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Resident
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('hostel/resident')?'active':'' !!} hover">
                                <a href="{{ route('hostel.resident') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Detail
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('hostel/resident/add')?'active':'' !!} hover">
                                <a href="{{ route('hostel.resident.add') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Registration
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('hostel/resident/history')?'active':'' !!} hover">
                                <a href="{{ route('hostel.resident.history') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Occupant History
                                </a>
                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>
                    <li class="{!! request()->is('hostel') || request()->is('hostel/room-type')?'active':'' !!} hover">
                        <a href="{{ route('hostel') }}" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Hostel
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">

                            <li class="{!! request()->is('hostel*')?'active':'' !!} hover">
                                <a href="{{ route('hostel') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Hostel
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('hostel/room-type*')?'active':'' !!} hover">
                                <a href="{{ route('hostel.room-type') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Room Type
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('hostel/food*')?'active':'' !!} hover">
                        <a href="{{ route('hostel') }}" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Food & Meal
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('hostel/food*')?'active':'' !!} hover">
                                <a href="{{ route('hostel.food') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Meal Schedule
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('hostel/food/eating-time*')?'active':'' !!} hover">
                                <a href="{{ route('hostel.food.eating-time') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Eating Time
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('hostel/food/category*')?'active':'' !!} hover">
                                <a href="{{ route('hostel.food.category') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Food Category
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('hostel/food/item*')?'active':'' !!} hover">
                                <a href="{{ route('hostel.food.item') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Food Item
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Transport --}}
        @ability('super-admin','transport')
            @if( isset($generalSetting) && $generalSetting->transport ==1)
                <li class="{!! request()->is('transport*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-bus" aria-hidden="true"></i>
                    <span class="menu-text"> Transport </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                 <ul class="submenu">
                     <li class="{!! request()->is('transport/user*')?'active':'' !!} hover">
                         <a href="{{ route('transport.user') }}" class="dropdown-toggle">
                             <i class="menu-icon fa fa-caret-right"></i>
                             Traveller/User
                             <b class="arrow fa fa-angle-r"></b>
                         </a>
                         <b class="arrow"></b>
                         <ul class="submenu">
                             <li class="{!! request()->is('transport/user')?'active':'' !!} hover">
                                 <a href="{{ route('transport.user') }}">
                                     <i class="menu-icon fa fa-caret-right"></i>
                                     Detail
                                 </a>
                                 <b class="arrow"></b>
                             </li>
                             <li class="{!! request()->is('transport/user/add')?'active':'' !!} hover">
                                 <a href="{{ route('transport.user.add') }}">
                                     <i class="menu-icon fa fa-caret-right"></i>
                                     Registration
                                 </a>
                                 <b class="arrow"></b>
                             </li>

                             <li class="{!! request()->is('transport/user/history')?'active':'' !!} hover">
                                 <a href="{{ route('transport.user.history') }}">
                                     <i class="menu-icon fa fa-caret-right"></i>
                                     User History
                                 </a>
                                 <b class="arrow"></b>
                             </li>

                         </ul>
                     </li>
                     <li class="{!! request()->is('transport/route*')?'active':'' !!} hover">
                         <a href="{{ route('transport.route') }}">
                             <i class="menu-icon fa fa-caret-right"></i>
                             Route
                             <b class="arrow fa fa-angle-r"></b>
                         </a>
                         <b class="arrow"></b>
                     </li>

                     <li class="{!! request()->is('transport/vehicle*')?'active':'' !!} hover">
                         <a href="{{ route('transport.vehicle') }}">
                             <i class="menu-icon fa fa-caret-right"></i>
                             Vehicle
                             <b class="arrow fa fa-angle-r"></b>
                         </a>
                         <b class="arrow"></b>
                     </li>

                 </ul>
            </li>
            @endif
        @endability

        {{-- More --}}
       {{-- @ability('super-admin','assignment,download,meeting')
            <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-th-list" aria-hidden="true"></i>
                    <span class="menu-text"> More </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    @ability('super-admin','assignment')
                        @if( isset($generalSetting) && $generalSetting->assignment ==1)
                            <li class="{!! request()->is('assignment')?'active':'' !!} hover">
                            <a href="{{ route('assignment') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Assignment
                            </a>
                            <b class="arrow"></b>
                        </li>
                        @endif
                    @endability

                    @ability('super-admin','download')
                        @if( isset($generalSetting) && $generalSetting->upload_download ==1)
                            <li class="{!! request()->is('download*')?'active':'' !!} hover">
                            <a href="{{ route('download') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Upload & Download
                                <b class="arrow fa fa-angle-r"></b>
                            </a>
                        </li>
                        @endif
                    @endability

                    @ability('super-admin','meeting')
                    @if( isset($generalSetting) && $generalSetting->meeting ==1)
                        <li class="{!! request()->is('meeting*')?'active':'' !!} hover">
                            <a href="{{ route('meeting') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Meeting - Remote Class
                                <b class="arrow fa fa-angle-r"></b>
                            </a>
                        </li>
                    @endif
                    @endability
                </ul>
            </li>
        @endability--}}

        @ability('super-admin','assignment')
        @if( isset($generalSetting) && $generalSetting->assignment ==1)
            <li class="{!! request()->is('assignment')?'active':'' !!} hover">
                <a href="{{ route('assignment') }}">
                    <i class="menu-icon fa fa-tasks"></i>
                    Assignment
                </a>
                <b class="arrow"></b>
            </li>
        @endif
        @endability

        @ability('super-admin','download')
        @if( isset($generalSetting) && $generalSetting->upload_download ==1)
            <li class="{!! request()->is('download*')?'active':'' !!} hover">
                <a href="{{ route('download') }}">
                    <i class="menu-icon fa fa-download"></i>
                    Download
                    <b class="arrow fa fa-angle-r"></b>
                </a>
            </li>
        @endif
        @endability

        @ability('super-admin','meeting')
        @if( isset($generalSetting) && $generalSetting->meeting ==1)
            <li class="{!! request()->is('meeting*')?'active':'' !!} hover">
                <a href="{{ route('meeting') }}">
                    <i class="menu-icon fa fa-video-camera"></i>
                    Meeting
                    <b class="arrow fa fa-angle-r"></b>
                </a>
            </li>
        @endif
        @endability


        {{-- Reports --}}
        @ability('super-admin','report')
        {{--<li class="{!! request()->is('report*')?'active':'' !!} hover">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-bar-chart"  aria-hidden="true"></i>
                <span class="menu-text"> Report Links</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="{!! request()->is('report/student*')?'active':'' !!} hover">
                    <a href="{{ route('report.student') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Student Detail
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="{!! request()->is('report/staff*')?'active':'' !!} hover">
                    <a href="{{ route('report.staff') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Staff Detail
                    </a>

                    <b class="arrow"></b>
                </li>
                @ability('super-admin','fees-index')
                <li class="{!! request()->is('account/fees')?'active':'' !!} hover">
                    <a href="{{ route('account.fees') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fees Statement
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','fees-balance')
                <li class="{!! request()->is('account/fees/balance')?'active':'' !!} hover">
                    <a href="{{ route('account.fees.balance') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Balance Fees
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','payroll-balance')
                <li class="{!! request()->is('account/payroll/balance')?'active':'' !!} hover">
                    <a href="{{ route('account.payroll.balance') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Balance Salary
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','transaction-head-index')
                <li class="{!! request()->is('account/transaction-head')?'active':'' !!} hover">
                    <a href="{{ route('account.transaction-head') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Ledger
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','transaction-index')
                <li class="{!! request()->is('account/transaction')?'active':'' !!} hover">
                    <a href="{{ route('account.transaction') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Transactions
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','bank-index')
                <li class="{!! request()->is('account/bank')?'active':'' !!} hover">
                    <a href="{{ route('account.bank') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bank Statement
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','library-issue-history')
                <li class="{!! request()->is('library/issue-history')?'active':'' !!} hover">
                    <a href="{{ route('library.issue-history') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Library Issue History
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','library-return-over')
                <li class="{!! request()->is('library/return-over')?'active':'' !!} hover">
                    <a href="{{ route('library.return-over') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Book Return Period Over
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','student-attendance-index')
                <li class="{!! request()->is('attendance/student')?'active':'' !!} hover">
                    <a href="{{ route('attendance.student') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Student Attendance
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','staff-attendance-index')
                <li class="{!! request()->is('attendance/staff')?'active':'' !!} hover">
                    <a href="{{ route('attendance.staff') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Staff Attendance
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','resident-history')
                <li class="{!! request()->is('hostel/resident/history')?'active':'' !!} hover">
                    <a href="{{ route('hostel.resident.history') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Hostel History
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability

                @ability('super-admin','transport-user-history')
                <li class="{!! request()->is('transport/user/history')?'active':'' !!} hover">
                    <a href="{{ route('transport.user.history') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Transport History
                    </a>
                    <b class="arrow"></b>
                </li>
                @endability
            </ul>
        </li>--}}
        @endability

        {{-- Info Center --}}
        @ability('super-admin','alert-center')
            @if( isset($generalSetting) && $generalSetting->alert ==1)
                <li class="{!! request()->is('info*')?'active':'' !!} hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-bullhorn" aria-hidden="true"></i>
                    <span class="menu-text"> Alert </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="{!! request()->is('info/notice*')?'active':'' !!} hover">
                        <a href="{{ route('info.notice') }}" accesskey="L">
                            <i class="menu-icon fa fa-caret-right"></i>
                            User Notice
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="{!! request()->is('info/smsemail*')?'active':'' !!} hover">
                        <a href="{{ route('info.smsemail') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            SMS / E-mail
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            @endif
        @endability

        {{-- Academic --}}
        @ability('super-admin','academic')
            @if( isset($generalSetting) && $generalSetting->academic ==1)
                <li class="hover">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-graduation-cap" aria-hidden="true"></i>
                    <span class="menu-text"> Academics </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="{!! request()->is('faculty*') || request()->is('semester*')?'active':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Academic Level
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('faculty*')?'active':'' !!} hover">
                                <a href="{{ route('faculty') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Faculty/Level/Class
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('semester*')?'active':'' !!} hover">
                                <a href="{{ route('semester') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Semester/Section
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('student-batch*')?'active':'' !!} hover">
                                <a href="{{ route('student-batch') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Batch
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <li class="{!! request()->is('grading*') || request()->is('subject*')?'active':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Grading/Subject
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('grading*')?'active':'' !!} hover">
                                <a href="{{ route('grading') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Grading
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('subject*')?'active':'' !!} hover">
                                <a href="{{ route('subject') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Course / Subject
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="{!! request()->is('*status')?'active':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Status Setting
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('student-status*')?'active':'' !!} hover">
                                <a href="{{ route('student-status') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Student Status
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('attendance-status*')?'active':'' !!} hover">
                                <a href="{{ route('attendance-status') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Attendance Status
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('book-status*')?'active':'' !!} hover">
                                <a href="{{ route('book-status') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Books Status
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="{!! request()->is('bed-status*')?'active':'' !!} hover">
                                <a href="{{ route('bed-status') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Hostel Bed Status
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('customer-status*')?'active':'' !!} hover">
                                <a href="{{ route('customer-status') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Customer Status
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>


                    <li class="{!! request()->is('year*') || request()->is('month*')?'active':'' !!} hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Year & Month
                            <b class="arrow fa fa-angle-r"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="{!! request()->is('year*')?'active':'' !!} hover">
                                <a href="{{ route('year') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Year
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('month*')?'active':'' !!} hover">
                                <a href="{{ route('month') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Month
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="{!! request()->is('day*')?'active':'' !!} hover">
                                <a href="{{ route('day') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Day
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    <li class="{!! request()->is('payment-method*')?'active':'' !!} hover">
                        <a href="{{ route('payment-method') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Payment Methods
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endif
        @endability

        {{-- Help --}}
        @ability('super-admin','help')
            @if( isset($generalSetting) && $generalSetting->help ==1)
                <li class="hover">
                <a href="#" target="_blank" class="dropdown-toggle">
                    <i class="menu-icon  fa fa-question" aria-hidden="true"></i>
                    <span class="menu-text"> Help </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="http://unlimitededufirm.com/demo-detail" target="_blank">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Test Demo
                        </a>
                    </li>
                    <li class="hover">
                        <a href="https://www.youtube.com/watch?v=2jgA9WY8IzQ&list=PLCtD_CGPAQJ2zSk5cDUkkfWGdtMGsF9n0" target="_blank">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Video Tutorial
                        </a>
                    </li>
                    <li class="hover">
                        <a href="http://docs.unlimitededufirm.com" target="_blank">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Documentation
                        </a>
                    </li>
                    <li class="hover">
                        <a href="https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988" target="_blank">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Buy New License
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        @endability
    </ul><!-- /.nav-list -->
</div>
