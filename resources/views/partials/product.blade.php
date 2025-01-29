<div class="col-xl-3 col-lg-4 col-md-4 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="{{ route('shop-single', ['id' => $product->product_id]) }}">
                <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
            </a>
            <div class="button-head">
                <form action="{{ route('cart.add') }}" method="POST" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <button type="submit" class="btn" style="width: 100%;">In den Warenkorb</button>
                </form>
            </div>
        </div>
        <div class="product-content">
            <h3>
                <a href="{{ route('shop-single', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
            </h3>
            <div class="product-price">
                <span>{{ $product->retail_price }} €</span>
            </div>
        </div>
    </div>
</div>