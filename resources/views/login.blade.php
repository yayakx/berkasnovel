@extends('header')

<nav class="navbar navbar-expand-lg navbar-dark bg-main ps-3 pe-3">
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
            {{-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Donasi</a>                       
    </li> --}}
        </ul>
        <a href="/tambahft"><button class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1">Ingin Mendaftarkan
                FT?</button></a>
        <button class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" data-bs-toggle="modal"
            data-bs-target="#staytune"><i class="fa fa-user"></i> Daftar</button>
        <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/login"><i class="fa fa-sign-in-alt"></i> Masuk</a>
    </div>
</nav>

<div class="container"><br>
    <div class="col-md-4 mx-auto mt-5">
        <h2 class="text-center"><b>BerkasNovel</b></h2>
        <h6 class="text-center">Tempatnya Update Novel Translasi Terbaru</h6>
            <hr>
            @if (session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('p_login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group mt-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary col-lg-12 col-md-12 mt-2">Log In</button>
                <hr>
                <p class="text-center">Belum punya akun? <a href="#" class="none">Daftar</a> sekarang!</p>
            </form>
    </div>
</div>
