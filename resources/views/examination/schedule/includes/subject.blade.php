<div class="form-group">
    <table id="subjectsTable" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Sort</th>
            <th width="30%">Subject</th>
            <th>Date</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>FM (T)</th>
            <th>PM (T)</th>
            <th>FM (P)</th>
            <th>PM (P)</th>
            <th></th>
        </tr>
        </thead>

        <tbody id="subject_wrapper">
        {{--@if($schedule)
        @include('examination.schedule.includes.subject_tr_rows')
        @endif--}}
        {{--@if (isset($data['schedule']))

            {!! $data['schedule'] !!}

        @endif--}}

        </tbody>

    </table>
</div>
@include('includes.scripts.inputMask_script')