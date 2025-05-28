<x-app-layout>
    <x-user-dropdown />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Latest Posts</h1>

        @if ($posts->count())
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <div
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-6 hover:shadow-lg transition duration-300">

                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                            {{-- You can link this to single post show page if you want --}}
                            {{ $post->title }}
                        </h2>

                        @if ($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                class="w-full max-h-96 object-cover rounded mb-4">
                        @endif

                        <p class="text-gray-700 dark:text-gray-300 mb-4 whitespace-pre-line">
                            {{ $post->content }}
                        </p>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400">
                            <span><strong>Category:</strong> {{ $post->category }}</span>
                            <span><strong>Status:</strong> {{ ucfirst($post->status) }}</span>
                            <span><strong>Created At:</strong> {{ $post->created_at->format('F j, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-300">No posts found.</p>
        @endif
    </div>
</x-app-layout>