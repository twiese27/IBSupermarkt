@php
    $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
    $imageExists = file_exists(public_path($imagePath));
    $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/512x512';
@endphp

<div class="product-item" style="display: flex; align-items: center; gap: 20px; background: #f9f9f9; padding: 20px; border-radius: 8px; width: 100%; max-width: 1024px; margin: auto;">
    <!-- Left Side: Product Image -->
    <div class="product-image" style="width: 512px; height: 512px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
        <a href="{{ route('product', ['id' => $product->product_id]) }}">
            <img src="{{ $backgroundImage }}" alt="{{ $product->product_name }}" style="width: 512px; height: 512px; border-radius: 8px; object-fit: cover; display: block;">
        </a>
    </div>
    
    <!-- Right Side: Product Details -->
    <div class="product-details" style="flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 20px;">
        <h4 class="title" style="margin-bottom: 10px;">
            <a href="{{ route('product', ['id' => $product->product_id]) }}" style="text-decoration: none; color: inherit;">
                {{ $product->product_name }}
            </a>
        </h4>
        <div class="button">
            <a href="#" id="BuyButton" class="btn" onclick="addProductToCart({{ $product->product_id }})" >Add to shopping cart</a>
        </div>
    </div>
</div>