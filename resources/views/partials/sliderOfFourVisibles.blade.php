<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>{{$headerText}}</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="owl-carousel popular-slider">
          <!-- Start Single Product -->
          @foreach($products->take(6) as $product)
            @include('partials.productWithLabel', ['product' => $product, 'labelText' => $labelText])
          
          @endforeach
          <!-- End Single Product -->
        </div>
      </div>
    </div>
  </div>
</div>