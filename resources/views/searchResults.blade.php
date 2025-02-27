@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

    
    <section>
        <br>
        <br>
        <div style="text-align: center;">
            <!--<h1></h1>-->
            <h1>SEARCH RESULTS FOR: "{{ $query }}"</h1>
        </div>
    </section>
    <section class="product-area shop-sidebar shop section">
        <div class="container">
            <div class="col-lg-12 col-md-8 col-12">
                <div class="row" id="product-grid">
                    @if($products->isEmpty())
                        <p>Keine Produkte gefunden.</p>
                    @else
                        @foreach($products as $product)
                            @include('partials.product', ['product' => $product, 'labelText' => 'none'])
                        @endforeach
                    @endif
                     <!-- Pagination in derselben Row -->
                    <div class="col-12 text-center mt-4">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Include Newsletter -->
    @include('partials.newsletter')


@endsection
