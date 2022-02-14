<tr class="option_value">
    <td>

        <input type="hidden" name="master_id[]" value="{{ $books->id }}">
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $books->title }}</div>

        <div class="col-xs-12 col-sm-3 center">
           <span class="profile-picture">
                @if($books->image != '')
                   <img id="avatar" class="editable img-responsive" alt="{{ $books->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$books->image) }}" />
               @else
                   <img id="avatar" class="editable img-responsive" alt="{{ $books->title }}" src="{{ asset('assets/images/avatars/book.png') }}" />
               @endif

            </span>
            <div class="space-6"></div>

        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="space-6"></div>
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> Book Code: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->code }}</span>
                    </div>

                    <div class="profile-info-name"> Book Category: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ ViewHelper::getBookCategoryById($books->categories) }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Author: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->author }}</span>
                    </div>

                    <div class="profile-info-name"> Publisher: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->publisher }}</span>
                    </div>

                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Edition: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->edition }}</span>
                    </div>

                    <div class="profile-info-name">Rack Location: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->rack_location }}</span>
                    </div>

                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> Quantity: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->bookCollection()->count() }}</span>
                    </div>

                    <div class="profile-info-name"> Available: </div>
                    <div class="profile-info-value">
                        <span class="editable" id="reg_no">{{ $books->bookCollection()->where('book_status','=',1)->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 center">
                <div class="space-8"></div>
                <div class="form-group">
                    {!! Form::Label('book_id', 'Available Copies', ['class' => 'col-sm-3 control-label', "required"]) !!}
                    {{--<select class="col-xs-10 col-sm-5 chosen-select" name="book_id[]">
                        <option value="0" >Choose Copies Code</option>
                        @foreach($books->bookCollection()->where('book_status','=',1)->get() as $available)
                            <option value="{{$available->id}}" >{{$available->book_code}}</option>
                        @endforeach
                        @include('includes.form_fields_validation_message', ['name' => 'book_id'])
                    </select>--}}
                    @php($availableCopies = $books->bookCollection()->where('book_status','=',1)->get()->pluck('book_code','id')->toArray())
                    {!! Form::select('book_id[]', $availableCopies, null, ['class' => 'form-control chosen-select', 'required']) !!}
                </div>
            </div>
        </div>


    </td>
    <td width="10%">
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>

    </td>
</tr>

<script>
    if(!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect:true});
        //resize the chosen on window resize
        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
    }
</script>