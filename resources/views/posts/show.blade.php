<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Post Detail</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
                <p class="text-sm text-gray-600 mb-4">
                    By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                </p>

                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-64 object-cover rounded mb-4">
                @endif

                <div class="prose max-w-none">
                    {!! nl2br(e($post->body)) !!}
                </div>

                @if($post->user_id === auth()->id())
                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Delete this post?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Komentar akan ditambah nanti -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Comments</h3>
                <p class="text-gray-600">Fitur komentar akan ditambah selanjutnya.</p>
            </div>
        </div>
    </div>
</x-app-layout>
