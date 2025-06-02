@php
    $detailedPostId = request('post');
    $detailedPost = $detailedPostId ? $posts->firstWhere('id', $detailedPostId) : $posts->take(2);
    $otherPosts = $posts->filter(fn($post) => !collect($detailedPost)->pluck('id')->contains($post->id));
@endphp

<x-app-layout>
    <x-user-dropdown />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-10">📚 Latest Posts</h1>

        {{-- Detailed Posts --}}
        @if ($detailedPost instanceof \Illuminate\Support\Collection)
            @foreach ($detailedPost as $post)
                <x-post-detailed :post="$post" class="mb-12" />
            @endforeach
        @else
            <x-post-detailed :post="$detailedPost" class="mb-12" />
        @endif

        {{-- More Posts Grid --}}
        @if ($otherPosts->count())
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mt-10 mb-6">📄 More Posts</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($otherPosts as $post)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col">
                        <a href="{{ route('blog.index', ['post' => $post->id]) }}">
                            @if ($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <img src="https://placehold.co/800x400/cccccc/333333?text=No+Image+Available"
                                    alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @endif

                            <div class="px-2 py-3 flex-1 flex flex-col">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                    {{ $post->title }}
                                </h3>

                                <div class="text-sm text-gray-700 dark:text-gray-300 mb-2 line-clamp-3">
                                    {{-- {{ Str::limit($post->content, 100) }} --}}
                                    {!! $post->content !!}
                                    {{-- {{ Str::limit(strip_tags($post->content), 100) }} --}}
                                </div>

                                <div
                                    class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    <span>{{ $post->category }}</span>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Pagination --}}
        <div class="w-1/2 mt-12">
            {{ $posts->onEachSide(2)->links() }}

        </div>

    </div>
</x-app-layout>
