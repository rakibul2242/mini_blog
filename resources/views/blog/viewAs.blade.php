@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-center text-purple-800 mb-6">All Blog Posts</h1>

        <!-- Articles List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <!-- Post Image -->
                    @if ($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gray-300 flex items-center justify-center">
                            <span class="text-white text-2xl">No Image</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <!-- Post Title -->
                        <h2 class="text-2xl font-bold text-purple-800">{{ $post->title }}</h2>

                        <!-- Post Category -->
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $post->category }}</p>

                        <!-- Post Excerpt -->
                        <p class="text-gray-700 dark:text-gray-300 mt-4 text-sm">
                            {{ Str::limit($post->body, 150) }}
                        </p>

                        <!-- Like Button -->
                        <div class="mt-4 flex items-center space-x-4">
                            <form action="{{ route('posts.edit', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-5 w-5 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21l-1-1.35a7.497 7.497 0 01-4.85-6.65 7.49 7.49 0 0114.5 0 7.497 7.497 0 01-4.85 6.65L12 21z" />
                                    </svg>
                                    <span class="ml-2">{{ $post->likes_count }} Likes</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

       
    </div>
@endsection
