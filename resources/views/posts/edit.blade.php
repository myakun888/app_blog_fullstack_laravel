<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Post</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Body</label>
                    <textarea name="body" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        {{ old('body', $post->body) }}
                    </textarea>
                    @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Image (optional)</label>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current" class="w-32 h-32 object-cover mb-2 rounded">
                    @endif
                    <input type="file" name="image" accept="image/*" class="mt-1 block w-full">
                    @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('posts.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        Cancel
                    </a>
                    <x-primary-button>Update Post</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
