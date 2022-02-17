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
            <li class="nav-item">
                <a class="nav-link" href="/private">Private List</a>
            </li>
            {{-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Donasi</a>                       
    </li> --}}
        </ul>
        <a href="/tambahft"><button class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1">Ingin Mendaftarkan
                FT?</button></a>
        <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/daftar"><i class="fa fa-user"></i> Daftar</a>
        <a class="btn btn-outline-light my-2 my-sm-0 me-1 ms-1" href="/login"><i class="fa fa-sign-in-alt"></i>
            Masuk</a>
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
        <form action="{{ route('p_daftar') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group mt-2">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required="">
                <label for="">Konfirmasi Kata sandi</label>
                <input type="password" name="password_confirmation" id="confirm_password" class="form-control"
                    minlength="6" placeholder="Ulangi Kata sandi" onkeyup='check();' required>
                <div id="message" class="alert alert-danger mt-3 mb-0">
                    <p class="mb-0"><i class="fa fa-info-circle"></i> Kata sandi terdiri dari 6-12 karakter
                    </p>
                    <p class="mb-0"><i class="fa fa-info-circle"></i> Pastikan Anda mengulangi kata sandi Anda
                        dengan benar</p>
                </div>
            </div>
            <button id="submit_daftar" type="submit"
                class="btn btn-primary col-lg-12 col-md-12 mt-2 disabled">Daftar</button>
            <hr>
            <p class="text-center">Sudah punya akun? <a href="/login" class="none">Masuk</a> Yuk!</p>
        </form>
    </div>
</div>

<script>
    var check = function() {
        if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
            document.getElementById('submit_daftar').classList.remove("disabled");
            document.getElementById('message').style.display = "none";
        } else {
            document.getElementById('submit_daftar').classList.add("disabled");
            document.getElementById('message').style.display = "block";
        }
    }
</script>
