<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="container my-24 px-6 mx-auto">
                    <!-- Section: Design Block -->
                    <section class="mb-32 text-gray-800">
                        <h1 class="font-bold text-3xl mb-6">{{ $category->name }}</h1>
                        <p>
                            {{ $category->description}}
                        </p>
                    </section>

                    <div class="flex gap-4 items-center justify-end">
                        <a href="{{route('categories.index')}}">
                            Back
                        </a>
                        <a href="{{route('categories.edit', ['category'=>$category->id])}}" class="'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </a>
                        @include('categories.partials.delete-category-form')

                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
