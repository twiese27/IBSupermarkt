<?php
use \Illuminate\Support\Facades\Auth;
use \app\Models\ProductToShoppingCart;
use \app\Models\Product;
use \app\Models\ShoppingCart;
?>
<style>

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 9999;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            opacity: 0.8;
            border-radius: 50%;
            animation: fall linear infinite;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
    </style>

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
                         <!-- Prüfe hier den Status den Kunden auf seinen Status.
                            profilicon0 ist gold,
                            profilicon1 silver,
                            profilicon2 bronze,
                            profilicon3 gruen
                            zu definieren in public/css/style.css zeile 1019 ff.
                        -->
                        <div class="sinlge-bar">
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <!--TODO: Abfragen des Kundenstatus-->
                                <div class="user-info">
                                @php
                                    $clusterCustomerId = null;
                                    if (session()->has('clusterCustomerId')) {
                                        $clusterCustomerId = session('clusterCustomerId');
                                    } else {
                                        $clusterCustomerId = null;
                                    }
                                @endphp
                                    @if($clusterCustomerId == 1)<!--Goldkunde 1-->
                                        <a id="profilicon1" href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                    @elseif($clusterCustomerId == 2)<!--Silberkunde 2-->
                                        <a id="profilicon2" href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                    @elseif($clusterCustomerId == 3)<!--Bronzekunde 3-->
                                        <a id="profilicon3" href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                    @elseif($clusterCustomerId == 4)<!--Greenkunde 4-->
                                        <a id="profilicon4" href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                    @elseif($clusterCustomerId == 5)<!--Bluekunde 5-->
                                        <a id="profilicon5" href="{{ route('profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>

                                    @endif
                                    </div>
                            @else
                                <div class="guest-info">

                                    <a href="{{ route('login') }}" id="profilicon6" class="single-icon"><i class="fa fa-user-circle-o"
                                                                                          aria-hidden="true"></i></a>
                                </div>
                            @endif
                        </div>
                        <!-- Warenkorb Button im Header -->
                    @php
                        if (Auth::check()) {
                            $cartItems = ProductToShoppingCart::query()
                                ->select(
                                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                                    Product::TABLE . '.' . Product::PRODUCT_ID,
                                    Product::TABLE . '.' . Product::PRODUCT_NAME,
                                    Product::TABLE . '.' . Product::RETAIL_PRICE,
                                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::TOTAL_AMOUNT
                                )
                                ->join(
                                    ShoppingCart::TABLE,
                                    ShoppingCart::TABLE . '.' . ShoppingCart::SHOPPING_CART_ID,
                                    '=',
                                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::SHOPPING_CART_ID
                                )
                                ->join(
                                    Product::TABLE,
                                    Product::TABLE . '.' . Product::PRODUCT_ID,
                                    '=',
                                    ProductToShoppingCart::TABLE . '.' . ProductToShoppingCart::PRODUCT_ID
                                )
                                ->where(
                                    ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID,
                                    '=',
                                    Auth::user()->customer_id
                                )
                                ->whereNull(ShoppingCart::TABLE . '.' . ShoppingCart::CUSTOMER_ID)
                                ->get()
                                ->map(function ($item) {
                                    return (object) [
                                        'product' => Product::find($item->product_id),
                                        'quantity' => $item->total_amount
                                    ];
                                });
                        } else {
                            $cartItems = session('cart', []);
                        }

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
                                                <strong>{{ $item['product']->product_name }}</strong> - Amount: {{ $item['quantity'] }}
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
                                                <!--TODO: Abfragen des Kundenstatus und Loginstatus-->
                                                <!-- Unterscheidung, je nach Status des Kunden-->
                                                <!--(\Illuminate\Support\Facades\Auth::check())-->

                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                        @if($clusterCustomerId == 1)<!--Goldkunde 1: Bulk Buyer (high cart value, few purchases)-->
                                                            <li><a class="startAnimation" id="NavBarGold" href="#">GOLD Status! 20% discount on your next purchase!</a></li>

                                                        @elseif($clusterCustomerId == 2)<!--Silberkunde 2: Brokie (few orders, low amounts)-->
                                                            <li><a class="startAnimation" id="NavBarSilber" href="#">SILVER Status! 15% discount on your next purchase!</a></li>


                                                        @elseif($clusterCustomerId == 3)<!--Bronzekunde 3: Cash Cow (high order volume, frequent purchases)-->
                                                            <li><a class="startAnimation" id="NavBarBronze" href="#">BRONCE Status! 10% discount on your next purchase!</a></li>

                                                        @elseif($clusterCustomerId == 4)<!--Greenkunde 4: Occasional Buyer (irregular purchase behavior)-->
                                                            <li><a class="startAnimation" id="NavBarGreen" href="#">GREEN Status! 5% discount on your next purchase!</a></li>

                                                        @elseif($clusterCustomerId == 5)<!--Bluekunde 5: Inactive Customer (hardly or no purchases)-->
                                                            <li><a class="startAnimation" id="NavBarBlue" href="#">ORANGE Status! 1% discount on your next purchase!</a></li>
                                                        @else
                                                            <li><a class="startAnimationSad" id="NavBarGuest" href="#">Yet No Status!</a></li>
                                                        @endif
                                                    @else
                                                        <!--Gastkunde 5-->
                                                        <li><a id="NavBarGuest" href="{{ route('login') }}">Sign in to receive personalized discounts</a></li>
                                                    @endif
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".startAnimation").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const container = document.querySelector(".confetti-container");

            // Define color mapping based on the ID of the clicked element
            const colorMap = {
                "NavBarGold": "#FFD700",
                "NavBarSilber": "#C0C0C0",
                "NavBarBronze": "#CD7F32",
                "NavBarGreen": "#2E6930",
                "NavBarBlue": "#0004ff",
            };

            // Get the ID of the clicked element and determine the color
            const confettiColor = colorMap[this.id] || "#FFFFFF"; // Default to white if not found

            for (let i = 0; i < 50; i++) {
                let confetti = document.createElement("div");
                confetti.classList.add("confetti");

                // Set random positions and apply the selected color
                confetti.style.left = Math.random() * 100 + "vw";
                confetti.style.top = Math.random() * 50 + "vh";
                confetti.style.backgroundColor = confettiColor;
                confetti.style.animationDuration = (Math.random() * 2 + 2) + "s";

                container.appendChild(confetti);

                // Remove confetti after animation
                setTimeout(() => confetti.remove(), 3000);
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".startAnimationSad").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const container = document.querySelector(".confetti-container");

            for (let i = 0; i < 50; i++) {
                let raindrop = document.createElement("div");
                raindrop.classList.add("raindrop");

                // Set random positions
                raindrop.style.left = Math.random() * 100 + "vw";
                raindrop.style.top = "-5vh"; // Start above the viewport
                raindrop.style.animationDuration = (Math.random() * 1 + 1.5) + "s";

                container.appendChild(raindrop);

                // Remove raindrop after animation
                setTimeout(() => raindrop.remove(), 5000);
            }
        });
    });
});

// CSS für die Regenanimation hinzufügen
const style = document.createElement("style");
style.innerHTML = `
    .raindrop {
        position: fixed;
        width: 3px;
        height: 10px;
        background-color: #6495ED;
        opacity: 0.7;
        animation: raindrop-fall linear infinite;
    }

    @keyframes raindrop-fall {
        to {
            transform: translateY(100vh);
        }
    }
`;
document.head.appendChild(style);

</script>
