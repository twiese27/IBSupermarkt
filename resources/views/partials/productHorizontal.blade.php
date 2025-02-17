<div class="single-list">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="list-image overlay">
                @php
                    $imagePath = "images/product_images/" . str_pad($product->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
                    $imageExists = file_exists(public_path($imagePath));
                    $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/115x115';
                @endphp
                <img src="{{ $backgroundImage}}"
                        alt="{{ $product->product_name }}" />
                <a href="{{ route('product', ['id' => $product->product_id]) }}" class="buy"><i
                        class="fa fa-shopping-bag"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 no-padding">
            <div class="content">
                <h5 class="title">
                    <a
                        href="{{ route('product', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                </h5>
               <p class="price with-discount">
                    <a href="#" onclick="addProductToCart({{ $product->product_id }})">{{ $product->retail_price }} €</a>
                </p>
                    
            </div>
        </div>
    </div>
</div>
