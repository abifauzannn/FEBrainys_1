@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <span class="block px-3 py-2 text-gray-400 rounded-md cursor-not-allowed">&laquo;</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="block px-3 py-2 text-blue-600 rounded-md hover:bg-blue-100 focus:outline-none focus:bg-blue-100"
                rel="prev" aria-label="{{ __('pagination.previous') }}">&laquo;</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="block px-3 py-2 text-blue-600 rounded-md hover:bg-blue-100 focus:outline-none focus:bg-blue-100"
                rel="next" aria-label="{{ __('pagination.next') }}">&raquo;</a>
        @else
            <span class="disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <span class="block px-3 py-2 text-gray-400 rounded-md cursor-not-allowed">&raquo;</span>
            </span>
        @endif
    </nav>
@endif
