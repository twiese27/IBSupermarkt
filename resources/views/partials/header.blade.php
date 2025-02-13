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
                                <input name="search" placeholder="Produkte hier suchen..." type="search"/>
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
                                @php
                                    $user = session('user');
                                    $cusomter = session('customer');
                                @endphp
                                <div class="user-info">
                                    <a href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o"
                                                                                            aria-hidden="true"></i></a>

                                </div>
                            @else
                                <div class="guest-info">
                                    <a href="{{ route('login') }}" class="single-icon"><i class="fa fa-user-circle-o"
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
                                                <strong>{{ $item['name'] }}</strong> - Menge: {{ $item['quantity'] }}
                                            </li>
                                        @endforeach
                                    @else
                                        <p>Warenkorb ist leer</p>
                                    @endif
                                </ul>
                                <div class="dropdown-cart-header">
                                    <span class="total-count">{{ $totalCount }} Artikel</span>
                                    <a href="{{ route('cart') }}">Warenkorb ansehen</a>
                                </div>
                                <div class="bottom">
                                    <div class="total">
                                        <a href="{{ route('checkout') }}" class="btn animate">Zur Kasse</a>
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
