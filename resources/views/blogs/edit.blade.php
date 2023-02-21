<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Blog - {{ $blog->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <form method="post" action="{{ route('blogs.update', ['blog'=>$blog->id]) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $blog->title)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $blog->description)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="content" value="Content" />
                        <textarea id="content" name="content" type="text" class="mt-1 block w-full" required autocomplete="username">
                            {{old('content', $blog->content)}}
                        </textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content')" />
                    </div>

                    <x-input-label for="categories" value="Categories" />
                    <div class="p-10 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-7 gap-5">
                        @foreach($categories as $category)
                            <div class="mt-0">
                                <label class="inline-flex items-center">
                                @if(in_array($category->id, $blog->categories->pluck('id')->toArray()))
                                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="w-5 h-5 rounded" checked />
                                @else
                                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="w-5 h-5 rounded"  />
                                @endif
                                <span class="ml-2 text-sm">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
