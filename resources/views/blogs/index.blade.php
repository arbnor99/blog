<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blogs
            </h2>
            <a href="{{route('blogs.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Blog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             
            
                <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                    @foreach ($blogs as $blog)
                        <div class="rounded overflow-hidden shadow-lg ">
                            <img class="w-full" src="/mountain.jpg" alt="Mountain">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">
                                    <a href="{{route('blogs.show', ['blog' => $blog->id])}}">
                                        {{$blog->title}}
                                    </a>
                                </div>
                                <p class="text-gray-700 text-base">
                                    {{$blog->description}}
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                @foreach ($blog->categories as $category)
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</x-app-layout>