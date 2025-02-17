@php
    $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
    $imageExists = file_exists(public_path($imagePath));
    $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/512x512';
@endphp
<div class="single-product">
    <div class="product-img">
        <a href="{{ route('product', ['id' => $product->product_id]) }}">
            <img class="default-img" src="{{ $backgroundImage }}"
            alt="{{ $product->product_name }}" />
              <img class="hover-img" src="{{ $backgroundImage }}"
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