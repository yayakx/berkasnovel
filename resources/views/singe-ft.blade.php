@extends('main')

@section('main')
    <div class="row">

        <div class="card border-top-0 me-0 bg-main col-md-3">
            <div class="card border-0 bg-main text-white row ms-0">
                <div class="card-header text-white">
                    <h5>Informasi FT</h5>
                    <hr>
                </div>
                <div>
                    @if (isset($ft->fp))
                        <iframe
                            src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%MaouNovelIndo&tabs&width=340&height=170&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=366781520125931"
                            height="80px" class="mx-auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowfullscreen="true"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    @else
                        <h5>Belum ada Data FP yang terdaftar untuk FT ini</h5>
                    @endif
                    <hr>
                </div>
                <div class="d-block">
                    <h5 class="text-secondary">Nama FT</h5>
                    <span>{{ $ft->nama_ft ?? '-'}}</span>
                </div>
                <div class="d-block mt-3">
                    @php
                        $url = $ft->url_ft;        
                        $parsedUrl = parse_url($url);        
                        $mainUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
                    @endphp
                    <h5 class="text-secondary">URL FT</h5>
                    <span><a href="{{ $mainUrl ?? '#' }}" target="_blank">{{ $mainUrl ?? '-' }}</a></span>
                </div>
                <div class="d-block mt-3">
                    <h5 class="text-secondary">Total Rilisan</h5>
                    <span>{{ $total_rilis ?? '-' }}</span>
                </div>
            </div>


        </div>

        <div class="card border-top-0 me-0 bg-main col-md-9">
            <div class="card-body">
                <div class="card-header bg-main text-white row">
                    <h4 class="text-white col-md-10">List Update Novel Terbaru Dari {{ $ft->nama_ft }}</h4>
                    <button class="btn btn-outline-light col-md-2 ms-auto refresh" onclick="location.reload()"><span><i
                                class="fa fa-sync-alt" aria-hidden="true"></i></span></button>
                </div>
                <div class="row mx-auto mt-3">
                    @foreach ($items as $item)
                        <div class="card bg-main card-hover border-0 col-lg-2 col-md-2 text-center" data-aos="fade-down">
                            <a href="{{ $item->permalink }}" target="_blank">
                                <img src="{{ $item->thumb }}" width="120" height="120" class="mx-auto mt-2">
                                <div class="card-body d-flex flex-column h-100 text-center">
                                    <a href="{{ $item->permalink }}" class="font-12 space-2 none"
                                        target="_blank">{{ $item->title }}</a>
                                    <div class="row pt-2 mt-auto">
                                        <span class="btn btn-dark">{{ $item->ft }}</span>
                                        <h6 class="card-subtitle mb-2 text-muted mt-2">
                                            <small>{{ date('d F Y', $item->timestamp) }}</small>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
            {{-- Pagination --}}
            <div class="mx-auto d-block mb-5">
                {{-- {{ $items->links('pagination') }} --}}
                @if (isset($id))
                    {{ $items->appends(['id' => $id])->links('pagination') }}
                @else
                    {{ $items->links('pagination') }}
                @endif
            </div>
        </div>
    </div>
@endsection
