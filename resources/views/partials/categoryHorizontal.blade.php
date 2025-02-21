<div class="single-list">
    <div class="row">
        <a href="{{ route('category', ['name' => $productCategory->name]) }}?categoryId={{ $productCategory->product_category_id }}" class="d-flex w-100">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="list-image overlay">
                    
                    @php
                        $imagePath = "images/product_category_images/" . str_pad($productCategory->product_category_id, 5, "0", STR_PAD_LEFT) . ".png";
                        $imageExists = file_exists(public_path($imagePath));
                        $backgroundImage = $imageExists ? $imagePath : 'https://placehold.co/115x115';
                    @endphp
                    <img src="{{ asset($backgroundImage) }}" alt="{{ $productCategory->name }}" />

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 no-padding">
                <div class="content">
                    <h5 class="title">{{$productCategory->name}}</h5>                 
                </div>
            </div>
        </a>
    </div>
</div>
