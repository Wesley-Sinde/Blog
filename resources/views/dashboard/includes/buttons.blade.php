<div class="row">
    <div class="col-md-2">
        <a href="{{ route('student') }}" class="easy-link-menu">
            <div class="dash-card card-softred text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['academic_status_count']->sum('total') }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-users"></i> Students</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('staff') }}" class="easy-link-menu">
            <div class="dash-card card-sky text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['staff_status']->sum('total') }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-user-secret"></i> Staff</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('library.book') }}" class="easy-link-menu">
            <div class="dash-card card-green text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['books_status']->sum('total') }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-book"></i> Books</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('exam.schedule') }}" class="easy-link-menu">
            <div class="dash-card card-yellow text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['exams_status'] }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-line-chart"></i> Exams</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('hostel') }}" class="easy-link-menu">
            <div class="dash-card card-red text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['bed_status']->sum('total') }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-bed"></i> HostelBed</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('transport.vehicle') }}" class="easy-link-menu">
            <div class="dash-card card-blue text-xs-center">
                <div class="card-block">
                    <h4 class="card-title">
                        {{ $data['transport_status']->sum('total') }}
                    </h4>
                    <p class="card-text"><i class="ace-icon fa fa-car"></i> Vehicle</p>
                </div>
            </div>
        </a>
    </div>

</div>


