@extends('main')

@section('main')
    <div class="card col-md-8 ms-auto">
        <div class="card-body">
            <div class="card-header bg-main text-white row content">
                <h4 class="text-white col-md-10">List Update Novel Terbaru ({{count($items)}})</h4>
                <button class="btn btn-outline-light col-md-2 ms-auto refresh" onclick="location.reload()"><span><i
                            class="fa fa-sync-alt" aria-hidden="true"></i></span></button>
            </div>
            <div class="container row mt-3">
                {{-- <div class="d-flex justify-content-between text-center">    
                    <p class="card-text col-md-5"><a>Judul</a></p>
                    <p class="card-text col-md-1"><a>Terbit</a></p>
                    <p class="card-text col-md-2"><a>FT</a></p>
                    <p class="card-text col-md-4"><a>Thumb</a></p>
                </div>
                <div class="scrolling-pagination">
                @foreach ($items as $item)    
                <div class="d-flex justify-content-between">                        
                    <p class="card-text col-md-5"><a href="{{ $item->get_permalink() }}" target="_blank">{{ $item->get_title() }}</a></p>
                    <p class="card-text text-center col-md-1"><small>{{ $item->get_date('j F Y') }}</small></p>
                    <p class="card-text text-center col-md-2"><a href="{{ $item->get_base() }}">{{ $item->get_base()}}</a></p>
                    <p class="card-text text-center col-md-4"><img src="{{ $item->get_enclosure()->get_thumbnail() }}" weight="100" height="100"></p>
                </div>             
                @endforeach 
                </div> --}}

                @foreach ($items as $item)
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
