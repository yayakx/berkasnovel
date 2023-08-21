<style>
    ul {
        list-style-type: none;
    }

    li {
        float: left;
        padding: 10px;
    }
</style>

@if ($paginator->hasPages())
    <ul class="">
       
        @if ($paginator->onFirstPage())
            <li class="disabled"><span></span></li>
        @else
            <li><a class="btn btn-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Sebelumnya</a></li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active btn btn-dark text-primary"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="btn btn-dark" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li><a class="btn btn-dark" href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya →</a></li>
        @else
            <li class="disabled"><span>Selanjutnya →</span></li>
        @endif
    </ul>
@endif 