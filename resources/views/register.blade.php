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
          <p>Werde Teil der IBSupermarkt Community</p>
          <!-- Form -->
          <form class="form" method="post" action="{{ route('register.store') }}">
            @csrf <!-- CSRF protection, sonst gibt es den Fehler 419 aus Sicherheitsgründen -->
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Vorname<span>*</span></label>
                  <input type="text" name="forename" placeholder="Leonardo" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Zweiter Vorname</label>
                  <input type="text" name="middle_name" placeholder="Di" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Nachname<span>*</span></label>
                  <input type="text" name="lastname" placeholder="Caprio" required="required"/>
                </div>
              </div>   
              <div class="col-12">
                <div class="form-group">
                  <label>Straße (Street)</label>
                  <input type="text" name="street" placeholder="Wallstreet"/>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Hausnummer (House Number)</label>
                  <input type="text" name="house_number" placeholder="1" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Postleitzahl (Postal Code)<span>*</span></label>
                  <input type="text" name="postal_code" placeholder="10005" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Stadt (City)</label>
                  <input type="text" name="city" placeholder="New York"/>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Land</label>
                  <input type="text" name="country" placeholder="USA" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>IBAN</label>
                  <input type="text" name="iban" placeholder="US12345678901234567890" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Geburtsdatum (Birth Date)</label>
                  <input type="date" name="birth_date" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>E-Mail-Adresse<span>*</span></label>
                  <input type="email" name="email" placeholder="Leonardo.Di@Caprio.com" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Passwort<span>*</span></label>
                  <input type="text" name="password" placeholder="****" required="required" />
                </div>
              </div>
              <div class="col-12">
                <label>Lieblingsbier</label>
                <div class="form-group" id="favorite_beer">
                  <select name="favorite_beer" >
                    <option value="Heineken1">Heineken</option>
                    <option value="Heineken2">Heineken</option>
                    <option value="Heineken3">Heineken</option>
                    <option value="Heineken4">Heineken</option>
                    <option value="Heineken5">Heineken</option>
                    <option value="Heineken6">Heineken</option>
                    <option value="Heineken7">Heineken</option>
                    <option value="Oettinger">Öttinger</option>
                    <option value="Andere Ploere">Andere Plöre</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group login-btn">
                  <button class="btn" type="submit">Registrieren</button>
                  <a href="{{ route('login') }}" class="btn">Anmelden</a>
                </div>
                <div class="checkbox">
                  <label class="checkbox-inline checked" for="newsletter">
                    <input name="newsletter" id="newsletter" type="checkbox" /> Für Newsletter anmelden
                  </label>
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