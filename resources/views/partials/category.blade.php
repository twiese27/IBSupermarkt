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
                            @include('partials.category', ['categories' => $subcategory->children])
                        </ul>
                    @endif
{{--                    <ul class="dropdown sub-dropdown">--}}
{{--                        @foreach($subcategory->children as $subsubcategory)--}}
{{--                            <li><a href="#">{{ $subsubcategory->name }}<i class="ti-angle-right"></i></a>--}}
{{--                                <ul class="dropdown sub-dropdown">--}}
{{--                                @foreach($subsubcategory->children as $subsubsubcategory)--}}
{{--                                        <li><a href="#">{{ $subsubsubcategory->name }}--}}
{{--                                                @if(count($subsubsubcategory) > 0)--}}
{{--                                                    <i class="ti-angle-right"></i>--}}
{{--                                                @endif--}}
{{--                                            </a></li>--}}
{{--                                @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
                </li>
            @endforeach
        </ul>
    </li>
@endforeach
