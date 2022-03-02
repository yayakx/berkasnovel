@extends('profil')

@section('main')
<div class="card border-top-0 me-0">
        <div class="card-header bg-main text-white row content">
            <h4 class="text-white col-md-10">Private List Update Novel Terbaru (Dari {{count($listftall)}} FT)</h4>
            <button class="btn btn-outline-light col-md-2 ms-auto refresh" onclick="location.reload()"><span><i
                        class="fa fa-sync-alt" aria-hidden="true"></i></span></button>
        </div>
        <div class="container row mt-3">
            @foreach ($items as $item)
                <div class="card card-hover col-lg-3 col-md-3 text-center">
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
        <div class="d-block mx-auto mb-5">
            {{ $items->links('p_pagination') }}
        </div>
    </div>
    {{-- Pagination --}}
    
    <div class="text-center mb-2 mt-5">
        Copyright &copy; 2022 <strong><a href="/" class="none"> BerkasNovel </a></strong>
    </div>
@endsection


