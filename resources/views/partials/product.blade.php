<div class="col-xl-3 col-lg-4 col-md-4 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="{{ route('product', ['id' => $product->product_id]) }}">  
                @php
                    $imagePath = "images\\product_images\\0000{$product->product_id}_00001_.png";
                    $imageExists = file_exists(public_path($imagePath));
                    $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/512x512';
                @endphp
                <img class="default-img" src="{{ $backgroundImage}}" alt="#" />
                <img class="hover-img" src="{{ $backgroundImage}}" alt="#" />
            </a>
            <div class="button-head">
                <div class="button">
                    <a href="#" class="btn" onclick="addProductToCart({{ $product->product_id }})">Add to shopping cart</a>
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
