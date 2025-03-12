<div class="single-list">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="list-image overlay">
                @php
                    $imagePath = "images/product_images/" . str_pad($productHorizontal->product_id, 5, "0", STR_PAD_LEFT) . "_00001_.png";
                    $imageExists = file_exists(public_path($imagePath));
                    $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/115x115';
                @endphp
                <img src="{{ $backgroundImage}}"
                     alt="{{ $productHorizontal->product_name }}" />
                <a style="cursor: pointer" onclick="addProductToCart('{{ $productHorizontal->product_id }}')" class="buy"><i
                        class="fa fa-shopping-bag"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12 no-padding">
            <div class="content">
                <h5 class="title">
                    <a
                        href="{{ route('product', ['id' => $productHorizontal->product_id]) }}">{{ $productHorizontal->product_name }}</a>
                </h5>
                <a href="{{ route('product', ['id' => $productHorizontal->product_id]) }}" class="price with-discount" id="BuyButtonHorizontal">{{ $productHorizontal->retail_price }} €</a>

            </div>
        </div>
    </div>
</div>
