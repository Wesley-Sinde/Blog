<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        @include('includes.validation_error_messages')

        {!! Form::model($data['blank_ins'], ['route' =>'library.issue', 'method' => 'POST', 'class' => 'form-horizontal',
        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
        <input type="hidden" name="member_id" value="{{ $data['student']->id }}">
        <h3>Library Issues</h3>
        @include('library.student.detail.includes.form')

        <div class="clearfix form-actions">
            <div class="col-md-12 align-right">
                <button class="btn btn-info" type="submit">
                    <i class="fa fa-save bigger-110"></i>
                    Issue Books
                </button>
            </div>
        </div>

        <div class="hr hr-24"></div>

        {!! Form::close() !!}

        <div class="hr hr-18 dotted hr-double"></div>

    </div><!-- /.col -->
</div>
