<x-app-layout>
<x-user-dropdown />
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 space-y-8">
            <div class="flex items-center gap-3 border-b pb-4 border-gray-200 dark:border-gray-700">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8" />
                    <path d="M12 8v8" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create New Post</h2>
            </div>

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" aria-labelledby="create-post-form">
                @csrf

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        value="{{ old('title') }}" placeholder="Enter post title">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="8" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Write your post...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category & Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category <span class="text-red-500">*</span></label>
                        <select name="category" id="category" required aria-required="true"
                            class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            <option value="" disabled>Select a category</option>
                            @foreach(['Technology', 'Travel', 'Food', 'News', 'Opinion'] as $category)
                                <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required aria-required="true"
                            class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            <option value="" disabled>Select a status</option>
                            @foreach([['value' => 'published', 'label' => 'Published'], ['value' => 'draft', 'label' => 'Draft'], ['value' => 'archived', 'label' => 'Archived']] as $statusOption)
                                <option value="{{ $statusOption['value'] }}" {{ old('status') === $statusOption['value'] ? 'selected' : '' }}>
                                    {{ $statusOption['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Featured Image Upload --}}
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                    @error('featured_image')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Created At --}}
                <div>
                    <label for="created_at" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Created At <span class="text-red-500">*</span></label>
                    <input type="date" name="created_at" id="created_at" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded-lg border bg-gray-200 border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        value="{{ old('created_at', date('Y-m-d')) }}">
                    @error('created_at')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Create Post
                    </button>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2"><span class="text-red-500">*</span> Required fields</p>
            </form>
        </div>
    </div>
</x-app-layout>
