@extends('layouts.app')

@section('title', 'Anmeldung')

@section('content')

    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Login</h2>

                        @if(session('status'))
                            <p>{{ session('status') }}</p>
                        @endif

                        <p>Please login, to access all features.</p>

                        <!-- Form -->
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your E-Mail<span>*</span></label>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="John.Doe@example.com" required
                                               autofocus/>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Password<span>*</span></label>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="********" required/>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                               
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="lost-pass">Forgot Password?</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->

@endsection
