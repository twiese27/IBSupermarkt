@extends('layouts.app')

@section('title', 'Startseite')

@section('content')

<!-- Start For You Suggestion Slider, Only when logged in-->
    @if(\Illuminate\Support\Facades\Auth::check())
        @php
            $recommendedProducts = session('recommendedProducts', collect());
        @endphp
        @if($recommendedProducts->isNotEmpty())
            <section class="hero-area4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h1>Recommendations For You</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="home-slider-4">
                                

                                @foreach ($recommendedProducts as $product)
                                    @include('partials.sliderElement', ['product' => $product])
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
<!-- End For You Suggestion Slider, Only when logged in -->

<!-- Start Trending Products -->    
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
<!-- Ende Trending Products -->    

<!-- Start Insider Tip , Conscious Living, Bestesller  -->
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
                            @foreach(collect($insiderTip)->shuffle()->take(3) as $productHorizontal)
                                @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])
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
                            @foreach($consciousLivingProducts->take(3) as $productHorizontal)
                                @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])

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
                            @foreach($bestseller->take(3) as $productHorizontal)
                                @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])
                            @endforeach
                        </div>
                        <!-- End Single List  -->
                    </div>
                </div>
            </section>
            <!-- End Shop Home List  -->
<!-- End Insider Tip , Conscious Living, Bestesller  -->

<!-- Start New Items -->
    @include('partials.sliderOfFourVisibles', ['products' => $newProducts, 'headerText' => 'New Items', 'labelText' => 'New'])
<!-- End New Items Area -->

<!-- Start Special Offer -->
            <section class="cown-down">
                <div class="section-inner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-12 padding-right">
                                <div class="image">
                                    @php
                                        $imagePath = "images/product_images/" . str_pad($specialOffer->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
                                        $imageExists = file_exists(public_path($imagePath));
                                        $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/512x512';
                                    @endphp
                                    
                                    <a href="{{ route('product', ['id' => $specialOffer->product_id]) }}" class="buy">
                                        <img src="{{ $backgroundImage}}" alt="{{ $specialOffer->product_name }}" />
                                    </a>
                                    <div class="button-head">
                                        <div class="button">
                                            <a href="#" id="BuyButton" class="btn" onclick="addProductToCart('{{ $specialOffer->product_id }}')">Add to shopping cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 padding-left">
                                <div class="content">
                                    <div class="heading-block">
                                        <p class="small-title">Special Offer</p>
                                        <h3 class="title">{{ $specialOffer->product_name }}</h3>
                                        <a href="#" class="btn" id="BuyButton" onclick="addProductToCart('{{ $specialOffer->product_id }}')">Add to shopping cart</a>
                                        @php
                                            $specialOfferIncreasedPrice = $specialOffer->retail_price * 1.2;
                                        @endphp
                                        <h1 class="price">{{ $specialOffer->retail_price }} € <s>{{ $specialOfferIncreasedPrice }} €</s></h1>
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
<!-- End Special Offer -->

<!-- Start Include Neusletter -->
    @include('partials.newsletter')
<!-- End Include Neusletter -->

@endsection
