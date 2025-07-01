<form wire:submit.prevent="save">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $editing ? 'Edit Category' : 'Create Category' }}
        </h2>

        {{-- Validation Errors Summary --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md" role="alert">
                <p class="font-bold">Please correct the error below:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Category Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>
    </div>

    {{-- Modal Footer --}}
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        <x-secondary-button x-on:click="$dispatch('close')">
            Cancel
        </x-secondary-button>

        <x-button class="ml-4" type="submit">
            Save Category
        </x-button>
    </div>
</form>
