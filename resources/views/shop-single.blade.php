@extends('layouts.app')

@section('title', 'Produktseite')

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
              <!-- End Images slider -->
            </div>
            <!-- End Product slider -->
          </div>
          <div class="col-lg-6 col-12">
            <div class="product-des">
              <!-- Description -->
              <div class="short">
                <h4>Nonstick Dishwasher PFOA</h4>
                
                <p class="price">
                  <span class="discount">$70.00</span><s>$80.00</s>
                </p>
                <p class="description">
                  eget velit. Donec ac tempus ante. Fusce ultricies massa
                  massa. Fusce aliquam, purus eget sagittis vulputate,
                  sapien libero hendrerit est, sed commodo augue nisi non
                  neque. Lorem ipsum dolor sit amet, consectetur adipiscing
                  elit. Sed tempor, lorem et placerat vestibulum, metus nisi
                  posuere nisl, in
                </p>
              </div>
              <!--/ End Description -->
              
              <!-- Product Buy -->
              <div class="product-buy">
                <div class="quantity">
                  <h6>Menge :</h6>
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
                  <a href="#" class="btn">In den Warenkorb</a>
                  <a href="#" class="btn min"><i class="ti-heart"></i></a>
                  <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                </div>
                <p class="cat">Kategorie :<a href="#">Kleidung</a></p>
                <p class="availability">
                  Verfügbarkeit : 180 Produkte auf Lager
                </p>
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
                    <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Beschreibung</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bewertungen</a>
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
                          <p>
                            simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of
                            type and scrambled it to make a type specimen
                            book. It has survived not only five centuries,
                            but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was
                            popularised in the 1960s with the release of
                            Letraset sheets containing Lorem Ipsum passages,
                            and more recently with deskto
                          </p>
                        </div>
                        <div class="single-des">
                          <p>
                            Suspendisse consequatur voluptates lorem nobis
                            accumsan natus mattis. Optio pede, optio qui
                            metus, delectus! Ultricies impedit, minus tempor
                            fuga, quasi, pede felis commodo bibendum
                            voluptas nisi? Voluptatem risus tempore tempora.
                            Quaerat aspernatur? Error praesent laoreet, cras
                            in fames hac ea, massa montes diamlorem nec
                            quaerat, quos occaecati leo nam aliquet
                            corporis, ab recusandae parturient, etiam
                            fermentum, a quasi possimus commodi, mollis
                            voluptate mauris mollis, quisque donec
                          </p>
                        </div>
                        <div class="single-des">
                          <h4>Product Features:</h4>
                          <ul>
                            <li>long established fact.</li>
                            <li>has a more-or-less normal distribution.</li>
                            <li>lmany variations of passages of.</li>
                            <li>generators on the Interne.</li>
                          </ul>
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

<!-- Start Most Popular -->
<div class="product-area most-popular related-product section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Ähnliche Produkte</h2>
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
                <div class="product-action">
                  <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                      class="ti-eye"></i><span>Schnellansicht</span></a>
                  <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste hinzufügen</span></a>
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
          <!-- End Single Product -->
          <!-- Start Single Product -->
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
                  <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste hinzufügen</span></a>
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
                <div class="product-action">
                  <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                      class="ti-eye"></i><span>Schnellansicht</span></a>
                  <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste hinzufügen</span></a>
                  <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Zum Vergleich
                      hinzufügen</span></a>
                </div>
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
                <div class="product-action">
                  <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                      class="ti-eye"></i><span>Schnellansicht</span></a>
                  <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Zur Wunschliste hinzufügen</span></a>
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
<!-- End Most Popular Area -->

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