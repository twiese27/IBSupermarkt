@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

    <section>
        <br>
        <br>
        <div style="text-align: center;">
            <h1> Trending Products </h1>
        </div>
    </section>

    <!-- Start Area 2 -->
    <section class="hero-area4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home-slider-4">
                        <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
                            <div class="inner">
                                <h4 class="title">
                                    make your <br />
                                    site stunning with <br />
                                    large title
                                </h4>
                                <p class="des">
                                    Hipster style is a fashion trending for Gentleman and
                                    Lady<br />with tattoos. You’ll become so cool and attractive
                                    with your’s girl.<br />
                                    Now let come hare and grab it now !
                                </p>
                                <div class="button">
                                    <a href="#" class="btn">Jetzt Einkaufen</a>
                                </div>
                            </div>
                        </div>
                        <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
                            <div class="inner">
                                <h4 class="title">
                                    make your <br />
                                    site stunning with <br />
                                    large title
                                </h4>
                                <p class="des">
                                    Hipster style is a fashion trending for Gentleman and
                                    Lady<br />with tattoos. You’ll become so cool and attractive
                                    with your’s girl.<br />
                                    Now let come hare and grab it now !
                                </p>
                                <div class="button">
                                    <a href="#" class="btn">Jetzt Einkaufen</a>
                                </div>
                            </div>
                        </div>
                        <div class="big-content" style="background-image: url('https://placehold.co/1160x560')">
                            <div class="inner">
                                <h4 class="title">
                                    make your <br />
                                    site stunning with <br />
                                    large title
                                </h4>
                                <p class="des">
                                    Hipster style is a fashion trending for Gentleman and
                                    Lady<br />with tattoos. You’ll become so cool and attractive
                                    with your’s girl.<br />
                                    Now let come hare and grab it now !
                                </p>
                                <div class="button">
                                    <a href="#" class="btn">Jetzt Einkaufen</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Hero Area 2 -->
    <section>
        <br>
        <br>
        <div style="text-align: center;">
            <!--<h1></h1>-->
            <h1>SEARCH RESULTS FOR:" {{ $query }} "</h1>
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
                            @include('partials.product', ['product' => $product])
                        @endforeach
                    @endif
                </div>

                <!-- Pagination-Links -->
                <div class="pagination-container mt-4 d-flex justify-content-center">
                    <nav>
                        <ul class="pagination d-flex flex-wrap">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </section>


    <!-- Include Newsletter -->
    @include('partials.newsletter')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="https://placehold.co/569x528" alt="#" />
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://placehold.co/569x528" alt="#" />
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://placehold.co/569x528" alt="#" />
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://placehold.co/569x528" alt="#" />
                                    </div>
                                </div>
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Flared Shift Dress</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 customer review)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                    </div>
                                </div>
                                <h3>$29.00</h3>
                                <div class="quickview-peragraph">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Mollitia iste laborum ad impedit pariatur esse optio
                                        tempora sint ullam autem deleniti nam in quos qui nemo
                                        ipsum numquam.
                                    </p>
                                </div>
                                <div class="size">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Size</h5>
                                            <select>
                                                <option selected="selected">s</option>
                                                <option>m</option>
                                                <option>l</option>
                                                <option>xl</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Color</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>purple</option>
                                                <option>black</option>
                                                <option>pink</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus"
                                                    data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1" />
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn">In den Warenkorb</a>
                                    <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                </div>
                                <div class="default-social">
                                    <h4 class="share-now">Share:</h4>
                                    <ul>
                                        <li>
                                            <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a>
                                        </li>
                                        <li>
                                            <a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

@endsection
