<div>
    {{-- Page Title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8">

                    {{-- Toolbar --}}
                    <div class="flex justify-between items-center mb-6">
                        <div class="w-1/3">
                            <x-input type="text"
                                     class="w-full"
                                     placeholder="Search for pages..."
                                     wire:model.live.debounce.500ms="search" />
                        </div>

                        <div>
                            <x-button wire:click="createPage">
                                {{ __('Create New Page') }}
                            </x-button>
                        </div>
                    </div>

                    {{-- Table Container --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div wire:loading.flex class="absolute inset-0 bg-white bg-opacity-50 items-center justify-center">
                            <div class="text-center">
                                <x-heroicon-o-arrow-path class="h-8 w-8 text-gray-500 animate-spin"/>
                                <p class="mt-2 text-gray-500">Loading...</p>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Slug</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Created At</th>
                                <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($pages as $page)
                                <tr wire:key="{{ $page->id }}" class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $page->title }}</th>
                                    <td class="px-6 py-4">{{ $page->slug }}</td>
                                    <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $page->status === \App\Enums\PageStatus::PUBLISHED ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $page->status->value }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $page->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <button wire:click="editPage({{ $page->id }})" class="font-medium text-blue-600 hover:underline">Edit</button>
                                        <button wire:click="confirmDelete({{ $page->id }})" class="ml-4 font-medium text-red-600 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No pages found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">{{ $pages->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Page Form Modal --}}
    <x-dialog-modal wire:model.live="showPageModal">
        <x-slot name="title"></x-slot>
        <x-slot name="content">
            @livewire('admin.pages.page-form')
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    {{-- Delete Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="showConfirmDeleteModal">
        <x-slot name="title">Delete Page</x-slot>
        <x-slot name="content">Are you sure you want to delete this page?</x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showConfirmDeleteModal', false)">Cancel</x-secondary-button>
            <x-danger-button class="ml-2" wire:click="deletePage">Delete Page</x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
