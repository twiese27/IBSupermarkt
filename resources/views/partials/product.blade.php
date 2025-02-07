<div class="col-xl-3 col-lg-4 col-md-4 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="{{ route('product', ['id' => $product->product_id]) }}">
                <img class="default-img" src="https://placehold.co/550x750" alt="#" />
                <img class="hover-img" src="https://placehold.co/550x750" alt="#" />
            </a>
            <div class="button-head">
                <div class="button">
                    <a href="#" class="btn" onclick="addProductToCart({{ $product->product_id }})">In den Warenkorb</a>
                </div>
            </div>
        </div>
        <div class="product-content">
            <h3>
                <a href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
            </h3>
            <div class="product-price">
                <span>{{ $product->retail_price }} €</span>
            </div>
        </div>
    </div>
</div>
