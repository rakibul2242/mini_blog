<x-app-layout>
    <x-user-dropdown />

    <div class="container mx-auto px-4 py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Posts</h1>
            <a href="{{ route('admin.posts.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                + Create Post
            </a>
        </div>

        @if($posts->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow hover:shadow-lg transition">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                 class="w-full h-48 object-cover rounded-t-2xl">
                        @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-800 rounded-t-2xl flex items-center justify-center text-gray-500 dark:text-gray-400">
                                No Image
                            </div>
                        @endif

                        <div class="p-5">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                                {{ $post->title }}
                            </h2>

                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>

                            <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ $post->category }}</span>
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('posts.show', $post->id) }}"
                                   class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                    View
                                </a>

                                <div class="flex gap-3 text-sm">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                       class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center text-gray-600 dark:text-gray-400 mt-20">
                <p class="text-lg">No posts found.</p>
            </div>
        @endif
    </div>
</x-app-layout>
