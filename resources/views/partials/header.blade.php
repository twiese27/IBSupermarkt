<header class="header shop">
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/IBSupermarkt Logo.png') }}"
                                                           alt="#"/></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search">
                            <a href="#"><i class="ti-search"></i></a>
                        </div>
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Hier suchen..." name="search"/>
                                <button value="search" type="submit">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <form action="{{ route('search') }}" method="GET">
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <input name="search" placeholder="Search for products here..." type="search"/>
                                <button class="btnn"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="user-info">
                                    <a href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                </div>
                            @else
                                <div class="guest-info">
<!-- Prüfe hier den Status den Kunden auf seinen Status. 
 profilicon0 ist gold,
 profilicon1 silver,
 profilicon2 bronze,
 profilicon0 schwarz
  zu definieren in public/css/style.css zeile 1019 ff.
 -->
                                    <a href="{{ route('login') }}" id="profilicon0" class="single-icon"><i class="fa fa-user-circle-o"
                                                                                          aria-hidden="true"></i></a>
                                </div>
                            @endif
                        </div>
                        <!-- Warenkorb Button im Header -->
                    @php
                        $cartItems = session('cart', []);
                        $totalCount = array_sum(array_column($cartItems, 'quantity'));
                    @endphp

                    <!-- Warenkorb Button im Header -->
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('cart') }}" class="single-icon">
                                <i class="ti-bag"></i>
                                <span>{{ $totalCount }}</span>
                            </a>
                            <div class="shopping-item">
                                <ul class="shopping-list">
                                    @if(count($cartItems) > 0)
                                        @foreach($cartItems as $item)
                                            <li>
                                                <strong>{{ $item['name'] }}</strong> - Amount: {{ $item['quantity'] }}
                                            </li>
                                        @endforeach
                                    @else
                                        <p>shopping cart is empty</p>
                                    @endif
                                </ul>
                                <div class="dropdown-cart-header">
                                    <span class="total-count">{{ $totalCount }} article</span>
                                    <a href="{{ route('cart') }}">view shopping cart</a>
                                </div>
                                <div class="bottom">
                                    <div class="total">
                                        <a href="{{ route('checkout') }}" class="btn animate">Go to checkout</a>
                                    </div>
                                </div>
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
                                                <!-- Dynamische Kategorien -->
                                            @include('partials.category', ['categories' => $categories, 'level' => 0])
                                            <!-- Statische Menüpunkte -->
                                                <li><a href="#">Service</a></li>
                                                <li><a href="#">Kontakt</a></li>
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
