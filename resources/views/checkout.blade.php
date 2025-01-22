<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Meta Tag -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="copyright" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Title Tag  -->
    <title>Eshop - eCommerce HTML5 Template.</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <!-- Web Font -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
      rel="stylesheet"
    />

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}" />
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('css/niceselect.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('css/flex-slider.min.css') }}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}" />
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" />

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />

    <!-- Color CSS -->
    <link rel="stylesheet" href="{{ asset('css/color/color1.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/color/color2.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color3.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color4.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color5.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color6.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color7.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color8.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color9.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color10.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color11.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color12.css') }}">-->

    <link rel="stylesheet" href="#" id="colors" />
  </head>
  <body class="js">
    <!-- Preloader -->
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- End Preloader -->

    <!-- Eshop Color Plate -->
    <div class="color-plate">
      <a class="color-plate-icon"><i class="ti-paint-bucket"></i></a>
      <h4>Eshop Colors</h4>
      <p>Here is some awesome color's available on Eshop Template.</p>
      <span class="color1"></span>
      <span class="color2"></span>
      <span class="color3"></span>
      <span class="color4"></span>
      <span class="color5"></span>
      <span class="color6"></span>
      <span class="color7"></span>
      <span class="color8"></span>
      <span class="color9"></span>
      <span class="color10"></span>
      <span class="color11"></span>
      <span class="color12"></span>
    </div>
    <!-- /End Color Plate -->

    <!-- Include Header -->
    @include('partials.header')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bread-inner">
              <ul class="bread-list">
                <li>
                  <a href="/html/must-have/index4.html"
                    >Startseite<i class="ti-arrow-right"></i
                  ></a>
                </li>
                <li class="active"><a href="blog-single.html">Kasse</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-12">
            <div class="checkout-form">
              <h2>Hier zur Kasse gehen</h2>
              <p>
                Bitte registrieren Sie sich, um schneller zur Kasse zu gehen
              </p>
              <!-- Form -->
              <form class="form" method="post" action="#">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Vorname<span>*</span></label>
                      <input
                        type="text"
                        name="name"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Nachname<span>*</span></label>
                      <input
                        type="text"
                        name="name"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Email Adresse<span>*</span></label>
                      <input
                        type="email"
                        name="email"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Telefonnummer<span>*</span></label>
                      <input
                        type="number"
                        name="number"
                        placeholder=""
                        required="required"
                      />
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
                      <label>Bundesland / Region<span>*</span></label>
                      <select name="state-province" id="state-province">
                        <option value="divition" selected="selected">
                          New York
                        </option>
                        <option>Los Angeles</option>
                        <option>Chicago</option>
                        <option>Houston</option>
                        <option>San Diego</option>
                        <option>Dallas</option>
                        <option>Charlotte</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Adresszeile 1<span>*</span></label>
                      <input
                        type="text"
                        name="address"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Adresszeile 2<span>*</span></label>
                      <input
                        type="text"
                        name="address"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Postleitzahl<span>*</span></label>
                      <input
                        type="text"
                        name="post"
                        placeholder=""
                        required="required"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label>Firma<span>*</span></label>
                      <select name="company_name" id="company">
                        <option value="company" selected="selected">
                          Microsoft
                        </option>
                        <option>Apple</option>
                        <option>Xiaomi</option>
                        <option>Huawei</option>
                        <option>Wpthemesgrid</option>
                        <option>Samsung</option>
                        <option>Motorola</option>
                      </select>
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
                <h2>WARENKORB SUMMEN</h2>
                <div class="content">
                  <ul>
                    <li>Zwischensumme<span>330,00€</span></li>
                    <li>(+) Versand<span>10,00€</span></li>
                    <li class="last">Gesamt<span>340,00€</span></li>
                  </ul>
                </div>
              </div>
              <!--/ End Order Widget -->
              <!-- Order Widget -->
              <div class="single-widget">
                <h2>Zahlungen</h2>
                <div class="content">
                  <div class="checkbox">
                    <label class="checkbox-inline" for="1"
                      ><input name="updates" id="1" type="checkbox" />
                      Scheckzahlungen</label
                    >
                    <label class="checkbox-inline" for="2"
                      ><input name="news" id="2" type="checkbox" />
                      Nachnahme</label
                    >
                    <label class="checkbox-inline" for="3"
                      ><input name="news" id="3" type="checkbox" />
                      PayPal</label
                    >
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
                    <a href="#" class="btn">zur Kasse gehen</a>
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

    <!-- Include Shop Services Area-->
    @include('partials.shop-service-area')

    <!-- Include Newsletter -->
    @include('partials.newsletter')

    <!-- Include Footer -->
    @include('partials.footer')

    <!-- Jquery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('js/magnific-popup.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('js/facnybox.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('js/nicesellect.js') }}"></script>
    <!-- Ytplayer JS -->
    <script src="{{ asset('js/ytplayer.min.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('js/active.js') }}"></script>
    <!-- Include HTML -->
    <script src="{{ asset('js/include-html.js') }}"></script>
  </body>
</html>
