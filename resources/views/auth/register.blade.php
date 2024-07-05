@extends('layouts.auth')

@section('main')
<style>
    body{
        background-image: url('admin/assets/img/kua.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-2">
                    <img style="width: 150px" src="{{url('admin/assets/img/logo.png')}}" alt="">
                </div>
                <h1 class="mt-2 text-white text-center">SISTEM INFORMASI ADMINISTRASI PERSURATAN</h1>
                <h1 class="mt-2 text-white text-center">KUA GONDOKUSUMAN</h1>
            </div>
            <style>
                .contact{
                    position: absolute;
                    background: red;
                    width: 100%;
                    /*background: red;*/
                }

                .contact .wa{
                    position: absolute;
                    right: 10px;
                    top: 10px;
                }
            </style>
            <div class="text-white contact">
                <div class="wa">
                    Kontak Admin: 085891354306
                </div>
            </div>
            <div class="col-lg-5">
                <!-- Basic login form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light py-1">Register</h3>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}    
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}    
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- Login form-->
                        <form action="/register" method="post">
                            @csrf
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="nik">Username</label>
                                <input class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" type="text" value="{{ old('nik') }}" placeholder="Enter Username" autofocus required/>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Masukan password" required/>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="password_confirmation">Ulangi Password</label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" type="password " placeholder="Ulangi password" required/>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (remember password checkbox)-->
<!--                             <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                    <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
                                </div>
                            </div> -->
                            <!-- Form Group (login box)-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="{{route('login')}}">
                                    Login
                                </a>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection