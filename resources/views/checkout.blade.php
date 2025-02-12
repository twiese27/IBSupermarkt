@extends('layouts.app')

@section('title', 'Kasse')

@section('content')

<!-- Start Checkout -->
<section class="shop checkout section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-12">
        <div class="checkout-form">
          <h2>Kasse</h2>
          <!-- Form -->
          <form class="form" method="post" action="#">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Vorname<span>*</span></label>
                  <input type="text" name="name" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Nachname<span>*</span></label>
                  <input type="text" name="name" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Email<span>*</span></label>
                  <input type="email" name="email" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Telefonnummer<span>*</span></label>
                  <input type="text" name="number" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Land<span>*</span></label>
                  <select name="country_name" id="country">
                    <option value="AF">Afghanistan</option>
                    <option value="AX">Ålandinseln</option>
                    <option value="AL">Albanien</option>
                    <option value="DZ">Algerien</option>
                    <option value="AS">Amerikanisch-Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarktis</option>
                    <option value="AG">Antigua und Barbuda</option>
                    <option value="AR">Argentinien</option>
                    <option value="AM">Armenien</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australien</option>
                    <option value="AT">Österreich</option>
                    <option value="AZ">Aserbaidschan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesch</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Weißrussland</option>
                    <option value="BE">Belgien</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivien</option>
                    <option value="BA">Bosnien und Herzegowina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvetinsel</option>
                    <option value="BR">Brasilien</option>
                    <option value="IO">
                      Britisches Territorium im Indischen Ozean
                    </option>
                    <option value="VG">Britische Jungferninseln</option>
                    <option value="BN">Brunei</option>
                    <option value="BG">Bulgarien</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Kambodscha</option>
                    <option value="CM">Kamerun</option>
                    <option value="CA">Kanada</option>
                    <option value="CV">Kap Verde</option>
                    <option value="KY">Kaimaninseln</option>
                    <option value="CF">Zentralafrikanische Republik</option>
                    <option value="TD">Tschad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Weihnachtsinsel</option>
                    <option value="CC">Kokosinseln</option>
                    <option value="CO">Kolumbien</option>
                    <option value="KM">Komoren</option>
                    <option value="CG">Kongo - Brazzaville</option>
                    <option value="CD">Kongo - Kinshasa</option>
                    <option value="CK">Cookinseln</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Elfenbeinküste</option>
                    <option value="HR">Kroatien</option>
                    <option value="CU">Kuba</option>
                    <option value="CY">Zypern</option>
                    <option value="CZ">Tschechische Republik</option>
                    <option value="DK">Dänemark</option>
                    <option value="DJ">Dschibuti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominikanische Republik</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Ägypten</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Äquatorialguinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estland</option>
                    <option value="ET">Äthiopien</option>
                    <option value="FK">Falklandinseln</option>
                    <option value="FO">Färöer</option>
                    <option value="FJ">Fidschi</option>
                    <option value="FI">Finnland</option>
                    <option value="FR">Frankreich</option>
                    <option value="GF">Französisch-Guayana</option>
                    <option value="PF">Französisch-Polynesien</option>
                    <option value="TF">
                      Französische Süd- und Antarktisgebiete
                    </option>
                    <option value="GA">Gabun</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgien</option>
                    <option value="DE">Deutschland</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Griechenland</option>
                    <option value="GL">Grönland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard und McDonaldinseln</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hongkong</option>
                    <option value="HU">Ungarn</option>
                    <option value="IS">Island</option>
                    <option value="IN">Indien</option>
                    <option value="ID">Indonesien</option>
                    <option value="IR">Iran</option>
                    <option value="IQ">Irak</option>
                    <option value="IE">Irland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italien</option>
                    <option value="JM">Jamaika</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordanien</option>
                    <option value="KZ">Kasachstan</option>
                    <option value="KE">Kenia</option>
                    <option value="KI">Kiribati</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kirgisistan</option>
                    <option value="LA">Laos</option>
                    <option value="LV">Lettland</option>
                    <option value="LB">Libanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libyen</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Litauen</option>
                    <option value="LU">Luxemburg</option>
                    <option value="MO">Macau</option>
                    <option value="MK">Mazedonien</option>
                    <option value="MG">Madagaskar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Malediven</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshallinseln</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauretanien</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexiko</option>
                    <option value="FM">Mikronesien</option>
                    <option value="MD">Moldawien</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolei</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Marokko</option>
                    <option value="MZ">Mosambik</option>
                    <option value="MM">Myanmar [Burma]</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Niederlande</option>
                    <option value="AN">Niederländische Antillen</option>
                    <option value="NC">Neukaledonien</option>
                    <option value="NZ">Neuseeland</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolkinsel</option>
                    <option value="MP">Nördliche Marianen</option>
                    <option value="KP">Nordkorea</option>
                    <option value="NO">Norwegen</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">
                      Palästinensische Autonomiegebiete
                    </option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua-Neuguinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippinen</option>
                    <option value="PN">Pitcairninseln</option>
                    <option value="PL">Polen</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Katar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Rumänien</option>
                    <option value="RU">Russland</option>
                    <option value="RW">Ruanda</option>
                    <option value="BL">Saint-Barthélemy</option>
                    <option value="SH">St. Helena</option>
                    <option value="KN">St. Kitts und Nevis</option>
                    <option value="LC">St. Lucia</option>
                    <option value="MF">Saint-Martin</option>
                    <option value="PM">Saint-Pierre und Miquelon</option>
                    <option value="VC">
                      St. Vincent und die Grenadinen
                    </option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">São Tomé und Príncipe</option>
                    <option value="SA">Saudi-Arabien</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbien</option>
                    <option value="SC">Seychellen</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapur</option>
                    <option value="SK">Slowakei</option>
                    <option value="SI">Slowenien</option>
                    <option value="SB">Salomonen</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">Südafrika</option>
                    <option value="GS">
                      Südgeorgien und die Südlichen Sandwichinseln
                    </option>
                    <option value="KR">Südkorea</option>
                    <option value="ES">Spanien</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard und Jan Mayen</option>
                    <option value="SZ">Swasiland</option>
                    <option value="SE">Schweden</option>
                    <option value="CH">Schweiz</option>
                    <option value="SY">Syrien</option>
                    <option value="TW">Taiwan</option>
                    <option value="TJ">Tadschikistan</option>
                    <option value="TZ">Tansania</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad und Tobago</option>
                    <option value="TN">Tunesien</option>
                    <option value="TR">Türkei</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks- und Caicosinseln</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">Vereinigte Arabische Emirate</option>
                    <option value="US">Vereinigtes Königreich</option>
                    <option value="UY">Uruguay</option>
                    <option value="UM">Amerikanisch-Ozeanien</option>
                    <option value="VI">Amerikanische Jungferninseln</option>
                    <option value="UZ">Usbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VA">Vatikanstadt</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Vietnam</option>
                    <option value="WF">Wallis und Futuna</option>
                    <option value="EH">Westsahara</option>
                    <option value="YE">Jemen</option>
                    <option value="ZM">Sambia</option>
                    <option value="ZW">Simbabwe</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Stadt<span>*</span></label>
                  <input type="text" name="city" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Straße<span>*</span></label>
                  <input type="text" name="street" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Hausnummer<span>*</span></label>
                  <input type="text" name="house" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Postleitzahl<span>*</span></label>
                  <input type="text" name="post" placeholder="" required="required" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group create-account">
                  <input id="cbox" type="checkbox" />
                  <label>Ein Konto erstellen?</label>
                </div>
              </div>
            </div>
          </form>
          <!--/ End Form -->
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <div class="order-details">
          <!-- Order Widget -->
          <div class="single-widget">
            <h2>Bestellübersicht</h2>
            <div class="content">
              <ul>
                <li>Zwischensumme<span>330,00€</span></li>
                <li>(+) Versand<span>Kostenlos</span></li>
                <li class="last">Gesamt<span>330,00€</span></li>
              </ul>
            </div>
          </div>
          <!--/ End Order Widget -->
          <!-- Order Widget -->
          <div class="single-widget">
            <h2>Bezahlmethode</h2>
            <div class="content">
              <div class="checkbox">
                <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox" />
                  Lastschrift</label>
                <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox" />
                  Klarna</label>
                <label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox" />
                  PayPal</label>
              </div>
            </div>
          </div>
          <!--/ End Order Widget -->
          <!-- Payment Method Widget -->
          <div class="single-widget payement">
            <div class="content">
              <img src="{{ asset('images/payment-method.png') }}" alt="#" />
            </div>
          </div>
          <!--/ End Payment Method Widget -->
          <!-- Button Widget -->
          <div class="single-widget get-button">
            <div class="content">
              <div class="button">
                <a href="#" class="btn">Kostenpflichtig bestellen</a>
              </div>
            </div>
          </div>
          <!--/ End Button Widget -->
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Checkout -->

<!-- Include Newsletter -->
@include('partials.newsletter')

@endsection