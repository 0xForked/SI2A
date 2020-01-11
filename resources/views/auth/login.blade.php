@extends('layouts._body.auth')

@section('title', 'Login')

@section('content')
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img
                        src="{{ asset('assets/img/sites/' . app_settings()['site_logo']->value) }}"
                        alt="logo" width="80"
                        class="shadow-light mb-5 mt-2"
                    >
                    <h4 class="text-dark font-weight-normal">
                        Selamat Datang di
                        <span class="font-weight-bold">{{ app_settings()['site_title']->value }}</span>
                    </h4>
                    <p class="text-muted">
                        Sebelum Anda mulai, Anda harus masuk atau mendaftar jika Anda belum memiliki akun.
                    </p>

                    <form method="POST" class="needs-validation" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="d-block">
                                <label for="identity" class="control-label">{{ __('Alamat E-Mail atau Username') }}</label>
                            </div>

                            <input id="identity" type="text" class="form-control @error('identity') is-invalid @enderror" name="identity" value="{{ old('identity') }}" required tabindex="1" autofocus>

                            @error('identity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">{{ __('Kata Sandi') }}</label>
                            </div>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" tabindex="2">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember"> {{ __('Ingat saya') }}</label>
                            </div>
                        </div>


                        <div class="form-group text-right">
                            @if (Route::has('password.request'))
                                <a onclick="showLoading()" href="{{ route('password.request') }}" class="float-left mt-3">
                                    Lupa kata sandi?
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                {{ __('Masuk') }}
                            </button>
                        </div>

                        @if (Route::has('register'))
                            <div class="mt-5 text-center">
                                Belum punya akun? <a onclick="showLoading()" href="{{ route('register') }}">Buat baru</a>
                            </div>
                        @endif
                    </form>
                    @include('auth.items.footer-nav')
                </div>
            </div>
            @include('auth.items.background-walk')
        </div>
    </section>
@endsection
