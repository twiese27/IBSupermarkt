@extends('layouts.app')

@section('title', 'Warenkorb')

@section('content')

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                        <tr class="main-hading">
                            <th>PRODUKT</th>
                            <th>NAME</th>
                            <th class="text-center">STÜCKPREIS</th>
                            <th class="text-center">MENGE</th>
                            <th class="text-center">GESAMT</th>
                            <th class="text-center">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn"
                                            style="background: none; border: none; padding: 0;">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach($items as $item)
                            @php
                                $qty = $item->total_amount;
                                $total = $item->product->retail_price * $qty;
                                $subtotal += $total;
                            @endphp
                            <tr>
                                <td class="image" data-title="No">
                                    <img src="https://placehold.co/100x100" alt="#"/>
                                </td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name"><a href="#">{{ $item->product->product_name }}</a></p>
                                </td>
                                <td class="price" data-title="Price">
                                    <span>{{ $item->product->retail_price }} €</span>
                                </td>
                                <td class="qty" data-title="Qty">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" onclick="decreaseProduct({{ $item->product->product_id }})">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input id="quantity-{{ $item->product->product_id }}" type="text" name="quant[{{ $loop->index }}]" class="input-number" data-min="1" data-max="100" value="{{ $qty }}"/>
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" onclick="increaseProduct({{ $item->product->product_id }})">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </td>
                                <td class="total-amount" data-title="Total">
                                    <span id="total-{{ $item->product->product_id }}">{{ $total }} €</span>
                                </td>
                                <td class="action" data-title="Remove">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product->product_id }}">
                                        <button type="submit" class="btn"
                                                style="background: transparent; border: none; padding: 0;">
                                            <i class="ti-trash" style="color: black;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Zwischensumme<span id="subtotal">{{ $subtotal }} €</span></li>
                                        <li>Versand<span>Kostenlos</span></li>
                                        <li class="last">Sie zahlen<span id="total">{{ $subtotal }} €</span></li>
                                    </ul>
                                    <div class="button5">
                                        <a href="{{ route('checkout') }}" class="btn">Zur Kasse</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

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
                            <div class="quickview-content">
                                <h2>Flared Shift Kleid</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 Kundenbewertung)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> auf Lager</span>
                                    </div>
                                </div>
                                <h3>29,00€</h3>
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
                                            <h5 class="title">Größe</h5>
                                            <select>
                                                <option selected="selected">s</option>
                                                <option>m</option>
                                                <option>l</option>
                                                <option>xl</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Farbe</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>lila</option>
                                                <option>schwarz</option>
                                                <option>rosa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                                                    data-type="minus"
                                                    data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant[1]" class="input-number" data-min="1"
                                               data-max="1000" value="1"/>
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                    data-field="quant[1]">
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
                                    <h4 class="share-now">Teilen:</h4>
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
