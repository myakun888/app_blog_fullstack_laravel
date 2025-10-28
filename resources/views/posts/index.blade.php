<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">All Posts</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Posts</h1>
                <a href="{{ route('posts.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    Create Post
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600">By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        @if($post->user_id === auth()->id())
                            <div class="flex space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No posts yet.</p>
            @endforelse

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
