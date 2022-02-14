@if (Auth::check())

    @extends('layouts.app')

    @section('content')
        <div class="w-4/5 m-auto text-left">
            <div class="py-15 b">
                 <h1 class="text-3xl font-extrabold text-blue-900 uppercase font-serif text-center w-2/3">
                    Create Post
                </h1>
            </div>
        </div>

        @if ($errors->any())
            <div class="w-4/5 m-auto ">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="w-1/5 py-4 mb-4 bg-red-700 text-gray-50 rounded-2xl">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-4/5 pt-5 m-auto">
            <form action="/blog" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="text" name="title" id="title" placeholder="Title..."
                    class="block w-full h-20 text-3xl bg-transparent border-b-2 outline-none ">
                <div class="form-group">
                    <label for="description"></label>
                    <textarea id="description" placeholder="Description..." name="description"
                        class="block w-full py-5 text-xl bg-transparent border-b-2 outline-none h-60"></textarea>
                </div>

                <div class="items-center pt-5 bg-gray-lighter">
                    <label
                        class="flex flex-col items-center content-center px-2 py-3 tracking-wide uppercase bg-white border rounded-lg shadow-lg cursor-pointer hover:bg-blue-900 hover:font-extrabold hover:text-gray-100 w-44 border-blue">
                        <span class="mt-2 text-base leading-normal">
                            Select a file
                        </span>
                        <input type="file" name="image" class="hidden ">
                    </label>
                </div>

                <div class=" pb-7">
                    <button type="submit"
                        class="float-right px-8 py-4 mt-8 text-lg font-extrabold text-gray-100 uppercase bg-blue-500 rounded-3xl hover:bg-blue-900 hover:text-xl">
                        Submit Post
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
