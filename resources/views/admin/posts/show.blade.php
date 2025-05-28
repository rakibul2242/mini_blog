<x-app-layout>
    <x-user-dropdown />
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    {{ $post->title }}
                </h1>
                <div class="flex flex-wrap items-center text-gray-500 dark:text-gray-400 text-sm mb-4">
                    <span class="mr-2">Category:</span>
                    <span class="font-semibold mr-4">{{ $post->category }}</span>
                    <span class="mr-2">Created:</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                    <span class="ml-4">Status:</span>
                    <span class="font-semibold">{{ $post->status }}</span>
                </div>
                <div class="mb-6">
                @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-auto h-80 mb-4 rounded-lg shadow-md border">
                    @else
                    <img src="https://t3.ftcdn.net/jpg/05/04/28/96/360_F_504289605_zehJiK0tCuZLP2MdfFBpcJdOVxKLnXg1.jpg" alt="{{ $post->title }}" class="w-auto h-80 mb-4 rounded-lg shadow-md border">
                @endif
            </div>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $post->content }}
                </p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex flex-col sm:flex-row justify-between items-center">
                <a href="{{ route('admin.posts.edit', $post->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline mb-2 sm:mb-0 w-full sm:w-auto">
                    Edit Post
                </a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline w-full"
                        onclick="return confirm('Are you sure you want to delete this post?')">
                        Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
