@if ($paginator->hasPages())

    <dir class="row">
        <div class="col align-self-center">
            <div class="pagination-info">
                Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de un total de {{ $paginator->total() }} resultados.
            </div>
        </div>
    </dir>

    <div class="row">
        <div class="col align-self-center offset-md-4">
            <ul class="pagination">
                <!-- Pagination Elements -->
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active page-link"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
@endif
