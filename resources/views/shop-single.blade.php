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
                This outstanding product, produced by the renowned manufacturer {{ $producer->name }},
                  falls under the category {{ $category->name }}. It is characterized by its high quality and
                  reliability. Each package contains {{ $product->units_per_case }} carefully packed
                  units,
                  known for their durability and efficiency. In addition, this product is
                  {{ $product->recyclable_package ? 'in an environmentally friendly, recyclable package' : 'unfortunately not recyclable' }},
                  which makes it an excellent choice for environmentally conscious consumers. With a gross weight of
                  {{ $product->gross_weight }} kg, it offers a robust and stable solution for your needs.
                  It is also {{ $product->low_fat ? 'low fat' : 'not low fat' }}, which makes it a healthier option
                  for nutrition-conscious customers.
                </p>
              </div>
              <!--/ End Description -->

              <!-- Product Buy -->
              <div class="product-buy">
                <form>
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                  <div class="quantity">
                    <h6>Amount :</h6>
                    <!-- Input Order -->
                    <div class="input-group">
                      <div class="button minus">
                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus"
                          data-field="quant[1]">
                          <i class="ti-minus"></i>
                        </button>
                      </div>
                      <input type="text" name="quantity" class="input-number" data-min="1" data-max="1000" value="1" />
                      <div class="button plus">
                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
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
                <p>Units per case: {{ $product->units_per_case }}</p>
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
