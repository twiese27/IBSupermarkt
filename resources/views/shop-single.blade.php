@extends('layouts.app')

@section('title', $product->product_name)

@section('content')

<!-- Start Product Details -->
<section class="shop single section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-lg-6 col-12">
            <!-- Product image -->
            <div class="product-gallery">
              @php
                  $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
                  $imageExists = file_exists(public_path($imagePath));
                  $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/512x512';
              @endphp
              <img src="{{$backgroundImage}}" alt="#" />
            </div>
            <!-- End Product image -->
          </div>
          <div class="col-lg-6 col-12">
            <div class="product-des">
              <!-- Description -->
              <div class="short">
                <h4>{{ $product->product_name }}</h4>

                <p class="price">
                  <span class="discount">{{$product->retail_price}} €</span>
                </p>
                <p class="description">
                Discover the high-quality {{ $category->name }} from {{ $producer->name }}, designed to meet your expectations in both functionality and sustainability. This product comes with a {{ $product->gross_weight }} kg total weight, ensuring optimal use for various needs.
                We care about environmental responsibility—this product {{ $product->recyclable_package ? 'features a recyclable package' : 'does not come in a recyclable package' }}, aligning with sustainable consumption choices.
                Additionally, for those mindful of dietary aspects, this product {{ $product->low_fat ? 'is a low-fat option, making it a great choice for a balanced lifestyle' : 'does not fall under the low-fat category' }}.
                Experience a product that combines quality, thoughtful packaging, and essential attributes to fit seamlessly into your lifestyle.
                </p>
              </div>
              <!--/ End Description -->

              <!-- Product Buy -->
              <div class="product-buy">
                  <form action="{{ route('cart.addToCart') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                  <div class="quantity">
                    <h6>Amount :</h6>
                    <!-- Input Order -->
                    <div class="input-group">
                      <div class="button minus">
                        <button type="button" onclick="decreaseProductDetail()" class="btn btn-primary btn-number" data-type="minus"
                          data-field="quant[1]">
                          <i class="ti-minus"></i>
                        </button>
                      </div>
                      <input id="quantityProductDetail" type="text" name="quantity" class="input-number" data-min="1" data-max="1000" value="1" />
                      <div class="button plus">
                        <button type="button" onclick="increaseProductDetail()" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                          <i class="ti-plus"></i>
                        </button>
                      </div>
                    </div>
                    <!--/ End Input Order -->
                  </div>
                  <div class="add-to-cart">
                    <button type="submit" id="BuyButton" class="btn">Add to shopping cart</button>
                  </div>
                </form>
                <p style="margin-top: 20px;">Category : {{ $category->name }}</p>
                <p>Producer : {{ $producer->name }} </p>
                <p>Recycblabel package: {{ $product->recyclable_package ? 'Yes' : 'No' }}</p>
                <p>Weight: {{ $product->gross_weight }} kg</p>
                <p>Low fat: {{ $product->low_fat ? 'Yes' : 'No' }}</p>
              </div>
              <!-- End Product Buy -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Product Details -->

<!-- Start ecofriendly Alternatives -->
  @if(optional($ecofriendlyProducts)->count() > 1)
    @include('partials.displayUpToThreeProductsHorizontally', ['productsHorizontal' => $ecofriendlyProducts, 'headerText' => 'Ecofriendly Alternatives'])
  @endif
<!-- End ecofriendly Alternatives -->

<!-- Start Similar Products -->
  @if($similarProducts->count() > 1)
    @include('partials.sliderOfFourVisibles', ['products' => $similarProducts, 'headerText' => 'Similar Products', 'labelText' => 'Similiar'])
  @endif
  <!-- End Similar Products -->

<!-- Start customers also bought  Products -->
  @if($customersAlsoBought->count() > 1)
    @include('partials.sliderOfFourVisibles', ['products' => $customersAlsoBought, 'headerText' => 'Customers Also Bought', 'labelText' => 'none'])
  @endif

<!-- End customers also bought Products -->

@endsection
