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
              <a href="#0"><i class="ti-search"></i></a>
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
                      <li class="active">
                        <a href="#">Startseite<i class="ti-angle-down"></i></a>
                        <ul class="dropdown">
                          <li><a>Startseite V1</a></li>
                          <li><a>Startseite V2</a></li>
                          <li><a>Startseite V3</a></li>
                          <li><a href="{{ route('home') }}">Startseite V4</a></li>
                        </ul>
                      </li>
                      <li><a href="#">Produkt</a></li>
                      <li><a href="#">Service</a></li>
                      <li>
                        <a href="#">Shop<i class="ti-angle-down"></i><span class="new">Neu</span></a>
                        <ul class="dropdown">
                          <li><a href="{{ route('shop-grid') }}">Shop Grid</a></li>
                          <li><a>Shop Liste</a></li>
                          <li><a href="{{ route('shop-single') }}">Shop Einzel</a></li>
                          <li><a href="{{ route('cart') }}">Warenkorb</a></li>
                          <li><a href="{{ route('checkout') }}">Zur Kasse</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Seiten<i class="ti-angle-down"></i></a>
                        <ul class="dropdown">
                          <li><a>Über uns</a></li>
                          <li><a href="{{ route('login') }}">Anmelden</a></li>
                          <li><a href="{{ route('register') }}">Registrieren</a></li>
                          <li><a>Mail Erfolg</a></li>
                          <li><a>404</a></li>
                        </ul>
                      </li>
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
