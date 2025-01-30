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
          <form class="form" method="POST" action="{{ route('loginPost') }}">

            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Ihre E-Mail<span>*</span></label>
                  <input type="email" name="email" placeholder="John.Doe@example.com" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Ihr Passwort<span>*</span></label>
                  <input type="password" name="password" placeholder="********" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group login-btn">
                  <button class="btn" type="submit">Anmelden</button>
                  <a href="{{ route('register') }}" class="btn">Registrieren</a>
                </div>
                <a href="#" class="lost-pass">Passwort vergessen?</a>
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