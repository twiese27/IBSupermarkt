@extends('layouts.app')

@section('title', 'Shop Grid')

@section('content')


<!-- Start trending products in this category -->
    @if(count($trendingProducts))
        <section>
            <br>
            <br>
            <div style="text-align: center;">
                <h1>Bestseller in this category</h1>
            </div>
        </section>
        <section class="hero-area4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="home-slider-4">
                            @foreach ($trendingProducts as $product)
                                @include('partials.sliderElement', ['product' => $product])
                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
<!-- End trending products in this category -->

<!-- Start Assoziationsanalyse: similiar categories -->
    @if($similarCategorys->count() > 0)
        @include('partials.displayUpToThreeCategorysHorizontal', ['productCategory' => $similarCategorys])
    @endif
<!-- End Assoziationsanalyse: similiar categories -->

<!-- Start products in this category -->
    <section>
        <br>
        <br>
        <div style="text-align: center;">
            <h1> {{ $categoryName }} </h1>
        </div>
    </section>

    <section class="product-area shop-sidebar shop section">
        <div class="container">
            <div class="col-lg-12 col-md-8 col-12">
                <div class="row" id="product-grid">
                    @foreach($products as $product)
                        @include('partials.product', ['product' => $product, 'labelText' => 'none'])
                    @endforeach
                    <div class="col-12 text-center mt-4">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End products in this category -->

<!-- Start Include Newsletter -->
    @include('partials.newsletter')
<!-- End Include Newsletter -->
    
@endsection