<form wire:submit.prevent="save">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $editing ? 'Edit Page' : 'Create Page' }}
        </h2>

        {{-- Validation Errors Summary --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md" role="alert">
                <p class="font-bold">Please correct the errors below:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            <!-- Title -->
            <div>
                <x-label for="page_title" value="{{ __('Title') }}" />
                <x-input id="page_title" class="block mt-1 w-full" type="text" wire:model="title" />
                <x-input-error for="title" class="mt-2" />
            </div>

            <!-- Body -->
            <div>
                <x-label for="page_body" value="{{ __('Body') }}" />
                <textarea id="page_body" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="10" wire:model="body"></textarea>
                <x-input-error for="body" class="mt-2" />
            </div>

            <!-- Status -->
            <div>
                <x-label for="page_status" value="{{ __('Status') }}" />
                <select id="page_status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
                <x-input-error for="status" class="mt-2" />
            </div>

        </div>
    </div>

    {{-- Modal Footer --}}
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        <x-secondary-button x-on:click="$dispatch('close')">
            Cancel
        </x-secondary-button>

        <x-button class="ml-4" type="submit">
            Save Page
        </x-button>
    </div>
</form>
