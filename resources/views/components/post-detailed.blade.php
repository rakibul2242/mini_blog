@props(['post'])

@if ($post)
    <div
        {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden']) }}>
        @if ($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                class="w-full h-72 object-cover">
        @endif

        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $post->title }}
            </h2>

            <p class="text-gray-700 dark:text-gray-300 mb-6 whitespace-pre-line text-base leading-relaxed">
                {{ $post->content }}
            </p>

            <div class="flex flex-wrap gap-6 text-sm text-gray-500 dark:text-gray-400">
                <span><strong>Category:</strong> {{ $post->category }}</span>
                <span><strong>Status:</strong> {{ ucfirst($post->status) }}</span>
                <span><strong>Created:</strong> {{ $post->created_at->format('F j, Y') }}</span>
            </div>
        </div>
    </div>
@else
    <div class="text-center text-gray-500 dark:text-gray-400">
        <p>Post not found or doesn't exist.</p>
    </div>
@endif
