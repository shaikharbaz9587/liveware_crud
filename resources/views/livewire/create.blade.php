<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $post_id ? 'Edit Post' : 'Create Post' }}
            </h3>
            <div class="mt-2 px-7 py-3">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" id="title" wire:model="title">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                    <textarea class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" id="body" wire:model="body"></textarea>
                    @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="items-center px-4 py-3">
                <button wire:click="{{ $post_id ? 'update' : 'store' }}" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700">
                    {{ $post_id ? 'Update' : 'Save' }}
                </button>
                <button wire:click="closeModal()" class="mt-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>