<form wire:submit.prevent="save">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $editing ? 'Edit Post' : 'Create Post' }}
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
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" />
                <x-input-error for="title" class="mt-2" />
            </div>

            <!-- Excerpt -->
            <div>
                <x-label for="excerpt" value="{{ __('Excerpt') }}" />
                <textarea id="excerpt" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" wire:model="excerpt"></textarea>
                <x-input-error for="excerpt" class="mt-2" />
            </div>

            <!-- Content -->
            <div>
                <x-label for="content" value="{{ __('Content') }}" />
                <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="8" wire:model="content"></textarea>
                <x-input-error for="content" class="mt-2" />
            </div>

            <!-- Categories -->
            <div>
                <x-label for="categories" value="{{ __('Categories') }}" />
                <select id="categories" multiple class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="selectedCategories">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="selectedCategories" class="mt-2" />
            </div>

            <!-- Image Upload -->
            <div>
                <x-label for="image" value="{{ __('Featured Image') }}" />
                <input id="image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" wire:model="image">
                <div wire:loading wire:target="image" class="mt-2 text-sm text-gray-500">Uploading...</div>
                <x-input-error for="image" class="mt-2" />

                {{-- Image Preview --}}
                @if ($image)
                    <div class="mt-4">
                        <img src="{{ $image->temporaryUrl() }}" class="w-48 h-auto rounded-lg">
                    </div>
                @elseif($post && $post->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-48 h-auto rounded-lg">
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div>
                <x-label for="status" value="{{ __('Status') }}" />
                <select id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="status">
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
            Save Post
        </x-button>

    </div>
</form>
