<x-app-layout>
    <x-user-dropdown />
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 space-y-8">
            <div class="flex items-center justify-center gap-3 border-b pb-4 border-gray-200 dark:border-gray-700">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8" />
                    <path d="M12 8v8" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create New Post</h2>
            </div>

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" aria-labelledby="create-post-form">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        value="{{ old('title') }}" placeholder="Enter post title">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content
                        <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="8" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Write your post...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Quill CSS -->
                <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Content <span class="text-red-500">*</span>
                    </label>

                    <div id="toolbar">
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                        <select class="ql-header">
                            <option selected></option>
                            <option value="5"></option>
                            <option value="4"></option>
                            <option value="3"></option>
                            <option value="2"></option>
                            <option value="1"></option>
                        </select>
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                        <select class="ql-align"></select>
                        <button class="ql-link"></button>
                        <button class="ql-code-block"></button>
                        <button class="ql-clean"></button>
                    </div>

                    <div id="editor"
                        class="mt-2 h-48 bg-gray-50 dark:bg-gray-800 border rounded-b p-2 border-gray-200 dark:border-gray-600">
                    </div>
                    <textarea name="content" id="content" class="hidden">{{ old('content') }}</textarea>

                    @error('content')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
                <script>
                    const quill = new Quill('#editor', {
                        modules: {
                            toolbar: '#toolbar'
                        },
                        theme: 'snow',
                        placeholder: 'Write your post...'
                    });

                    const contentInput = document.getElementById('content');
                    const form = contentInput.closest('form');
                    form.onsubmit = () => contentInput.value = quill.root.innerHTML.trim();

                    @if (old('content'))
                        quill.root.innerHTML = @json(old('content'));
                    @endif
                </script>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category <span
                                class="text-red-500">*</span></label>
                        <select name="category" id="category" required aria-required="true"
                            class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            <option value="" disabled>Select a category</option>
                            @foreach (['Technology', 'Travel', 'Food', 'News', 'Opinion'] as $category)
                                <option value="{{ $category }}"
                                    {{ old('category') === $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status
                            <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required aria-required="true"
                            class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            <option value="" disabled>Select a status</option>
                            @foreach ([['value' => 'published', 'label' => 'Published'], ['value' => 'draft', 'label' => 'Draft'], ['value' => 'archived', 'label' => 'Archived']] as $statusOption)
                                <option value="{{ $statusOption['value'] }}"
                                    {{ old('status') === $statusOption['value'] ? 'selected' : '' }}>
                                    {{ $statusOption['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="featured_image"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                    @error('featured_image')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tags"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                    <div id="tag-container"
                        class="mt-1 w-full px-4 py-3 rounded border bg-gray-100 dark:bg-gray-800 border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 flex flex-wrap gap-2">
                        <input type="text" id="tag-input"
                            placeholder="Add tags separated by commas (ex. Laravel, PHP)"
                            class="bg-transparent p-0 flex-1 min-w-[150px]"
                            style="outline: none !important; box-shadow: none !important; border: none !important;" />
                    </div>
                    <input type="hidden" name="tags" id="tags-hidden" />
                    <p class="text-red-500 text-sm mt-1 hidden" id="tags-error"></p>
                </div>
                <script>
                    const input = document.getElementById('tag-input');
                    const container = document.getElementById('tag-container');
                    const hiddenInput = document.getElementById('tags-hidden');

                    input.onfocus = () => container.style.boxShadow = '0 0 0 3px #3b82f6';
                    input.onblur = () => container.style.boxShadow = 'none';

                    document.addEventListener('DOMContentLoaded', () => {
                        let tags = [];

                        const update = () => {
                            // Update hidden input
                            hiddenInput.value = tags.join(', ');
                        };

                        const render = () => {
                            container.querySelectorAll('.pill').forEach(el => el.remove());
                            tags.forEach(t => {
                                const span = document.createElement('span');
                                span.className =
                                    'flex items-center justify-center pill bg-blue-500 text-white rounded-full cursor-pointer select-none py-2 px-4 text-sm font-semibold hover:bg-red-600';
                                span.textContent = t;
                                span.title = "Click to remove";
                                span.onclick = () => {
                                    tags = tags.filter(x => x !== t);
                                    render();
                                    update();
                                };
                                container.insertBefore(span, input);
                            });
                            update();
                        };

                        input.addEventListener('keydown', e => {
                            if (e.key === ',' || e.key === 'Enter') {
                                e.preventDefault();
                                let val = input.value.trim().replace(/,$/, '');
                                if (val && !tags.includes(val)) tags.push(val);
                                input.value = '';
                                render();
                                update();
                            }
                        });
                    });
                </script>
                <div>
                    <label for="created_at" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Created
                        At <span class="text-red-500">*</span></label>
                    <input type="date" name="created_at" id="created_at" required aria-required="true"
                        class="mt-1 w-full px-4 py-3 rounded border bg-gray-50 shadow border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        value="{{ old('created_at', date('Y-m-d')) }}">
                    @error('created_at')
                        <p class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class="inline-flex items-center px-3 py-3 bg-gradient-to-br from-purple-600 to-blue-500 text-white text-base font-semibold rounded shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-300 focus:ring-opacity-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Create Post
                    </button>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2"><span class="text-red-500">*</span> Required
                    fields</p>
            </form>
        </div>
    </div>
</x-app-layout>
