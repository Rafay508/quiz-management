@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class='mt-3'>
        <ul class="pagination justify-content-center align-items-center">

            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled mx-md-3 mx-2"><span class="page-link">FIRST</span></li>
            @else
                <li class="page-item  mx-md-3 mx-2"><a class="page-link" href="{{ $paginator->url(1) }}">FIRST</a></li>
            @endif


            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled  mx-md-3 mx-2"><span class="page-link">PREV</span></li>
            @else
                <li class="page-item  mx-md-3 mx-2"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">PREV</a></li>
            @endif

            {{-- Current Page Indicator --}}
            <li class="page-item disabled  mx-md-3 mx-2">
                <span class="fw-bold">
                    Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
                </span>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item  mx-md-3 mx-2"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">NEXT</a></li>
            @else
                <li class="page-item disabled  mx-md-3 mx-2"><span class="page-link">NEXT</span></li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item  mx-md-3 mx-2"><a class="page-link"
                        href="{{ $paginator->url($paginator->lastPage()) }}">LAST</a>
                </li>
            @else
                <li class="page-item disabled  mx-md-3 mx-2"><span class="page-link">LAST</span></li>
            @endif

        </ul>
    </nav>
@endif
