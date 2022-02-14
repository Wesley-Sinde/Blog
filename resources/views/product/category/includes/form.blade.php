<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ["placeholder" => "e.g. Printer", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>
                <button type="button" class="btn btn-xs btn-primary pull-right align-right" id="load-cat-html">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                </button>
            </th>
        </tr>
        </thead>

        <tbody id="grade_wrapper">

        @if (isset($data['row']))

            @foreach($data['sub_category'] as $sub_category)

                @include($view_path.'.includes.subcat_tr_edit', ['attribute_groups' => $data['sub_category'],'attribute' => $sub_category])

            @endforeach

        @endif

        </tbody>

    </table>
</div>