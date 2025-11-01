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

 <!-- Komentar -->
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">     Komentar ({{ $post->comments->count() }})   </h3>

    <!-- Form komentar -->
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
        @csrf
        <textarea name="body" rows="3" class="w-full rounded-md border-gray-300 shadow-sm"
                  placeholder="Tulis komentar..." required></textarea>
        @error('body')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
        <button type="submit" class="mt-2 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Kirim Komentar
        </button>
    </form>              <!-- List Komentar -->
    @forelse($post->comments as $comment)
        <div class="border-b pb-4 mb-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold">{{ $comment->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="mt-1">{{ $comment->body }}</p>
                </div>
                @if($comment->user_id === auth()->id())
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 text-sm hover:underline"
                                onclick="return confirm('Hapus komentar?')">
                            Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-600">Belum ada komentar.</p>
    @endforelse
</div>
</x-app-layout>
