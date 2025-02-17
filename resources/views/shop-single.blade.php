@extends('layouts.app')

@section('title', $product->product_name)

@section('content')

<!-- Shop Single -->
<section class="shop single section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-lg-6 col-12">
            <!-- Product Slider -->
            <div class="product-gallery">
              <!-- Images slider -->
              @php
                  $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
                  $imageExists = file_exists(public_path($imagePath));
                  $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/512x512';
              @endphp
              <img src="{{$backgroundImage}}" alt="#" />
              <!--
              <div class="flexslider-thumbnails">
                <ul class="slides">
                  <li data-thumb="https://placehold.co/570x520" rel="adjustX:10, adjustY:">
                    <img src="https://placehold.co/570x520" alt="#" />
                  </li>
                  <li data-thumb="https://placehold.co/570x520">
                    <img src="https://placehold.co/570x520" alt="#" />
                  </li>
                  <li data-thumb="https://placehold.co/570x520">
                    <img src="https://placehold.co/570x520" alt="#" />
                  </li>
                  <li data-thumb="https://placehold.co/570x520">
                    <img src="https://placehold.co/570x520" alt="#" />
                  </li>
                </ul>
              </div>
              -->
              <!-- End Images slider -->
            </div>
            <!-- End Product slider -->
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
                    <button type="submit" class="btn">Add to shopping cart</button>
                  </div>
                </form>
                <p style="margin-top: 20px;">Category : {{ $category->name }}</p>
                <p>Producer : {{ $producer->name }} </p>
                <p>Units per case: {{ $product->units_per_case }}</p>
                <p>Recycblabel package: {{ $product->recyclable_package ? 'Yes' : 'No' }}</p>
                <p>Weight: {{ $product->gross_weight }} kg</p>
                <p>Low fat: {{ $product->low_fat ? 'Yes' : 'No' }}</p>
              </div>
              <!--/ End Product Buy -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-info">
              <div class="nav-main">
                <!-- Tab Nav -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                  </li>

                </ul>
                <!--/ End Tab Nav -->
              </div>
              <div class="tab-content" id="myTabContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                  <div class="tab-single">
                    <div class="row">
                      <div class="col-12">
                        <div class="single-des">
                          <p class="dummy-text">
                          This outstanding product, produced by the renowned manufacturer
                            {{ $producer->name }},
                            falls under the category {{ $category->name }}. It is characterized by its high quality
                            and
                            reliability. Each package contains {{ $product->units_per_case }} carefully packed
                            units,
                            known for their durability and efficiency. In addition, this product is
                            {{ $product->recyclable_package ? 'in an environmentally friendly, recyclable package' : 'unfortunately not recyclable' }},
                            which makes it an excellent choice for environmentally conscious consumers. With a
                            gross weight of
                            {{ $product->gross_weight }} kg, it offers a robust and stable solution for your
                            needs.
                            It is also {{ $product->low_fat ? 'low fat' : 'not low fat' }}, which makes it a
                            healthier option
                            for nutrition-conscious customers.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ End Description Tab -->
                <!-- Reviews Tab -->

                <!--/ End Reviews Tab -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Shop Single -->

<!-- Start Similar -->
<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Similar products</h2>
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
          <img class="default-img" src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
            alt="{{ $product->product_name }}" />
          <img class="hover-img" src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
            alt="{{ $product->product_name }}" />
          <span class="out-of-stock">Hot</span>
          </a>
          <div class="button-head">
          <form style="width: 100%;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <button type="submit" class="btn" style="width: 100%;">Add to shopping cart</button>
          </form>
          </div>
        </div>
        <div class="product-content">
          <h3>
          <a href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
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
      <div class="product-action-2">
        <a title="Add to cart" href="#">Add to shopping cart</a>
      </div>
      <div class="product-action-2">
        <a title="Add to cart" href="#">Add to shopping cart</a>
      </div>
    </div>
  </div>
</div>
<!-- End Similar -->

<!-- Start Alternatives -->
<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Alternatives</h2>
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
          <img class="default-img" src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
            alt="{{ $product->product_name }}" />
          <img class="hover-img" src="{{ $product->image_url ?? 'https://placehold.co/550x750' }}"
            alt="{{ $product->product_name }}" />
          <span class="out-of-stock">Hot</span>
          </a>
          <div class="button-head">
          <form style="width: 100%;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <button type="submit" class="btn" style="width: 100%;">Add to shopping cart</button>
          </form>
          </div>
        </div>
        <div class="product-content">
          <h3>
          <a href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
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
<!-- End Alternatives -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
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
                    <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus"
                      data-field="quant[1]">
                      <i class="ti-minus"></i>
                    </button>
                  </div>
                  <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1" />
                  <div class="button plus">
                    <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
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
