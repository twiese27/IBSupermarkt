@foreach($categories as $category)
    <li>
        <a href="#">{{ $category->name }}<i class="ti-angle-down"></i></a>
        <ul class="dropdown">
            @foreach($category->children as $subcategory)
                <li>
                    <a href="#">{{ $subcategory->name }}
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
