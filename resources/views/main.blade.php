@extends('header')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-main ps-3 pe-3" style="position:sticky; top:0;z-index:99;">
        <a class="navbar-brand" href="/">
            <h5>BerkasNovel</h5>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staytune">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/private">Private List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/list_reqft">List Request FT</a>
                </li>
                {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Donasi</a>                       
        </li> --}}
            </ul>
            <a href="#" data-bs-toggle="modal" data-bs-target="#req_ft"><button
                    class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1">Ingin Mendaftarkan
                    FT?</button></a>
            @if (Auth::check() == true)
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/profil"><i class="fa fa-user"></i>
                    {{ Auth::user()->name }}</a>
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/logout"><i class="fa fa-sign-out-alt"></i>
                    Keluar</a>
            @else
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/daftar"><i class="fa fa-user"></i>
                    Daftar</a>
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/login"><i class="fa fa-sign-in-alt"></i>
                    Masuk</a>
            @endif

        </div>
    </nav>



    <div class="row me-0">

        <div class="col-md-4 sidemenu">

            <div class="card border-0">
                <iframe
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBerkasNovel&tabs&width=340&height=70&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=366781520125931"
                    height="80px" class="mx-auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>

            <div class="card me-auto h-10">
                <div class="card-body container">
                    <div class="card-header bg-main">
                        <a href="/daftarft" class="none">
                            <h4 class="text-white">FT Terdaftar</h4>
                        </a>
                    </div>
                    <div class="row">
                        @foreach ($listft as $dataft)
                            <div class="col-lg-4 col-sm-4 w-auto" data-aos="fade-down">
                                <h5 class="card-text mt-2"><a class="namaft badge rounded-pill none"
                                        href="{{ str_replace(['rss.xml', 'feed'], '', $dataft->url_ft) }}"
                                        target="_blank">{{ $dataft->nama_ft }}</a></h5>
                            </div>
                        @endforeach
                        <h5 class="col-md card-text mt-2"><a class="namaft badge rounded-pill none"
                                href="/daftarft">Selengkapnya...</a></h5>
                    </div>
                </div>
            </div>

            <div class="card me-auto h-10 col-md">
                <div class="card-body">
                    <h4 class="card-header bg-main text-white">Novel Berdasarkan FT</h4>
                    <div>
                        <div>
                            <div class="col-md mt-3">
                                <form action="/carift" method="post">
                                    @csrf
                                    <select class="form-control col-md mb-2 mw-100" name="nama_ft" id="nama_ft" readonly>
                                        @foreach ($listftall as $dataft)
                                            <option value="{{ str_replace(['rss.xml', 'feed'], '', $dataft->url_ft) }}">
                                                {{ $dataft->nama_ft }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-secondary col-md-12 mt-1">Cari Update
                                        Terbaru</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card me-auto h-10 col-md">
                <div class="card-body">
                    <h4 class="card-header bg-main text-white">Cari Novel</h4>
                    <div>
                        <div>
                            <div class="col-md">
                                <form class="form-inline" action="/carinovel" method="post">
                                    @csrf
                                    <div class="form-group mb-2 mt-3">
                                        <input type="text" class="form-control" id="cari" name="cari"
                                            placeholder="Judul Novel" value="{{ old('cari') }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark col-md-12"><i class="fa fa-search"
                                            aria-hidden="true"></i> Cari Novel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-8 ms-auto">
            @if (session('success'))
                <div class="col-md-12 mt-2 ms-auto alert alert-success">
                    <b>Selamat!</b> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="col-md-12 mt-2 ms-auto alert alert-danger">
                    <b>Opps!</b> {{ session('error') }}
                </div>
            @endif

            @yield('main')
        </div>

    </div>



    <!-- Modal Stay Tuned -->
    <div class="modal fade" id="staytune" z-index="99" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Stay Tuned ^^</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
