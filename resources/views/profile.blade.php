@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    <section class="profile section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="profile-form">
                        <h2>Profil</h2>
                        @if(session('user'))
                                @php
                                    $user = session('user');
                                    $customer = session('customer');
                                    $ordersData = session('ordersData');
                                    
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
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Letzte Bestellungen</h2>
                            <div class="content">
                                <!-- Bestell-IDs vertikal anzeigen -->
                                @foreach ($ordersData as $order)
                                    <div>
                                        <a href="javascript:void(0);" class="order-id" data-order-id="{{ $order['order_id'] }}">{{ $order['order_id'] }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal für Bestellinfos -->
    <div id="orderModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Bestellinformationen</h2>
            <div id="orderDetails"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Öffnen des Modals, wenn eine Bestell-ID angeklickt wird
        const orderLinks = document.querySelectorAll('.order-id');
        const modal = document.getElementById('orderModal');
        const closeBtn = document.querySelector('.close');
        const orderDetails = document.getElementById('orderDetails');

        orderLinks.forEach(link => {
            link.addEventListener('click', function () {
                const orderId = this.getAttribute('data-order-id');

                // Hole Bestellinformationen per AJAX oder zeige sie direkt an
                // Beispiel: Zeige einfach die Bestell-ID als Text
                orderDetails.innerHTML = 'Details für Bestellung ID: ' + orderId;
                
                modal.style.display = 'block';
            });
        });

        // Schließe das Modal, wenn auf das Schließen-X geklickt wird
        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        // Schließe das Modal, wenn außerhalb des Modals geklickt wird
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection