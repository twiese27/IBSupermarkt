@extends('layouts.app')

@section('title', 'Registrieren')

@section('content')

    <!-- Shop Login -->
    <section class="shop login section">
      <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3 col-12">
        <div class="login-form">
          <h2>Registrieren</h2>
          <p>Bitte registrieren Sie sich, um schneller auszuchecken</p>
          <!-- Form -->
          <form class="form" method="post" action="#">
          <div class="row">
            <div class="col-12">
            <div class="form-group">
              <label>Ihr Name<span>*</span></label>
              <input
              type="text"
              name="name"
              placeholder=""
              required="required"
              />
            </div>
            </div>
            <div class="col-12">
            <div class="form-group">
              <label>Ihre E-Mail<span>*</span></label>
              <input
              type="text"
              name="email"
              placeholder=""
              required="required"
              />
            </div>
            </div>
            <div class="col-12">
            <div class="form-group">
              <label>Ihr Passwort<span>*</span></label>
              <input
              type="password"
              name="password"
              placeholder=""
              required="required"
              />
            </div>
            </div>
            <div class="col-12">
            <div class="form-group">
              <label>Passwort bestätigen<span>*</span></label>
              <input
              type="password"
              name="password"
              placeholder=""
              required="required"
              />
            </div>
            </div>
            <div class="col-12">
            <div class="form-group login-btn">
              <button class="btn" type="submit">Registrieren</button>
              <a href="{{ route('login') }}" class="btn">Anmelden</a>
            </div>
            <div class="checkbox">
              <label class="checkbox-inline" for="2"
              ><input name="news" id="2" type="checkbox" />Für Newsletter anmelden</label
              >
            </div>
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
