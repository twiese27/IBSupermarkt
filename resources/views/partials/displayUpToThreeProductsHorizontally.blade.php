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
      @if($productsHorizontal->count() == 1)
        @foreach($productsHorizontal->take(2) as $productHorizontal)
          <div class="col-lg-12 col-md-6 col-12">
            @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])
          </div>
        @endforeach
      @elseif($productsHorizontal->count() == 2)
        @foreach($productsHorizontal->take(3) as $productHorizontal)
          <div class="col-lg-4 col-md-6 col-12">
            @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])
          </div>
        @endforeach
      @else
      
      @foreach($productsHorizontal->take(3) as $productHorizontal)
          <div class="col-lg-4 col-md-6 col-12">
            @include('partials.productHorizontal', ['productHorizontal' => $productHorizontal])
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>