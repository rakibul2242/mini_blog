<x-app-layout>
    <x-user-dropdown />
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="mb-8">
                    @if ($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 sm:h-80 object-cover mb-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                    @else
                        <img src="https://placehold.co/800x400/cccccc/333333?text=No+Image+Available"
                            alt="{{ $post->title }}"
                            class="w-full h-64 sm:h-80 object-cover mb-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                    @endif
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed mb-8">
                   {!! $post->content !!}
                </div>

                <hr class="my-8 border-t border-gray-200 dark:border-gray-700">

                {{-- Metadata Section --}}
                <div
                    class="text-gray-600 dark:text-gray-400 text-sm grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 mb-6">
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Category:</span>
                        <span class="text-blue-600 dark:text-blue-400 font-medium">{{ $post->category }}</span>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Created:</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        @if ($post->updated_at && $post->updated_at != $post->created_at)
                            <div>
                                <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Last Updated:</span>
                                <span>{{ $post->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        @endif
                    </div>
                    @if ($post->published_at)
                        <div>
                            <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Published:</span>
                            <span>{{ $post->published_at->format('M d, Y H:i') }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Status:</span>
                        <span class="font-medium text-green-600 dark:text-green-400">{{ $post->status }}</span>
                    </div>

                    {{-- Tags Section --}}
                    <div class="text-gray-600 dark:text-gray-400 text-sm flex flex-wrap items-center">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 mr-2">Tags:</span>
                        @if ($post->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 transition duration-200 ease-in-out cursor-pointer">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <span>No tags</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div
                class="bg-gray-100 dark:bg-gray-700 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-200 dark:border-gray-600">
                <a href="{{ route('admin.posts.edit', $post->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-300 ease-in-out transform hover:-translate-y-0.5 w-full sm:w-auto text-center text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.687a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.88-2.368a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                    </svg>
                    Edit Post
                </a>
                <button type="button" id="deletePostButton"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-300 ease-in-out transform hover:-translate-y-0.5 w-full sm:w-auto text-center text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.177m-1.022.177l1.576 15.652a2.25 2.25 0 0 1-2.244 2.077H4.772a2.25 2.25 0 0 1-2.244-2.077L2.92 6.365m16 6.528a.75.75 0 0 0-.75.75c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75c0-.414-.336-.75-.75-.75H19Zm-13.5.75a.75.75 0 0 0-.75.75c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75c0-.414-.336-.75-.75-.75H5.5Z" />
                    </svg>
                    Delete Post
                </button>
                <form id="deletePostForm" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                    class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-sm">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Confirm Deletion</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Are you sure you want to delete this post? This action
                cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelDeleteButton"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-200 ease-in-out">
                    Cancel
                </button>
                <button type="button" id="confirmDeleteButton"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 ease-in-out">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deletePostButton = document.getElementById('deletePostButton');
            const deletePostForm = document.getElementById('deletePostForm');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteButton = document.getElementById('cancelDeleteButton');
            const confirmDeleteButton = document.getElementById('confirmDeleteButton');

            // Show the modal when the delete button is clicked
            deletePostButton.addEventListener('click', function() {
                deleteModal.classList.remove('hidden');
            });

            // Hide the modal when the cancel button is clicked
            cancelDeleteButton.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });

            // Submit the form when the confirm delete button is clicked
            confirmDeleteButton.addEventListener('click', function() {
                deletePostForm.submit();
            });

            // Optional: Hide modal if user clicks outside the modal content
            deleteModal.addEventListener('click', function(event) {
                if (event.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
