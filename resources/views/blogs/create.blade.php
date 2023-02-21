<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <form method="post" enctype="multipart/form-data" action="{{ route('blogs.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required autocomplete="description" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="content" value="Content" />
                        <textarea id="content" name="content" type="text" class="mt-1 block w-full" required autocomplete="username">
                            {{old('content')}}
                        </textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content')" />
                    </div>

                    <x-input-label for="categories" value="Categories" />
                    <div class="p-10 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-7 gap-5">
                        @foreach($categories as $category)
                            <div class="mt-0">
                                <label class="inline-flex items-center">
                                <input type="checkbox" name="categories[]" value="{{$category->id}}" class="w-5 h-5 rounded"  />
                                <span class="ml-2 text-sm">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload image</label>
                        <input name="image" id="file_input" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
