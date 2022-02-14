<h4 class="header large lighter blue"><i class="fa fa-university" aria-hidden="true"></i>Academic Info</h4>

<div class="form-group">
    <table id="responsive" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th width="10%">Sort</th>
                <th width="80%">Detail</th>
                <th width="10%">
                    <button type="button" class="btn btn-xs btn-primary pull-right" id="load-academicinfo-html">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Academic Info
                    </button>
                </th>
            </tr>
        </thead>

        <tbody id="academicInfo_wrapper">

        @if (isset($data['academicInfo-html']))
            {!! $data['academicInfo-html'] !!}
        @endif

        </tbody>

    </table>
</div>


