<section class="space-y-6">
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delete Blog
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header> -->

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-blog-deletion')"
    >Delete Blog</x-danger-button>

    <x-modal name="confirm-blog-deletion" focusable>
        <form method="post" action="{{ route('blogs.destroy', ['blog'=>$blog->id]) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete this blog? 
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once this blog is deleted, all of its data will be permanently deleted.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Delete Blog
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
