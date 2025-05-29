<x-app-layout>
    <x-user-dropdown />
    <div class="px-3 py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-center text-purple-800">📝 Manage Blog Posts</h2>
                <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 text-purple-600 dark:text-white border-purple-500 dark:bg-purple-500 border rounded-md font-bold text-xs uppercase tracking-widest hover:bg-purple-700 dark:hover:bg-purple-600 hover:text-white focus:bg-purple-700 dark:focus:bg-purple-600 active:bg-purple-800 dark:active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">➕ Add New Post</a>
            </div>

            <div class="flex justify-between items-center">
                <div class="relative rounded-md shadow-sm mb-6 w-2/5">
                    <input type="text" name="search" id="search" class="w-full focus:ring-indigo-500 focus:border-indigo-500 block pl-10 sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Search posts...">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-6a7 7 0 10-14 0 7 7 0 0014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mb-6 flex space-x-4 items-center">
                    <div class="relative">
                        <select id="categoryFilter" class="block appearance-nonefocus:ring-indigo-500 focus:border-indigo-500 text-center text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">All Categories</option>
                            @foreach(['Technology', 'Travel', 'Food', 'News', 'Opinion'] as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative">
                        <select id="sortFilter" class="block appearance-nonefocus:ring-indigo-500 focus:border-indigo-500 text-center text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="newest">Sort By: Date (Newest)</option>
                            <option value="oldest">Sort By: Date (Oldest)</option>
                            <option value="title-asc">Sort By: Title (A-Z)</option>
                            <option value="title-desc">Sort By: Title (Z-A)</option>
                        </select>
                    </div>
                    <button id="clearFilters" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Clear Filters') }}
                    </button>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-100 dark:bg-green-800 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-300 px-4 py-3 rounded-md mb-6 shadow-md" role="alert">
                <strong class="font-bold">{{ __('Success!') }}</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle h-6 w-6 fill-current" @click="this.parentNode.remove()">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m15 9-6 6" />
                        <path d="m9 9 6 6" />
                    </svg>
                </span>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm text-left text-gray-700 dark:text-gray-300" id="postTable">
                    <thead class="bg-purple-600 text-white dark:bg-purple-700">
                        <tr>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('ID') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('Title') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('Category') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('Image') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium uppercase tracking-wider">
                                {{ __('Created At') }}
                            </th>
                            <th scope="col" class="px-3 py-2 text-center text-xs font-medium uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($posts as $post)
                        <tr class="hover:bg-purple-50 dark:hover:bg-purple-700" data-category="{{ $post->category }}" data-created-at="{{ $post->created_at->timestamp }}" data-title="{{ $post->title }}">
                            <td class="px-3 py-2">
                                {{ $post->id }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $post->title }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $post->category }}
                            </td>
                            <td class="px-3">
                                @if ($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="Post Image" class="h-7 object-cover">
                                @else
                                <i>No image</i>
                                @endif
                            </td>
                            <td class="px-3 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $post->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100' : 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100') }}">
                                    {{ $post->status }}
                                </span>
                            </td>
                            <td class="px-3 py-2">
                                {{ $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-right">
                                <div class="flex justify-end items-center space-x-3">
                                    <!-- View -->
                                    <a href="{{ route('admin.posts.show', $post->id) }}"
                                        class="text-purple-700 dark:text-gray-200 hover:underline hover:text-purple-600 dark:hover:text-purple-400 transition"
                                        title="{{ __('View') }}">
                                        {{ __('View') }}
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:underline hover:text-blue-800 dark:hover:text-blue-300 transition"
                                        title="{{ __('Edit') }}">
                                        {{ __('Edit') }}
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('{{ __(`Are you sure you want to delete this post?`) }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:underline hover:text-red-800 dark:hover:text-red-300 transition"
                                            title="{{ __('Delete') }}">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @if (count($posts) === 0)
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400" colspan="6">{{ __('No posts found.') }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            const postTable = document.getElementById('postTable').getElementsByTagName('tbody')[0];
            const searchInput = document.getElementById('search');
            const clearFiltersButton = document.getElementById('clearFilters');

            let initialPosts = Array.from(postTable.rows);
            let debouncedFilterAndSort = debounce(filterAndSortPosts, 300);

            function filterAndSortPosts() {
                let filteredPosts = initialPosts;

                // Filter by category
                const selectedCategory = categoryFilter.value;
                if (selectedCategory) {
                    filteredPosts = filteredPosts.filter(row => row.getAttribute('data-category') === selectedCategory);
                }

                // Filter by search term
                const searchTerm = searchInput.value.toLowerCase();
                filteredPosts = filteredPosts.filter(row => {
                    const title = row.getAttribute('data-title').toLowerCase();
                    return title.includes(searchTerm);
                });

                // Sort
                const sortValue = sortFilter.value;
                switch (sortValue) {
                    case 'newest':
                        filteredPosts.sort((a, b) => parseInt(b.getAttribute('data-created-at')) - parseInt(a.getAttribute('data-created-at')));
                        break;
                    case 'oldest':
                        filteredPosts.sort((a, b) => parseInt(a.getAttribute('data-created-at')) - parseInt(b.getAttribute('data-created-at')));
                        break;
                    case 'title-asc':
                        filteredPosts.sort((a, b) => a.getAttribute('data-title').localeCompare(b.getAttribute('data-title')));
                        break;
                    case 'title-desc':
                        filteredPosts.sort((a, b) => b.getAttribute('data-title').localeCompare(a.getAttribute('data-title')));
                        break;
                }

                // Clear the table and add the filtered and sorted rows
                while (postTable.firstChild) {
                    postTable.removeChild(postTable.firstChild);
                }
                if (filteredPosts.length === 0) {
                    let noResultsRow = document.createElement('tr');
                    noResultsRow.innerHTML = `<td class="px-3 py-2 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400" colspan="6">{{ __('No posts found matching your criteria.') }}</td>`;
                    postTable.appendChild(noResultsRow);
                } else {
                    filteredPosts.forEach(row => postTable.appendChild(row));
                }
            }

            function clearFilters() {
                categoryFilter.value = '';
                sortFilter.value = 'newest';
                searchInput.value = '';
                filterAndSortPosts();
            }

            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    const context = this;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), delay);
                };
            }

            categoryFilter.addEventListener('change', filterAndSortPosts);
            sortFilter.addEventListener('change', filterAndSortPosts);
            searchInput.addEventListener('input', debouncedFilterAndSort);
            clearFiltersButton.addEventListener('click', clearFilters);

            // --- Optional: Persisting Filters (Example using localStorage) ---
            const storageKeyCategory = 'blogPostCategoryFilter';
            const storageKeySort = 'blogPostSortFilter';

            if (localStorage.getItem(storageKeyCategory)) {
                categoryFilter.value = localStorage.getItem(storageKeyCategory);
            }
            if (localStorage.getItem(storageKeySort)) {
                sortFilter.value = localStorage.getItem(storageKeySort);
            }

            filterAndSortPosts(); // Initial load with persisted filters

            categoryFilter.addEventListener('change', () => {
                localStorage.setItem(storageKeyCategory, categoryFilter.value);
                filterAndSortPosts();
            });

            sortFilter.addEventListener('change', () => {
                localStorage.setItem(storageKeySort, sortFilter.value);
                filterAndSortPosts();
            });
            // --- End Optional: Persisting Filters ---
        });
    </script>
</x-app-layout>