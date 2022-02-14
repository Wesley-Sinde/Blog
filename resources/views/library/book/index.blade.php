@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('library.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')

                        @include($view_path.'.includes.buttons')

                        @include($view_path.'.includes.search_form')
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                @include($view_path.'.includes.table')
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            /*Show Filter Form*/
           /* $("#filterDiv").css({'display':'none'});
            $("#filterBox").hover(function(){
                $("#filterDiv").css({'display':'block'});

            });*/
            /*filter form end*/


            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var isbn_number = $('input[name="isbn_number"]').val();
                var code = $('input[name="code"]').val();
                var categories = $('select[name="categories"]').val();
                var title = $('input[name="title"]').val();
                var author = $('input[name="author"]').val();
                var language = $('input[name="language"]').val();
                var publisher = $('input[name="publisher"]').val();
                var publish_year = $('input[name="publish_year"]').val();
                var edition = $('input[name="edition"]').val();
                var edition_year = $('input[name="edition_year"]').val();
                var series = $('input[name="series"]').val();
                var rack_location = $('input[name="rack_location"]').val();
                var source = $('input[name="source"]').val();

                if (isbn_number !== '') {
                    url += '?isbn_number=' + isbn_number;
                    flag = true;
                }

                if (code !== '') {

                    if (flag) {

                        url += '&code=' + code;

                    } else {

                        url += '?code=' + code;
                        flag = true;

                    }
                }

                if (categories !== '' & categories >0) {

                    if (flag) {

                        url += '&categories=' + categories;

                    } else {

                        url += '?categories=' + categories;
                        flag = true;

                    }
                }

                if (title !== '') {

                    if (flag) {

                        url += '&title=' + title;

                    } else {

                        url += '?title=' + title;
                        flag = true;

                    }
                }

                if (author !== '') {

                    if (flag) {

                        url += '&author=' + author;

                    } else {

                        url += '?author=' + author;
                        flag = true;

                    }
                }

                if (language !== '') {

                    if (flag) {

                        url += '&language=' + language;

                    } else {

                        url += '?language=' + language;
                        flag = true;

                    }
                }

                if (publisher !== '') {

                    if (flag) {

                        url += '&publisher=' + publisher;

                    } else {

                        url += '?publisher=' + publisher;
                        flag = true;

                    }
                }

                if (publish_year !== '') {

                    if (flag) {

                        url += '&publish_year=' + publish_year;

                    } else {

                        url += '?publish_year=' + publish_year;
                        flag = true;

                    }
                }

                if (edition !== '') {

                    if (flag) {

                        url += '&edition=' + edition;

                    } else {

                        url += '?edition=' + edition;
                        flag = true;

                    }
                }

                if (edition_year !== '') {

                    if (flag) {

                        url += '&edition_year=' + edition_year;

                    } else {

                        url += '?edition_year=' + edition_year;
                        flag = true;

                    }
                }

                if (series !== '') {

                    if (flag) {

                        url += '&series=' + series;

                    } else {

                        url += '?series=' + series;
                        flag = true;

                    }
                }

                if (rack_location !== '') {

                    if (flag) {

                        url += '&rack_location=' + rack_location;

                    } else {

                        url += '?rack_location=' + rack_location;
                        flag = true;

                    }
                }

                location.href = url;

            });


        });



    </script>
@endsection