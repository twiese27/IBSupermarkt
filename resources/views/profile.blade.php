@extends('layouts.app')

@section('title', 'Profil')

@section('content')

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<section class="profile section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="profile-form">
                    <h2>Profil</h2>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @php
                            // $user = session('user');
                            // $customer = session('customer');
                            // $ordersData = session('ordersData');
                        @endphp
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Customer-ID: {{ $user['user_account_id'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Vorname: {{ $customer['forename'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nachname: {{ $customer['lastname'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Adresse: {{ $customer['email'] }}</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Land: {{ $customer['country'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Stadt: {{ $customer['city'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Straße: {{ $customer['street'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Hausnummer: {{ $customer['house_number'] }}</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Postleitzahl: {{ $customer['postal_code'] }}</label><br/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="btn" type="submit">Abmelden</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <script>
                            window.location.href = "{{ route('login') }}";
                        </script>
                    @endif
                </div>
            </div>

            <!-- Rechte Spalte mit Bestellungen -->
            <div class="col-lg-4 col-12">
                <div class="order-details">
                    <div class="single-widget">
                        <h2>Letzte Bestellungen</h2>
                        <div class="content">
                            @foreach ($ordersData as $order)
                                <div x-data="{ open: false }">
                                    <!-- Button zum Öffnen des Modals -->
                                    <button @click="open = true"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 mt-2">
                                        Details ansehen
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="open"
                                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0">

                                        <div @click.away="open = false"
                                             class="bg-white rounded-lg shadow-lg p-6 w-96">

                                            <!-- Modal Header
                                            <div class="flex justify-between items-center border-b pb-2">
                                                <h2 class="text-lg font-semibold">Bestellungsdetails</h2>
                                                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                                            </div> -->


                                            <!-- Modal Body -->
                                            <div class="mt-4">
                                                <p><strong>Bestellnummer: </strong> {{$order['order_id']}} </p>
                                                <p><strong>Datum: </strong>{{$order['order_time']}}</p>
                                                <p><strong>Gesamtbetrag: </strong> {{$order['total_price']}}</p>
                                                <p><strong>Status: </strong> {{$order['status']}}</p>
                                                @foreach ($order['products'] as $product)
                                                    <p><strong>Produkt: </strong><a href="{{ route('product', ['id' => $product['product_id']]) }}">{{$product['product_name']}}</a><strong> | </strong> x{{$product['total_amount']}}    </p>
                                                @endforeach
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <button @click="open = false" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                                    Schließen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
