<x-app-layout>
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold mb-6 text-gray-900 dark:text-gray-100 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L13 7l4-4z"/><path d="M15 5s2 2 2 2"/></svg>
            Edit Post
        </h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Title <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500"
                    value="{{ old('title', $post->title) }}"
                    placeholder="Enter post title"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-4">
                <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Content <span class="text-red-500">*</span></label>
                <textarea
                    name="content"
                    id="content"
                    rows="10"
                    class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 min-h-[250px]"
                    placeholder="Enter post content"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Category <span class="text-red-500">*</span></label>
                    <select
                        name="category"
                        id="category"
                        class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                        required
                    >
                        <option value="" disabled>Select a category</option>
                        @foreach(['Technology', 'Travel', 'Food', 'News', 'Opinion'] as $category)
                            <option value="{{ $category }}" {{ old('category', $post->category) === $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Status <span class="text-red-500">*</span></label>
                    <select
                        name="status"
                        id="status"
                        class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                        required
                    >
                        <option value="" disabled>Select a status</option>
                         @foreach([['value' => 'published', 'label' => 'Published'], ['value' => 'draft', 'label' => 'Draft'], ['value' => 'archived', 'label' => 'Archived']] as $statusOption)
                            <option value="{{ $statusOption['value'] }}" {{ old('status', $post->status) === $statusOption['value'] ? 'selected' : '' }}>{{ $statusOption['label'] }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-4">
                <label for="featured_image" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Featured Image</label>
                <input
                    type="text"
                    name="featured_image"
                    id="featured_image"
                    class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500"
                    value="{{ old('featured_image', $post->featured_image) }}"
                    placeholder="Enter image URL"
                >
                @error('featured_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                 @if(old('featured_image', $post->featured_image))
                    <div class="mt-4">
                        <img src="{{ old('featured_image', $post->featured_image) }}" alt="Featured" class="h-auto max-w-full rounded-md shadow-md">
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <label for="created_at" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">Created At <span class="text-red-500">*</span></label>
                <input
                    type="date"
                    name="created_at"
                    id="created_at"
                    class="mt-1 block w-full py-2.5 px-3.5 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    value="{{ old('created_at', $post->created_at->format('Y-m-d')) }}"
                    required
                >
                @error('created_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Update Post
                </button>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                <span class="text-red-500">*</span> Required fields
            </div>
        </form>
    </div>
</x-app-layout>
