@extends('layouts.app')

@section('title', 'Shop Grid')

@section('content')

<section>
  <br>
  <br>
  <div style="text-align: center;">
    <h1> Trendprodukte </h1>
  </div>
</section>

<!-- Start Area 2 -->
<section class="hero-area4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="home-slider-4">
          <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
            <div class="inner">
              <h4 class="title">
                make your <br />
                site stunning with <br />
                large title
              </h4>
              <p class="des">
                Hipster style is a fashion trending for Gentleman and
                Lady<br />with tattoos. You’ll become so cool and attractive
                with your’s girl.<br />
                Now let come hare and grab it now !
              </p>
              <div class="button">
                <a href="#" class="btn">Jetzt Einkaufen</a>
              </div>
            </div>
          </div>
          <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
            <div class="inner">
              <h4 class="title">
                make your <br />
                site stunning with <br />
                large title
              </h4>
              <p class="des">
                Hipster style is a fashion trending for Gentleman and
                Lady<br />with tattoos. You’ll become so cool and attractive
                with your’s girl.<br />
                Now let come hare and grab it now !
              </p>
              <div class="button">
                <a href="#" class="btn">Jetzt Einkaufen</a>
              </div>
            </div>
          </div>
          <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
            <div class="inner">
              <h4 class="title">
                make your <br />
                site stunning with <br />
                large title
              </h4>
              <p class="des">
                Hipster style is a fashion trending for Gentleman and
                Lady<br />with tattoos. You’ll become so cool and attractive
                with your’s girl.<br />
                Now let come hare and grab it now !
              </p>
              <div class="button">
                <a href="#" class="btn">Jetzt Einkaufen</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Hero Area 2 -->
<section>
  <br>
  <br>
  <div style="text-align: center;">
    <h1> {{ $categoryName }} </h1>
  </div>
</section>

<!-- Product Style
<section class="product-area shop-sidebar shop section">
  <div class="container">
      <div class="col-lg-9 col-md-8 col-12">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                </a>
@@ -113,7 +113,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Frauen Heiße Kollektion</a>
                  <a href="">Frauen Heiße Kollektion</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -124,7 +124,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                </a>
@@ -143,7 +143,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Awesome Pink Show</a>
                  <a href="">Awesome Pink Show</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -154,7 +154,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                </a>
@@ -173,7 +173,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                  <a href="">Awesome Bags Collection</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -184,7 +184,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                  <span class="new">Neu</span>
@@ -204,7 +204,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                  <a href="">Women Pant Collectons</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -215,7 +215,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                </a>
@@ -234,7 +234,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Awesome Bags Collection</a>
                  <a href="">Awesome Bags Collection</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -245,7 +245,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                  <span class="price-dec">30% Off</span>
@@ -265,7 +265,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Awesome Cap For Women</a>
                  <a href="">Awesome Cap For Women</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -276,7 +276,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                </a>
@@ -295,7 +295,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Polo Dress For Women</a>
                  <a href="">Polo Dress For Women</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -306,7 +306,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                  <span class="out-of-stock">Hot</span>
@@ -326,7 +326,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{route('shop-single') }}">Black Sunglass For Women</a>
                  <a href="">Black Sunglass For Women</a>
                </h3>
                <div class="product-price">
                  <span class="old">$60.00</span>
@@ -338,7 +338,7 @@
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-product">
              <div class="product-img">
                <a href="{{ route('shop-single') }}">
                <a href="">
                  <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                  <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
                  <span class="new">Neu</span>
@@ -358,7 +358,7 @@
              </div>
              <div class="product-content">
                <h3>
                  <a href="{{ route('shop-single') }}">Women Pant Collectons</a>
                  <a href="">Women Pant Collectons</a>
                </h3>
                <div class="product-price">
                  <span>$29.00</span>
@@ -517,4 +517,4 @@
</div>
<!-- Modal end -->

@endsection
@endsection