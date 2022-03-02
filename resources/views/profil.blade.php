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
                {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Donasi</a>                       
        </li> --}}
            </ul>
            <a href="#" data-bs-toggle="modal" data-bs-target="#staytune"><button
                    class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1">Ingin Mendaftarkan
                    FT?</button></a>
            @if (Auth::check() == true)
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="#" data-bs-toggle="modal"
                    data-bs-target="#staytune"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/logout"><i class="fa fa-sign-out-alt"></i>
                    Keluar</a>
            @else
                <button class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" data-bs-toggle="modal"
                    data-bs-target="#staytune"><i class="fa fa-user"></i> Daftar</button>
                <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/login"><i class="fa fa-sign-in-alt"></i>
                    Masuk</a>
            @endif

        </div>
    </nav>



    <div class="row mt-3 me-0">

        @if (session('success'))
            <div class="col-md-8 ms-auto alert alert-success">
                <b>Selamat!</b> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="col-md-8 ms-auto alert alert-danger">
                <b>Opps!</b> {{ session('error') }}
            </div>
        @endif

        <div class="col-lg-4 sidemenu mt-4">
            <div class="card">
                <div class="card-header bg-main"></div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted ">{{ Auth::user()->email }}</h6>
                    <p class="card-text">Joined since {{ Auth::user()->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-main row me-0 ms-0">
                    <h5 class="text-white col-md-8">My Private List</h5>
                    <button class="btn btn-outline-light ms-auto col-md-4" data-bs-toggle="modal"
                        data-bs-target="#tambah_private"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="card-body  ps-3 pe-3">
                    <div class="col-md mt-1">
                        <form action="/carift_private" method="post">
                            @csrf
                            <select class="form-control mb-2" name="nama_ft" id="nama_ft" readonly>
                                @foreach ($listftall as $dataft)
                                    <option value="{{ $dataft->url_ft }}">{{ $dataft->nama_ft }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-secondary col-md-12 mt-1">Cari Update
                                Terbaru</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 ms-auto">
            @yield('main')
        </div>

    </div>

    <div class="modal fade" id="tambah_private" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="staticBackdropLabel">Tambah Private List</h5>
                </div>
                <div class="modal-body">                    
                    <form action="/tambahft_private" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama FT</label>
                            <input type="text" name="nama_ft" id="nama_ft" class="form-control"
                                placeholder="Masukkan Nama FT" aria-describedby="helpId">
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Link FT</label>
                            <input type="text" name="url_ft" id="url_ft" class="form-control"
                                placeholder="Contoh: https://kiminovel.com" aria-describedby="helpId">
                        </div>
                        <button class="btn btn-dark mt-3 col-md-12" type="submit"> Tambahkan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    