@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

    <!-- Start Area 2 -->
    <section class="hero-area4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home-slider-4">
                        @php
                            $recommendedProducts = session('recommendedProducts', collect());
                            $displayProducts = Auth::check() ? $recommendedProducts : $products->take(5);
                            
                        @endphp

                        @foreach ($displayProducts as $product)
                            @php
                                $imagePath = asset("images/product_category_images/{$product->product_id}.png");
                                $imageExists = file_exists(public_path("images/product_category_images/{$product->product_id}.png"));
                                $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/1160x560';
                            @endphp

                            <div class="big-content" style="background-image: url('{{ $backgroundImage }}')">
                                <div class="inner">
                                    <h4 class="title">{{ $product->product_name }}</h4>
                                    <p class="des">
                                        Discover our extensive range of high-quality products, <br />
                                        carefully selected to meet all your daily needs. From fresh fruits and vegetables to pantry essentials
                                        <br />and indulgent treats, we’ve got you covered. Shop conveniently online and
                                        <br />enjoy fast delivery straight to your door – because your satisfaction is our top priority!
                                    </p>
                                    <div class="button">
                                        <a href="{{ route('product', ['id' => $product->product_id]) }}" class="btn">Jetzt Einkaufen</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                        <h1>Trendartikel</h1>
                    </div>
                </div>
            </div>
            <div class="row"style="margin-bottom: 80px;">
                <div class="col-12">
                    <div class="product-info">

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
                    </div>
                </div>
            </div>

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
                            @foreach($products->take(3) as $product)
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                <img src="{{ $product->image_url ?? 'https://placehold.co/115x140' }}"
                                                     alt="{{ $product->product_name }}" />
                                                <a href="{{ route('product', ['id' => $product->product_id]) }}" class="buy"><i
                                                        class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h4 class="title">
                                                    <a
                                                        href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                                </h4>
                                                <p class="price with-discount">{{ $product->retail_price }} €</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
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
                            @foreach($products->take(3) as $product)
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                <img src="{{ $product->image_url ?? 'https://placehold.co/115x140' }}"
                                                     alt="{{ $product->product_name }}" />
                                                <a href="{{ route('product', ['id' => $product->product_id]) }}" class="buy"><i
                                                        class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h5 class="title">
                                                    <a
                                                        href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                                </h5>
                                                <p class="price with-discount">{{ $product->retail_price }} €</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
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
                            @foreach($products->take(3) as $product)
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                <img src="{{ $product->image_url ?? 'https://placehold.co/115x140' }}"
                                                     alt="{{ $product->product_name }}" />
                                                <a href="{{ route('product', ['id' => $product->product_id]) }}" class="buy"><i
                                                        class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h5 class="title">
                                                    <a
                                                        href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                                </h5>
                                                <p class="price with-discount">{{ $product->retail_price }} €</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
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
                                @foreach($products->take(6) as $product)
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('product', ['id' => $product->product_id]) }}">
                                                <img class="default-img"
                                                     src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
                                                     alt="{{ $product->product_name }}"/>
                                                <img class="hover-img"
                                                     src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
                                                     alt="{{ $product->product_name }}"/>
                                                <span class="out-of-stock">Hot</span>
                                            </a>
                                            <div class="button-head">
                                                <div class="button">
                                                    <a href="#" class="btn"
                                                       onclick="addProductToCart({{ $product->product_id }})">In den
                                                        Warenkorb</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3>
                                                <a
                                                    href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                            </h3>
                                            <div class="product-price">
                                                <span class="old">{{ $product->old_price }} €</span>
                                                <span>{{ $product->retail_price }} €</span>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
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
