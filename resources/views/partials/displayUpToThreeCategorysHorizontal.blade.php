<br>
<br>
<section class="shop-home-list section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Other Suggested Categories</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach($similarCategorys->take(3) as $similarCategory)
        <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
          @include('partials.categoryHorizontal', ['productCategory' => $similarCategory])
        </div>
      @endforeach
    </div>
  </div>
</section>
