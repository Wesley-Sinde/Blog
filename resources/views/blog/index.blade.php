@extends('layouts.app')

@section('content')
    <div class=" w-full m-auto ">
        <div class="border-b  container mx-auto flex justify-between items-center px-6">
            <div class="text-center border-gray-200 py-3">
                <h1 class="text-3xl ">
                    Blog Post
                </h1>
            </div>
            @if (Auth::check())
                <div class=" text-center border-gray-200 py-3">
                    <a class="px-5 py-3 text-xs font-extrabold text-gray-100 uppercase bg-transparent bg-blue-500  rounded-3xl"
                        href="/blog/create">
                        Create Post
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-4/5 pl-2 m-auto mt-10 ">
            <p
                class=" w-2/7 text-3xl text-center border-black border-2 px-4 py-3 mb-4 bg-green-500  text-gray-50 rounded-2xl">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif


    @foreach ($posts as $post)
        <div class="w-4/5 grid-cols-2 gap-20 mx-auto border-b border-gray-200 sm:grid py-15 ">
            <div class="align-middle">
                <img class="align-middle border-2 border-teal-700  rounded-3xl"
                    src="{{ asset('images/' . $post->image_path) }}" alt="" width=100%>
            </div>
            <div>
                <h2 class="pb-4 text-3xl font-bold text-gray-700 ">
                    {{ $post->title }}
                </h2>


                <span class="text-gray-500 ">
                    By <a href=""><span class="italic font-bold text-gray-800 "> {{ $post->user->name }}</span> </a>,
                    Created on {{ date('jS M Y', strtotime($post->created_at)) }}
                </span>

                <p class="pt-8 pb-10 text-xl font-light leading-8 text-gray-700">
                    {{ $post->description }}
                </p>

                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                    <span class=" float-left">
                        <form action="/blog/{{ $post->slug }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class=" px-4 pr-10 text-red-500 hover:font-extrabold hover:underline ">Delete Post</button>
                        </form>
                    </span>
                    <span class=" float-left">
                        <a class=" px-4 rounded-3xl bg-green-400 text-gray-700 italic hover:text-gray-900 hover:bg-blue-400 pb-1 border-b-2"
                            href="/blog/{{ $post->slug }}/edit">Edit Post</a>
                    </span>
                @endif

                <a href="/blog/{{ $post->slug }}"
                    class="pb-1 border-b-2 float-right px-4 py-2 text-lg hover:bg-indigo-300 hover:text-cool-gray-900  font-mono  text-blue-700 uppercase   rounded-3xl">
                    Keep Reading...
                </a>




            </div>
        </div>
    @endforeach
    <a href="/more"
        class=" bg-green-400 pb-1 border-b-2 float-right px-4 py-2 text-lg hover:bg-indigo-300 hover:text-cool-gray-900  font-mono  text-blue-700 uppercase   rounded-3xl">
        Next page...
    </a>

@endsection
