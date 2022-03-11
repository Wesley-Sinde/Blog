    @extends('layouts.app')

    @section('content')
       <div class="w-4/5 grid-cols-1 gap-20 mx-auto border-b border-gray-200 sm:grid py-15 ">
            <div class="align-middle">
                <img class="align-middle   rounded-3xl"
                    src="{{ asset('images/' . $post->image_path) }}" alt="" width=50%>
            {{-- </div>
            <div> --}}
                <h2 class="pb-4 text-3xl font-bold text-gray-700 ">
                    {{ $post->title }}
                </h2>


                <span class="text-gray-500 ">
                    By <a href=""><span class="italic font-bold text-gray-800 "> {{ $post->user->name }}</span> </a>,
                    Created on {{ date('jS M Y', strtotime($post->created_at)) }}
                </span>

                <p class="pt-8 pb-10 text-xl font-light leading-8 text-gray-700">
                    {{-- {{ $post->description }} --}}
                    {!!html_entity_decode($post->description)!!}
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


    @endsection
