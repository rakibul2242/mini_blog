@props(['post'])

@if ($post)
    <div
        {{ $attributes->merge(['class' => 'p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden']) }}>
        @if ($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                class="w-full max-h-96 object-cover mb-6 rounded-md shadow-lg">
        @else
            <img src="https://placehold.co/800x400/cccccc/333333?text=No+Image+Available" alt="{{ $post->title }}"
                class="w-full max-h-96 object-cover mb-6 rounded-md shadow-lg">
        @endif

        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-2">
            <span><strong>Category:</strong> {{ $post->category }}</span>
            <span><strong>Date:</strong> {{ $post->created_at->format('F j, Y') }}</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            {{ $post->title }}
        </h2>

        <p class="text-gray-700 dark:text-gray-300 mb-4 text-base leading-relaxed">
            {!! $post->content !!}
        </p>
    </div>
@else
    <div class="text-center text-gray-500 dark:text-gray-400">
        <p>Post not found or doesn't exist.</p>
    </div>
@endif
