@if (Auth::check())

    @extends('layouts.app')

    @section('content')
        <div class="w-full m-auto text-left">
            <div class="py-2 b">
                <h1 class=" align-middle text-3xl float-left font-extrabold text-blue-900 uppercase font-serif text-center w-2/3">
                    Update Post
                </h1>
                <img class="align-middle border-2 h-40 w-40 float-right  border-teal-700  rounded-3xl"
                    src="https://cdn.pixabay.com/photo/2015/08/10/09/50/woman-882568__340.jpg" alt="" width=100%>
            </div>
        </div>

        @if ($errors->any())
            <div class="w-4/5 m-auto ">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="w-1/5 py-4 px-4 mb-4 bg-red-700 text-gray-50 rounded-2xl">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-4/5 pt-5 m-auto">
            <form action="/blog/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="title" id="title" value="{{ $post->title }}"
                    class="block w-full h-20 text-3xl bg-transparent border-b-2 outline-none ">
                <div class="form-group">
                    <label for="description"></label>
                    <textarea id="description" name="description"
                        class="block w-full py-5 text-xl bg-transparent border-b-2 outline-none h-60">{{ $post->description }}</textarea>
                </div>

                {{-- <div class="items-center pt-5 bg-gray-lighter">
                    <label
                        class="flex flex-col items-center content-center px-2 py-3 tracking-wide uppercase bg-white border rounded-lg shadow-lg cursor-pointer hover:bg-blue-900 hover:font-extrabold hover:text-gray-100 w-44 border-blue">
                        <span class="mt-2 text-base leading-normal">
                            Select a file
                        </span>
                        <input type="file" name="image" class="hidden ">
                    </label>
                </div> --}}

                <div class=" pb-7">
                    <button type="submit"
                        class="float-right px-8 py-4 mt-8 text-lg font-extrabold text-gray-100 uppercase bg-blue-500 rounded-3xl hover:bg-blue-900 hover:text-xl">
                        Submit Edit
                    </button>
                </div>
            </form>
        </div>


    @endsection

@else
    <div class="items-center pt-5 bg-gray-lighter">
        <label
            class="flex flex-col items-center content-center px-2 py-3 tracking-wide uppercase bg-white border rounded-lg shadow-lg cursor-pointer hover:bg-blue-900 hover:font-extrabold hover:text-gray-100 w-44 border-blue">
            <span class="mt-2 text-base leading-normal uppercase">
                You are not allowed to access this page
            </span>
        </label>
    </div>
@endif
