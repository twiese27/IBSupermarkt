@extends('layouts.app')

@section('title', 'Login')

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
          <p>Please login, the access all features.</p>
          

          <!-- Form -->
          <form class="form" method="POST" action="{{ route('loginPost') }}">

            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Your E-Mail<span>*</span></label>
                  <input type="email" name="email" placeholder="John.Doe@example.com" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Your password<span>*</span></label>
                  <input type="password" name="password" placeholder="********" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group login-btn">
                  <button class="btn" type="submit">Login</button>
                  <a href="{{ route('register') }}" class="btn">Register</a>
                </div>
                <a href="#" class="lost-pass">Forgot password?</a>
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