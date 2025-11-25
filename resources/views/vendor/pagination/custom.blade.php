@if ($paginator->hasPages())
    <div class="btn">
        @if (!$paginator->onFirstPage())
            <button>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class='bx bx-chevron-left'></i>
                </a>
            </button>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button>
                            {{ $page }}
                        </button>
                    @else
                        <button>
                            <a href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <button>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <i class='bx bx-chevron-right'></i>
                </a>
            </button>
        @endif
    </div>
@endif
