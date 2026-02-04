<style>
.pagination-dots {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 20px 0;
}

.pagination-dots .arrow-btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s;
}

.pagination-dots .arrow-btn.active {
    background-color: #ed3a85;
    color: white;
}

.pagination-dots .arrow-btn.active:hover {
    background-color: #d9286c;
}

.pagination-dots .arrow-btn.disabled {
    background-color: #ebe5ea;
    color: #af9cab;
    cursor: not-allowed;
}

.pagination-dots .arrow-btn:not(.disabled):not(.active) {
    background-color: #dbd1d8;
    color: #513741;
}

.pagination-dots .arrow-btn:not(.disabled):not(.active):hover {
    background-color: #af9ca3;
}

.pagination-dots .dots-container {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pagination-dots .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #d1d5db;
    transition: all 0.3s;
}

.pagination-dots .dot.active {
    width: 12px;
    height: 12px;
    background-color: #ed3a88;
}

.pagination-dots .dot:not(.active) {
    cursor: pointer;
}

.pagination-dots .dot:not(.active):hover {
    background-color: #fa8bc8;
}
</style>

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-dots">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="arrow-btn disabled">
                &#8249;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="arrow-btn">
                &#8249;
            </a>
        @endif

        {{-- Pagination Dots --}}
        <div class="dots-container">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="dot"></span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="dot active"></span>
                        @else
                            <a href="{{ $url }}" class="dot"></a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="arrow-btn active">
                &#8250;
            </a>
        @else
            <span class="arrow-btn disabled">
                &#8250;
            </span>
        @endif
    </nav>
@endif