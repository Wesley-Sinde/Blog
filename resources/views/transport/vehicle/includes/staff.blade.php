<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th></th>
        </tr>
        </thead>

        <tbody id="staff_wrapper">

        @if (isset($data['html']))

            {!! $data['html'] !!}

        @endif

        </tbody>

    </table>
</div>