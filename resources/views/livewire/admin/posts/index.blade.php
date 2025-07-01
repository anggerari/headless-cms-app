<div>
    {{-- Page Title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Content Container --}}
                <div class="p-6 lg:p-8">

                    {{-- Toolbar --}}
                    <div class="flex justify-between items-center mb-6">
                        {{-- Search Input --}}
                        <div class="w-1/3">
                            <x-input type="text"
                                     class="w-full"
                                     placeholder="Search for posts by title..."
                                     wire:model.live.debounce.500ms="search" />
                        </div>

                        {{-- Create Post Button --}}
                        <div>
                            <x-button wire:click="createPost">
                                {{ __('Create New Post') }}
                            </x-button>
                        </div>
                    </div>

                    {{-- Table Container --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        {{-- Loading Indicator --}}
                        <div wire:loading.flex class="absolute inset-0 bg-white bg-opacity-50 items-center justify-center">
                            <div class="text-center">
                                <x-heroicon-o-arrow-path class="h-8 w-8 text-gray-500 animate-spin"/>
                                <p class="mt-2 text-gray-500">Loading...</p>
                            </div>
                        </div>

                        {{-- Table --}}
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Author
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Published At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($posts as $post)
                                <tr wire:key="{{ $post->id }}" class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $post->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $post->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $post->status === \App\Enums\PostStatus::PUBLISHED ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $post->status->value }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not set' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button wire:click="editPost({{ $post->id }})" class="font-medium text-blue-600 hover:underline">Edit</button>
                                        <button wire:click="confirmDelete({{ $post->id }})" class="ml-4 font-medium text-red-600 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No posts found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Post Form Modal --}}
    <x-dialog-modal wire:model.live="showPostModal">
        <x-slot name="title"></x-slot>
        <x-slot name="content">
            {{-- REMOVED lazy:true FROM HERE --}}
            @livewire('admin.posts.post-form')
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    {{-- Delete Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="showConfirmDeleteModal">
        <x-slot name="title">
            Delete Post
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this post? This action cannot be undone.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showConfirmDeleteModal', false)">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deletePost">
                Delete Post
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
