@extends('layouts.app')

@section('content')
    <div class="w-full m-auto ">
        <div class="container flex items-center justify-between px-6 mx-auto border-b">
            <div class="py-3 text-center border-gray-200">
                <h1 class="text-3xl ">
                    Blog Post
                </h1>
            </div>
            @if (Auth::check())
                <div class="py-3 text-center border-gray-200 ">
                    <a class="px-5 py-3 text-xs font-extrabold text-gray-100 uppercase bg-transparent bg-blue-500 rounded-3xl"
                        href="/blog/create">
                        Create Post
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-4/5 pl-2 m-auto mt-10 ">
            <p class="px-4 py-3 mb-4 text-3xl text-center bg-green-500 border-2 border-black w-2/7 text-gray-50 rounded-2xl">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif


    @foreach ($posts as $post)
        <div class="w-4/5 grid-cols-1 gap-20 mx-auto border-b border-gray-200 sm:grid py-15 ">
            <div class="align-middle">
                <img class="align-middle rounded-3xl" src="{{ asset('images/' . $post->image_path) }}" alt="" width=50%>

                <h2 class="pb-4 text-3xl font-bold text-gray-700 ">
                    {{ $post->title }}
                </h2>


                <span class="text-gray-500 ">
                    By <a href=""><span class="italic font-bold text-gray-800 "> {{ $post->user->name }}</span> </a>,
                    Created on {{ date('jS M Y', strtotime($post->created_at)) }}
                </span>

                <p class="pt-8 pb-10 text-xl font-light leading-8 text-gray-700">
                    {{-- {{ $post->description }} --}}
                    {!! html_entity_decode($post->description) !!}
                </p>
                <div class="flex items-end justify-between py-3">

                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                        <span class="float-left ">
                            <form action="/blog/{{ $post->slug }}" method="post">
                                @csrf
                                @method('delete')
                                {{-- <button type="submit"
                                class="px-4 pr-10 text-red-500 hover:font-extrabold hover:underline">Delete Post
                            </button> --}}

                                <div class="text-sm">
                                    <button type="submit"
                                        class="px-4 py-2 font-medium text-red-600 hover:bg-red-400 hover:text-cool-gray-100 rounded-3xl">
                                        Delete </button>
                                </div>
                            </form>
                        </span>

                        <div class="text-sm">
                            <a href=" {{ url('/blog/' . $post->slug . '/edit') }}"
                                class="px-4 py-2 font-medium text-indigo-600 hover:bg-green-400 hover:text-cool-gray-900 rounded-3xl">
                                Edit Post </a>
                        </div>


                        {{-- <span class="float-left ">
                        <a class="px-4 pb-1 italic text-gray-700 bg-green-400 border-b-2 rounded-3xl hover:text-gray-900 hover:bg-blue-400"
                            href="{{ url('/blog/' . $post->slug . '/edit') }}">Edit Post</a>

                    </span> --}}
                    @endif

                    {{-- <a href="/blog/{{ $post->slug }}"
                    class="float-right px-4 py-2 pb-1 font-mono text-lg text-blue-700 uppercase border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl">
                    Keep Reading...
                </a> --}}

                    <div class="text-sm">
                        <a href=" {{ url('/blog/' . $post->slug) }}"
                            class="px-4 py-2 font-medium text-indigo-600 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl">
                            Keeep Reading </a>
                    </div>
                    {{-- /blog/{{ $post->slug }} --}}


                </div>


            </div>
        </div>
    @endforeach
    {{-- <a href="/more"
        class="float-right px-4 py-2 pb-1 font-mono text-lg text-blue-700 uppercase bg-green-400 border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl">
        Next page...
    </a> --}}
    <br>
    <?php echo $posts->render(); ?>
    {{-- {!! $post->render() !!} --}}
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data) {
                $("#tag_container").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>
@endsection
