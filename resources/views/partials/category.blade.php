@foreach($categories as $category)
    <li>
        <a href="{{ route('category', ['name' => $category->name]) }}?categoryId={{ $category->product_category_id }}">
            {{ $category->name }}<i class="ti-angle-down"></i>
        </a>
        <ul class="dropdown">
            @foreach($category->children as $subcategory)
                <li>
                    <a href="{{ route('category', ['name' => $subcategory->name]) }}?categoryId={{ $subcategory->product_category_id }}">{{ $subcategory->name }}
                        @if (count($category->children) > 0)
                            <i class="ti-angle-right"></i>
                        @endif
                    </a>
                    @if (count($subcategory->children) > 0)
                        <ul class="dropdown sub-dropdown">
                            @include('partials.subcategory', ['categories' => $subcategory->children])
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </li>
@endforeach
