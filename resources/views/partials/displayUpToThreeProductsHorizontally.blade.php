<section class="shop-home-list section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>{{$headerText}}</h2>
        </div>
      </div>
    </div>
    <div class="row">
      @if($products->count() == 1)
        @foreach($products->take(2) as $product)
          <div class="col-lg-12 col-md-6 col-12">
            @include('partials.productHorizontal', ['product' => $product])
          </div>
        @endforeach
      @elseif($products->count() == 2)
        @foreach($products->take(3) as $product)
          <div class="col-lg-4 col-md-6 col-12">
            @include('partials.productHorizontal', ['product' => $product])
          </div>
        @endforeach
      @else
      @foreach($products->take(3) as $product)
          <div class="col-lg-4 col-md-6 col-12">
            @include('partials.productHorizontal', ['product' => $product])
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>