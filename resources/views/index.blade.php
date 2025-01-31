@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<!-- Start Area 2 -->
<section class="hero-area4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="home-slider-4">
          @for ($i = 0; $i < 5; $i++)
        <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
        <div class="inner">
          <h4 class="title">
          {{ $products[$i]->product_name }}
          </h4>
          <p class="des">
          Discover our extensive range of high-quality products, <br />
          carefully selected to meet all your daily needs. From fresh fruits and vegetables to pantry essentials
          <br />and indulgent treats, we’ve got you covered. Shop conveniently online and
          <br />enjoy fast delivery straight to your door – because your satisfaction is our top priority!
          </p>
          <div class="button">
          <a href="#" class="btn">Jetzt Einkaufen</a>
          </div>
        </div>
        </div>
      @endfor
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Hero Area 2 -->

<!-- Start Test Zugriff auf eingeloggten Nutzer -->
 <!--
@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

@if(session('user'))
    <p>Willkommen, {{ session('user')->user_account_id }}</p>
@endif
-->

<!-- Ende Test Zugriff auf eingeloggten Nutzer -->

<!-- Start Small Banner  -->
<!--
<section class="small-banner section">
  <div class="container">
    <div class="row">
-->
<!-- Single Banner  -->
<!--
      <div class="col-lg-4 col-md-6 col-12">
        <div class="single-banner">
          <img src="https://placehold.co/600x370" alt="#" />
          <div class="content">
            <p>Man's Collectons</p>
            <h3>
              Summer travel <br />
              collection
            </h3>
            <a href="#">Jetzt Entdecken</a>
          </div>
        </div>
      </div>
-->
<!-- /End Single Banner  -->
<!-- Single Banner  -->
<!--
      <div class="col-lg-4 col-md-6 col-12">
        <div class="single-banner">
          <img src="https://placehold.co/600x370" alt="#" />
          <div class="content">
            <p>Bag Collectons</p>
            <h3>
              Awesome Bag <br />
              2020
            </h3>
            <a href="#">Jetzt Einkaufen</a>
          </div>
        </div>
      </div>
-->
<!-- /End Single Banner  -->
<!-- Single Banner  -->
<!--
      <div class="col-lg-4 col-12">
        <div class="single-banner tab-height">
          <img src="https://placehold.co/600x370" alt="#" />
          <div class="content">
            <p>Flash Sale</p>
            <h3>
              Mid Season <br />
              Up to <span>40%</span> Off
            </h3>
            <a href="#">Jetzt Entdecken</a>
          </div>
        </div>
      </div>
-->
<!-- /End Single Banner  -->
<!--
    </div>
  </div>
</section>
-->
<!-- End Small Banner -->

<!-- Start Produktbereich -->
<div class="product-area section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Trendartikel</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="product-info">
          <!--
          <div class="nav-main">
-->
          <!-- Tab Nav -->
          <!--
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#man" role="tab">Männer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#women" role="tab">Frauen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kids" role="tab">Kinder</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#accessories" role="tab">Zubehör</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#essential" role="tab">Essentiell</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#prices" role="tab">Preise</a>
              </li>
            </ul>
            -->
          <!--/ End Tab Nav -->
          <!--
          </div>
-->
          <div class="tab-content" id="myTabContent">
            <!-- Start Single Tab -->
            <div class="tab-pane fade show active" id="man" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  @foreach($products as $product)
             @include('partials.product', ['product' => $product])
          @endforeach
                </div>
              </div>
            </div>
            <!--/ End Single Tab -->
            <!-- Start Single Tab -->
            <!--
            <div class="tab-pane fade" id="women" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="new">Neu</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="price-dec">30% Off</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="out-of-stock">Hot</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                        </h3>
                        <div class="product-price">
                          <span class="old">$60.00</span>
                          <span>$50.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
            <!--/ End Single Tab -->
            <!-- Start Single Tab -->
            <!--
            <div class="tab-pane fade" id="kids" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="new">Neu</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="price-dec">30% Off</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="out-of-stock">Hot</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                        </h3>
                        <div class="product-price">
                          <span class="old">$60.00</span>
                          <span>$50.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
            <!--/ End Single Tab -->
            <!-- Start Single Tab -->
            <!--
            <div class="tab-pane fade" id="accessories" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="new">Neu</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="price-dec">30% Off</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="out-of-stock">Hot</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                        </h3>
                        <div class="product-price">
                          <span class="old">$60.00</span>
                          <span>$50.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
            <!--/ End Single Tab -->
            <!-- Start Single Tab -->
            <!--
            <div class="tab-pane fade" id="essential" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="new">Neu</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="price-dec">30% Off</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="out-of-stock">Hot</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                        </h3>
                        <div class="product-price">
                          <span class="old">$60.00</span>
                          <span>$50.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
            <!--/ End Single Tab -->
            <!-- Start Single Tab -->
            <!--
            <div class="tab-pane fade" id="prices" role="tabpanel">
              <div class="tab-single">
                <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="new">Neu</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="price-dec">30% Off</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                        </h3>
                        <div class="product-price">
                          <span>$29.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                      <div class="product-img">
                        <a href="{{ route('shop-single') }}">
                          <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                          <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          <span class="out-of-stock">Hot</span>
                        </a>
                        <div class="button-head">
                          <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                class="ti-eye"></i><span>Schnellansicht</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste
                                hinzufügen</span></a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                                hinzufügen</span></a>
                          </div>
                          <div class="product-action-2">
                            <a title="Add to cart" href="#">In den Warenkorb</a>
                          </div>
                        </div>
                      </div>
                      <div class="product-content">
                        <h3>
                          <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                        </h3>
                        <div class="product-price">
                          <span class="old">$60.00</span>
                          <span>$50.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
            <!--/ End Single Tab -->
            <!--
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
-->
            <!-- End Product Area -->

            <!-- Start Midium Banner  -->
            <!--
<section class="midium-banner">
  <div class="container">
    <div class="row">
-->
            <!-- Single Banner  -->
            <!--
      <div class="col-lg-6 col-md-6 col-12">
        <div class="single-banner">
          <img src="https://placehold.co/600x370" alt="#" />
          <div class="content">
            <p>Man's Collectons</p>
            <h3>Man's items <br />Up to<span> 50%</span></h3>
            <a href="#">Jetzt Einkaufen</a>
          </div>
        </div>
      </div>
-->
            <!-- /End Single Banner  -->
            <!-- Single Banner  -->
            <!--
      <div class="col-lg-6 col-md-6 col-12">
        <div class="single-banner">
          <img src="https://placehold.co/600x370" alt="#" />
          <div class="content">
            <p>shoes women</p>
            <h3>
              mid season <br />
              up to <span>70%</span>
            </h3>
            <a href="#" class="btn">Jetzt Einkaufen</a>
          </div>
        </div>
      </div>
-->
            <!-- /End Single Banner  -->
            <!--
    </div>
  </div>
</section>
-->
            <!-- End Midium Banner -->

            <!-- Start Shop Home List  -->
            <section class="shop-home-list section">
              <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="shop-section-title">
                          <h1>Geheimtipp</h1>
                        </div>
                      </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h4 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h4>
                            <p class="price with-discount">$59</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$44</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$89</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="shop-section-title">
                          <h1>Bewusster Leben</h1>
                        </div>
                      </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$65</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$33</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$77</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                      <div class="col-12">
                        <div class="shop-section-title">
                          <h1>Bestseller</h1>
                        </div>
                      </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$22</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$35</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <div class="list-image overlay">
                            <img src="https://placehold.co/115x140" alt="#" />
                            <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                          <div class="content">
                            <h5 class="title">
                              <a href="#">Licity jelly leg flat Sandals</a>
                            </h5>
                            <p class="price with-discount">$99</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Single List  -->
                  </div>
                </div>
              </div>
            </section>
            <!-- End Shop Home List  -->

            <!-- Start New Items -->
            <div class="product-area most-popular section">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <div class="section-title">
                      <h2>New Items</h2>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="owl-carousel popular-slider">
                      <!-- Start Single Product -->
                      <div class="single-product">
                        <div class="product-img">
                          <a href="{{ route('shop-single') }}">
                            <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                            <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                            <span class="out-of-stock">Hot</span>
                          </a>
                          <div class="button-head">
                            <div class="product-action-2">
                              <a title="Add to cart" href="#">In den Warenkorb</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <h3>
                            <a href="{{ route('shop-single') }}">Black Sunglass For Women</a>
                          </h3>
                          <div class="product-price">
                            <span class="old">$60.00</span>
                            <span>$50.00</span>
                          </div>
                        </div>
                      </div>
                      <!-- End Single Product -->
                      <!-- Start Single Product -->
                      <div class="single-product">
                        <div class="product-img">
                          <a href="{{ route('shop-single') }}">
                            <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                            <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          </a>
                          <div class="button-head">
                            <div class="product-action-2">
                              <a title="Add to cart" href="#">In den Warenkorb</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <h3>
                            <a href="{{ route('shop-single') }}">Women Hot Collection</a>
                          </h3>
                          <div class="product-price">
                            <span>$50.00</span>
                          </div>
                        </div>
                      </div>
                      <!-- End Single Product -->
                      <!-- Start Single Product -->
                      <div class="single-product">
                        <div class="product-img">
                          <a href="{{ route('shop-single') }}">
                            <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                            <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                            <span class="new">Neu</span>
                          </a>
                          <div class="button-head">
                            <div class="product-action-2">
                              <a title="Add to cart" href="#">In den Warenkorb</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <h3><a href="{{ route('shop-single') }}">Awesome Pink Show</a></h3>
                          <div class="product-price">
                            <span>$50.00</span>
                          </div>
                        </div>
                      </div>
                      <!-- End Single Product -->
                      <!-- Start Single Product -->
                      <div class="single-product">
                        <div class="product-img">
                          <a href="{{ route('shop-single') }}">
                            <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                            <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                          </a>
                          <div class="button-head">
                            <div class="product-action-2">
                              <a title="Add to cart" href="#">In den Warenkorb</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <h3>
                            <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                          </h3>
                          <div class="product-price">
                            <span>$50.00</span>
                          </div>
                        </div>
                      </div>
                      <!-- End Single Product -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End New Items Area -->

            <!-- Start Cowndown Area -->
            <section class="cown-down">
              <div class="section-inner">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-6 col-12 padding-right">
                      <div class="image">
                        <img src="https://placehold.co/750x590" alt="#" />
                      </div>
                    </div>
                    <div class="col-lg-6 col-12 padding-left">
                      <div class="content">
                        <div class="heading-block">
                          <p class="small-title">Geheimtipp</p>
                          <h3 class="title">Beatutyful dress for women</h3>
                          <p class="text">
                            Suspendisse massa leo, vestibulum cursus nulla sit amet,
                            frungilla placerat lorem. Cars fermentum, sapien.
                          </p>
                          <h1 class="price">$1200 <s>$1890</s></h1>
                          <div class="coming-time">
                            <div class="clearfix" data-countdown="2025/02/30"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- /End Cowndown Area -->

            <!-- Include Neusletter -->
            @include('partials.newsletter')

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header"></div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="ti-close" aria-hidden="true"></span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row no-gutters">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <!-- Product Slider -->
                    <div class="product-gallery">
                      <div class="quickview-slider-active">
                        <div class="single-slider">
                          <img src="https://placehold.co/569x528" alt="#" />
                        </div>
                        <div class="single-slider">
                          <img src="https://placehold.co/569x528" alt="#" />
                        </div>
                        <div class="single-slider">
                          <img src="https://placehold.co/569x528" alt="#" />
                        </div>
                        <div class="single-slider">
                          <img src="https://placehold.co/569x528" alt="#" />
                        </div>
                      </div>
                    </div>
                    <!-- End Product slider -->
                  </div>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="quickview-content">
                      <h2>Flared Shift Dress</h2>
                      <div class="quickview-ratting-review">
                        <div class="quickview-ratting-wrap">
                          <div class="quickview-ratting">
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                          <a href="#"> (1 customer review)</a>
                        </div>
                        <div class="quickview-stock">
                          <span><i class="fa fa-check-circle-o"></i> in stock</span>
                        </div>
                      </div>
                      <h3>$29.00</h3>
                      <div class="quickview-peragraph">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                          Mollitia iste laborum ad impedit pariatur esse optio
                          tempora sint ullam autem deleniti nam in quos qui nemo
                          ipsum numquam.
                        </p>
                      </div>
                      <div class="size">
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <h5 class="title">Size</h5>
                            <select>
                              <option selected="selected">s</option>
                              <option>m</option>
                              <option>l</option>
                              <option>xl</option>
                            </select>
                          </div>
                          <div class="col-lg-6 col-12">
                            <h5 class="title">Color</h5>
                            <select>
                              <option selected="selected">orange</option>
                              <option>purple</option>
                              <option>black</option>
                              <option>pink</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="quantity">
                        <!-- Input Order -->
                        <div class="input-group">
                          <div class="button minus">
                            <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                              data-type="minus" data-field="quant[1]">
                              <i class="ti-minus"></i>
                            </button>
                          </div>
                          <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000"
                            value="1" />
                          <div class="button plus">
                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                              data-field="quant[1]">
                              <i class="ti-plus"></i>
                            </button>
                          </div>
                        </div>
                        <!--/ End Input Order -->
                      </div>
                      <div class="add-to-cart">
                        <a href="#" class="btn">In den Warenkorb</a>
                        <a href="#" class="btn min"><i class="ti-heart"></i></a>
                        <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                      </div>
                      <div class="default-social">
                        <h4 class="share-now">Share:</h4>
                        <ul>
                          <li>
                            <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                          </li>
                          <li>
                            <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                          </li>
                          <li>
                            <a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a>
                          </li>
                          <li>
                            <a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal end -->

        @endsection