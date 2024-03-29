@extends('main')

@section('main')
    <div class="card border-top-0 me-0 bg-main">
        <div class="card-body">
            {{-- <div class="card-header bg-main text-white row content">
                <h4 class="text-white col-md-10">List Update Novel Terbaru (Dari {{ $listftall->count() }} FT)</h4>
                <button class="btn btn-outline-light col-md-2 ms-auto refresh" onclick="location.reload()"><span><i
                            class="fa fa-sync-alt" aria-hidden="true"></i></span></button>
            </div> --}}
            <div class="row mx-auto mt-3">
                @foreach ($items as $item)
                    <div class="card bg-main card-hover border-0 col-lg-2 col-md-2 text-center" data-aos="fade-down">
                        <a href="{{ $item->permalink }}" target="_blank">
                            <img src="{{ $item->thumb }}" width="120" height="120" class="mx-auto mt-2">
                            <div class="card-body d-flex flex-column h-100 text-center">
                                <a href="{{ $item->permalink }}" class="font-12 space-2 none"
                                    target="_blank">{{ $item->title }}</a>
                                <div class="row pt-2 mt-auto">
                                    <span class="btn btn-dark">{{$item->ft}}</span>
                                    <h6 class="card-subtitle mb-2 text-muted mt-2">
                                        <small>{{ date('d F Y', $item->timestamp) }}</small>
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- @foreach ($items as $item)
                    <div class="card card-hover col-lg-3 col-md-3 text-center" data-aos="fade-down">
                        <a href="{{ $item->get_permalink() }}" target="_blank">
                            @php
                                $thumb = $item->get_enclosure()->get_thumbnail();
                                if ($thumb == null) {
                                    $thumb = 'https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg';
                                }
                            @endphp
                            <img src="{{ $thumb }}" width="120" height="120" class="mx-auto mt-2">
                            <div class="card-body text-center">
                                <a href="{{ $item->get_permalink() }}" class="font-12 space-2 none"
                                    target="_blank">{{ $item->get_title() }}</a>
                                <h6 class="card-subtitle mb-2 text-muted mt-2">
                                    <small>{{ $item->get_date('j F Y') }}</small>
                                </h6>
                            </div>
                        </a>
                    </div>
                @endforeach --}}
            </div>
        </div>
        {{-- Pagination --}}
        <div class="mx-auto d-block mb-5">
            {{-- {{ $items->links('pagination') }} --}}
            @if(isset($kw))
                {{ $items->appends(['kw' => $kw])->links('pagination') }}
            @else
                {{ $items->links('pagination') }}
            @endif
        </div>       
    </div>   
@endsection
