<div class="form-group">
    <div class="col-sm-12">
        {!! Form::select('book_id', [], null, ["placeholder" => "Type Book Name...", "class" => "col-xs-12 col-sm-12", "style" => "width: 100%;"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'book_id'])

        <hr>
        <div class="align-right">
            <button type="button" class="btn btn-sm btn-primary" id="load-html-btn">
                <i class="fa fa-plus bigger-120"></i>Add on Issue List
            </button>
        </div>
    </div>
</div>

<div class="space-4"></div>

<!-- Option Values -->
@include('library.staff.detail.includes.book_detail')


