
@php
    $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
    $imageExists = file_exists(public_path($imagePath));
    $backgroundImage = $imageExists ? asset($imagePath) : 'https://placehold.co/1160x560';
@endphp
<div class="big-content" style="background-image: url('{{ $backgroundImage }}');">
    <div class="inner">
        <h4 class="title">
            {{$product->product_name}}
        </h4>
        <div class="button">
            <a href="#" class="btn" onclick="addProductToCart({{ $product->product_id }})">Add to shopping cart</a>
        </div>
    </div>
</div>