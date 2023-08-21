@extends('main')

@section('main')

<div class="card bg-main border-top-0 me-0">    
    <div class="card border-top-0 me-0 bg-main">
        <div class="card-body">
                        
            <div class="row mx-auto mt-3">
                @foreach ($listftall as $item)                
                @php
                    if ($item->url_ft == null || $item->url_ft == '') {
                        continue;
                    }
                    $link = str_replace(array('rss.xml', '/feed'), '', $item->url_ft);
                @endphp
                    <div class="card bg-main card-hover border-0 col-lg-2 col-md-2 text-center" data-aos="fade-down">
                        <a href="/ft?id={{$item->id_ft}}" style="text-decoration: none">                            
                            <div class="card-body d-flex flex-column h-100 text-center">
                                <h4>{{ $item->nama_ft }}</h4>
                                <div class="row pt-2 mt-auto">                                    
                                    <h6 class="card-subtitle mb-2 text-muted mt-2" style="font-size: 9pt">
                                        <small>{{ $link }}</small>
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                
            </div>
        </div>               
    </div>   

@endsection