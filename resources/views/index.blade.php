@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<!-- Start For You Suggestion Slider -->
    <section class="hero-area4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home-slider-4">
                        @php
                            <!-- TJADE, Lennart hat hier nur das Partial eingebunden. Du wolltest ja, die Produkte raussuchen-->
                            $recommendedProducts = session('recommendedProducts', collect());
                            $displayProducts = Auth::check() ? $recommendedProducts : $products->take(5);
                            
                        @endphp

                        @foreach ($displayProducts as $product)
                            @include('partials.sliderElement', ['product' => $product])
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
<!--/ End For You Suggestion Slider -->

    <!-- Start Produktbereich -->
    
    
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h1>Trending Products</h1>
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
                                    
                                    @foreach ($trendingProducts as $product)
                                        @include('partials.product', ['product' => $product, 'labelText' => 'Trend'])

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
                                        <h1>Insider Tip</h1>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single List  -->
                            @foreach(collect($insiderTip)->shuffle()->take(3) as $product)
                                @include('partials.productHorizontal')
                            @endforeach

                        <!-- End Single List  -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shop-section-title">
                                        <h1>Conscious living</h1>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single List  -->
                            @foreach($products->take(3) as $product)
                                @include('partials.productHorizontal')

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
                            @foreach($bestseller->take(3) as $product)
                                @include('partials.productHorizontal')
                            @endforeach
                        </div>
                        <!-- End Single List  -->
                    </div>
                </div>
            </section>
            <!-- End Shop Home List  -->

            <!-- Start New Items -->
                @include('partials.sliderOfFourVisibles', ['products' => $newProducts, 'headerText' => 'New Items', 'labelText' => 'New'])
            
            <!-- End New Items Area -->
            <!-- Start Cowndown Area -->
            <section class="cown-down">
                <div class="section-inner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-12 padding-right">
                                <div class="image">
                                    @php
                                        $imagePath = "images\\product_images\\0000{$product->product_id}_00001_.png";
                                        $imageExists = file_exists(public_path($imagePath));
                                        $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/512x512';
                                    @endphp
                                    
                                    <a href="{{ route('product', ['id' => $product->product_id]) }}" class="buy">
                                        <img src="{{ $backgroundImage}}" alt="{{ $insiderTipBig->product_name }}" />
                                    </a>
                                    <div class="button-head">
                                        <div class="button">
                                            <a href="#" class="btn" onclick="addProductToCart('{{ $insiderTipBig->product_id }}')">Add to shopping cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 padding-left">
                                <div class="content">
                                    <div class="heading-block">
                                        <p class="small-title">Insider Tip</p>
                                        <h3 class="title">{{ $insiderTipBig->product_name }}</h3>
                                        <a href="#" class="btn" onclick="addProductToCart('{{ $insiderTipBig->product_id }}')">Add to shopping cart</a>
                                        <h1 class="price">{{ $insiderTipBig->retail_price }} € <s>{{ $insiderTipBig->retail_price }} €</s></h1>
                                        <div class="coming-time">
                                            <div class="clearfix" data-countdown="2025/03/14"></div>
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
                                    <a href="#" class="btn">Add to shopping cart</a>
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
