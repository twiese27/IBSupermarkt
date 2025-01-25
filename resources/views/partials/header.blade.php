<!-- Header -->
<header class="header shop">
  <div class="middle-inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-12">
          <!-- Logo -->
          <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/IBSupermarkt Logo.png') }}" alt="#" /></a>
          </div>
          <!--/ End Logo -->
          <!-- Search Form -->
          <div class="search-top">
            <div class="top-search">
              <a href="#"><i class="ti-search"></i></a>
            </div>
            <!-- Search Form -->
            <div class="search-top">
              <form class="search-form">
                <input type="text" placeholder="Hier suchen..." name="search" />
                <button value="search" type="submit">
                  <i class="ti-search"></i>
                </button>
              </form>
            </div>
            <!--/ End Search Form -->
          </div>
          <!--/ End Search Form -->
          <div class="mobile-nav"></div>
        </div>
        <div class="col-lg-8 col-md-7 col-12">
          <div class="search-bar-top">
            <div class="search-bar">
              <form>
                <input name="search" placeholder="Produkte hier suchen..." type="search" />
                <button class="btnn"><i class="ti-search"></i></button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-12">
          <div class="right-bar">
            <!-- Search Form -->
            <div class="sinlge-bar">
              <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
            </div>
            <div class="sinlge-bar shopping">
              <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
              <!-- Shopping Item -->
              <div class="shopping-item">
                <div class="dropdown-cart-header">
                  <span>2 Artikel</span>
                  <a href="{{route('cart')}}">Warenkorb ansehen</a>
                </div>
                <ul class="shopping-list">
                  <li>
                    <a href="#" class="remove" title="Diesen Artikel entfernen"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="#"><img src="https://placehold.co/70x70" alt="#" /></a>
                    <h4><a href="#">Damenring</a></h4>
                    <p class="quantity">
                      1x - <span class="amount">99,00€</span>
                    </p>
                  </li>
                  <li>
                    <a href="#" class="remove" title="Diesen Artikel entfernen"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="#"><img src="https://placehold.co/70x70" alt="#" /></a>
                    <h4><a href="#">Damenkette</a></h4>
                    <p class="quantity">
                      1x - <span class="amount">35,00€</span>
                    </p>
                  </li>
                </ul>
                <div class="bottom">
                  <div class="total">
                    <span>Gesamt</span>
                    <span class="total-amount">134,00€</span>
                  </div>
                  <a href="{{ route('checkout') }}" class="btn animate">Zur Kasse</a>
                </div>
              </div>
              <!--/ End Shopping Item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header Inner -->
  <div class="header-inner">
    <div class="container">
      <div class="cat-nav-head">
        <div class="row">
          <div class="col-12">
            <div class="menu-area">
              <!-- Main Menu -->
              <nav class="navbar navbar-expand-lg">
                <div class="navbar-collapse">
                  <div class="nav-inner">
                      <ul class="nav main-menu menu navbar-nav">
                          <li>
                              <a href="#">Getränke<i class="ti-angle-down"></i></a>
                              <ul class="dropdown">
                                  <li>
                                      <a href="#">Alkoholische Getränke<i class="ti-angle-right"></i></a>
                                      <ul class="dropdown sub-dropdown">
                                              <li><a href="#">Bier und Wein<i class="ti-angle-right"></i></a>
                                              <ul class="dropdown sub-dropdown">
                                                  <li><a href="#">Bier</a></li>
                                                  <li><a href="#">Alkoholfreier Wein</a></li>
                                                  <li><a href="#">Wein</a></li>
                                              </ul>
                                              </li>
                                      </ul>
                                  </li>
                                  <li>
                                      <a href="#">Alkoholfreie Getränke<i class="ti-angle-right"></i></a>
                                      <ul class="dropdown sub-dropdown">
                                          <li>
                                              <a href="#">Kohlensäurehaltige Getränke<i class="ti-angle-right"></i></a>
                                              <ul class="dropdown sub-dropdown">
                                                  <li><a href="#">Limo</a></li>
                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#">Getränke ohne Kohlensäure<i class="ti-angle-right"></i></a>
                                              <ul class="dropdown sub-dropdown">
                                                  <li><a href="#">Aromatisierte Getränke</a></li>
                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#">Heiße Getränke<i class="ti-angle-right"></i></a>
                                              <ul class="dropdown sub-dropdown">
                                                  <li><a href="#">Schokolade</a></li>
                                                  <li><a href="#">Kaffee</a></li>
                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#">Reine Säfte<i class="ti-angle-right"></i></a>
                                              <ul class="dropdown sub-dropdown">
                                                  <li><a href="#">Säfte</a></li>
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      <li>
                        <a href="#">Essen<i class="ti-angle-down"></i></a>
                        <ul class="dropdown">
                            <li><a>Backwaren<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Brot<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Bagels</a></li>
                                        <li><a href="#">Muffins</a></li>
                                        <li><a href="#">Geschnittenes Brot</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Backzutaten<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Speiseöl</a></li>
                                <li><a href="#">Trockenware<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Kaffee</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Marmeladen und Gelees<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Marmelade</a></li>
                                        <li><a href="#">Gelee</a></li>
                                        <li><a href="#">Erdnussbutter</a></li>
                                        <li><a href="#">Eingemachtes</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Soßen</a></li>
                                <li><a href="#">Erdnussbutter</a></li>
                                <li><a href="#">Zucker</a></li>
                            </ul>
                            </li>
                            <li><a>Dosenessen<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Sardellen aus der Dose<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Sardellen</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Muschelkonserven<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Muscheln</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Austern in Dosen<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Austern</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Sardinen in Dosen<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Sardinen</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Garnelen in Dosen<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Garnelen</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Dosensuppe<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Suppe</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Dosenthunfisch<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Thunfisch</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Konserven<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Früchte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Dosenfrüchte</a></li>
                                        <li><a href="#">Frisches Obst</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Molkereiprodukte<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Käse</a>
                                    <a href="#">Hüttenkäse</a>
                                    <a href="#">Milch</a>
                                    <a href="#">Sour Creme</a>
                                    <a href="#">Joghurt</a>
                                </li>
                            </ul>
                            </li>
                            <li><a>Delikatessen<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Fleisch<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Bologna</a></li>
                                        <li><a href="#">Feinkost</a></li>
                                        <li><a href="#">Frisches Hühnchen</a></li>
                                        <li><a href="#">Gefrorenes Hühnchen</a></li>
                                        <li><a href="#">Hamburger</a></li>
                                        <li><a href="#">Hot Dogs</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Beilagen<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Feinkostsalate</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Eier</a></li>
                            <li><a>Tiefkühlkost<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Frühststücksspeisen<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Cornflakes</a></li>
                                        <li><a href="#">Pfannkuchenmix</a></li>
                                        <li><a href="#">Pfannkuchen</a></li>
                                        <li><a href="#">Waffeln</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Gefrorene Desserts<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Eis</a></li>
                                        <li><a href="#">Eis am Stiel</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Gefrorene Hauptgerichte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">TV-Dinner</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pizza</a></li>
                            </ul>
                            </li>
                            <li><a>Fertigprodukte<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Fertigsuppe</a>
                                    <a href="#">Instantsuppe</a>
                                </li>
                            </ul>
                            </li>
                            <li><a>Frischwaren<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Verpacktes Gemüse<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Tofu</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Spezialitäten<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Nüsse</a></li>
                                        <li><a href="#">Sonnenbrillen</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Gemüse<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Dosengemüse</a></li>
                                        <li><a href="#">Pommes</a></li>
                                        <li><a href="#">Frisches Gemüse</a></li>
                                        <li><a href="#">Gefrorenes Gemüse</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Meeresfrüchte<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Frischer Fisch</a>
                                    <a href="#">Schalentiere</a>
                                </li>
                            </ul>
                            </li>
                            <li><a>Snack-Produkte<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Chips</a>
                                    <a href="#">Kekse</a>
                                    <a href="#">Cracker</a>
                                    <a href="#">Dips</a>
                                    <a href="#">Donuts</a>
                                    <a href="#">Getrocknete Früchte</a>
                                    <a href="#">Getrocknetes Fleisch</a>
                                    <a href="#">Popcorn</a>
                                    <a href="#">Brezeln</a>
                                </li>
                            </ul>
                            </li>
                            <li><a>Snacks<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Süßigkeiten<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Schokolade</a></li>
                                        <li><a href="#">Kaugummi</a></li>
                                        <li><a href="#">Gummibärchen</a></li>
                                        <li><a href="#">Hartbonbons</a></li>
                                        <li><a href="#">Weichbonbons</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Stärkehaltige Lebensmittel<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Nudeln</a>
                                    <a href="#">Reis</a>
                                </li>
                            </ul>
                            </li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Nicht verzehrbar<i class="ti-angle-down"></i></a>
                        <ul class="dropdown">
                            <li><a>Drehregal</a></li>
                            <li><a>Kasse<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Verschiedenes<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Karten</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Bau<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Baustoffe<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Metall</a></li>
                                        <li><a href="#">Stein</a></li>
                                        <li><a href="#">Holz</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Gesundheit und Hygiene<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Badezimmerprodukte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Haarspülung</a></li>
                                        <li><a href="#">Spülmittel</a></li>
                                        <li><a href="#">Spülmaschinentabs</a></li>
                                        <li><a href="#">Mundspülung</a></li>
                                        <li><a href="#">Shampoo</a></li>
                                        <li><a href="#">Toilettenbürsten</a></li>
                                        <li><a href="#">Zahnbürsten</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Erkältungsmittel</a></li>
                                <li><a href="#">Abschwellmittel<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Nasenspray</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Hygenie<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Persönliche Hygenie</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Schmerzmittel<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Paracetamol</a></li>
                                        <li><a href="#">Aspirin</a></li>
                                        <li><a href="#">Ibuprofen</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Haushalt<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li><a href="#">Kerzen</a></li>
                                <li><a href="#">Reinigungsutensilien<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Reinigungsmittel</a></li>
                                        <li><a href="#">Lufterfrischer</a></li>
                                        <li><a href="#">Duschseife</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Elektronik<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Batterien</a></li>
                                        <li><a href="#">Bohrmaschinen</a></li>
                                        <li><a href="#">Glühbirnen</a></li>
                                        <li><a href="#">Tablets</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Werkzeug<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Schraubendreher</a></li>
                                        <li><a href="#">Werkzeuge</a></li>
                                        <li><a href="#">Elektrische Werkzeuge</a></li>
                                        <li><a href="#">Akkuschrauber</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Küchenprodukte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Topfreiniger</a></li>
                                        <li><a href="#">Topfschwämme</a></li>
                                        <li><a href="#">Töopfe und Pfannen</a></li>
                                        <li><a href="#">Schwämme</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Papierprodukte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Papiergeschirr</a></li>
                                        <li><a href="#">Papiertücher</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Plastikprodukte<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Plastikbesteck</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Zeitschriften<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Magazine<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Automagazine</a></li>
                                        <li><a href="#">Computermagazine</a></li>
                                        <li><a href="#">Modemagazine</a></li>
                                        <li><a href="#">Einrichtungsmagazine</a></li>
                                        <li><a href="#">Sportmagazine</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                            <li><a>Technik<i class="ti-angle-right"></i></a>
                            <ul class="dropdown sub-dropdown">
                                <li>
                                    <a href="#">Computer<i class="ti-angle-right"></i></a>
                                    <ul class="dropdown sub-dropdown">
                                        <li><a href="#">Notebooks</a></li>
                                    </ul>
                                </li>
                            </ul>
                            </li>
                        </ul>
                      </li>
                        <li><a>Service</a></li>
                      <li><a>Kontakt</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
              <!--/ End Main Menu -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ End Header Inner -->
</header>
<!--/ End Header -->
