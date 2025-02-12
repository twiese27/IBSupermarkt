@extends('layouts.app')

@section('title', 'Anmeldung')

@section('content')

    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Anmeldung</h2>

                        @if(session('status'))
                            <p>{{ session('status') }}</p>
                        @endif

                        <p>Bitte anmelden, um den vollen Funktionsumfang des Shops zu erleben</p>

                        <!-- Form -->
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Ihre E-Mail<span>*</span></label>
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
                                        <label>Ihr Passwort<span>*</span></label>
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
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Angemeldet bleiben
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn btn-primary" type="submit">Anmelden</button>
                                        <a href="{{ route('register') }}" class="btn btn-secondary">Registrieren</a>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="lost-pass">Passwort
                                            vergessen?</a>
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
