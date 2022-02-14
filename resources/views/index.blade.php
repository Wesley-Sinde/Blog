@extends('layouts.app')
@section('content')

    <div class="background-image grid grid-cols-1 m-auto">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-2xl uppercase font-bold text-shadow-md pb-14 sm:text-5xl">
                    Do you want be accommodated? 
                </h1>
                <a href="" class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xs sm:text-xl uppercase">
                    Yes i want to rent a house...
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-10  w-4/5 mx-auto py-15 border-gray-200 ">
        <div>
            <img src="https://cdn.pixabay.com/photo/2015/05/31/12/11/break-791434__340.jpg" alt="" width=100%>
        </div>
        <div class="m-auto sm:m-auto text-left w-4/5 block" style="padding-left: 2%">
            <h2 class="text-3xl font-extrabold text-gray-600">
                Struggling tobe a better web developer
            </h2>
            <p class="py-8 text-gray-500 text-s">
                If you do not specify which services you would like configured, a default stack of mysql, redis,
                meilisearch, mailhog, and selenium will be configured.
            </p>
            <p class="font-extrabold text-gray-600 text-s pb-9">
                If your computer already has PHP and Composer installed, you may create a new Laravel project by using
                Composer directly. After the application has been created, you may start Laravel's local development server
                using the Artisan CLI's serve command.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla doloremque reprehenderit ex est sunt! Dicta
                nihil omnis tempora quidem aut sequi, enim eligendi provident, placeat quis quia fugit quaerat ullam!
            </p>
            <a class="uppercase bg-blue-500 text-gray-100 text-s font-extrabold py-3 px-8 rounded-3xl" href="/blog">
                Find out more
            </a>
        </div>
    </div>
    <div class="text-center p-15 bg-black text-white">
        <h2 class="text-2xl pb-5 text-l">
            I'm an expert in...
        </h2>
        <span class="font-extrabold block text-4xl py-1">
            Ux Design
        </span><span class="font-extrabold block text-4xl py-1">
            Project Management
        </span><span class="font-extrabold block text-4xl py-1">
            Digital Strategy
        </span><span class="font-extrabold block text-4xl py-1">
            Backend Development
        </span>
    </div>

    <div class="text-center py-15 ">
        <span class="uppercase text-s text-gray-400">
            Blog
        </span>
        <h2 class="text-4xl font-bold py-10">
            Recent Posts
        </h2>
        <p class="m-auto w-4/5 text-gray-500">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore doloremque magni mollitia voluptate dolorum
            expedita sed maxime sit impedit dolore, tenetur hic, dolorem dicta illo, sunt eligendi nulla nostrum animi.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem quisquam quidem in voluptatum doloribus
            saepe aperiam, tempore debitis eius repellat quaerat assumenda! Debitis, perspiciatis explicabo sit error eaque
            repellendus tempore. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam pariatur numquam hic,
            autem exercitationem quidem, voluptatibus maxime perferendis ipsum eaque perspiciatis laborum in magni
            molestias, totam error beatae incidunt est!
        </p>
    </div>
    <div class="sm:grid  grid-cols-2 w-4/5 m-auto">
        <div class="flex bg-yellow-700 text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block">
                <span class="uppercase text-xs">
                    php
                </span>
                <h3 class="text-xl font-bold py-10">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla optio laboriosam aliquam accusantium
                    provident magnam quam ut necessitatibus sed magni, placeat cum, repellat vel recusandae reiciendis, nemo
                    unde. Corrupti, qui? Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, vero excepturi!
                    Dolorum impedit aspernatur rem sapiente provident porro eveniet. Optio deleniti adipisci ipsam eligendi
                    in eum voluptatibus suscipit beatae ad.
                </h3>

                <a href=""
                    class=" uppercase bg-transparent border-2 border-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                    Find Out More
                </a>
            </div>
        </div>
        <div>
            <div>
                <img src="https://cdn.pixabay.com/photo/2016/01/30/18/17/laptop-1170255__340.jpg" alt="" width=100%>
            </div>
        </div>
    </div>
@endsection
