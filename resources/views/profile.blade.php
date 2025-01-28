@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    <section class="profile section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="profile-form">
                        <h2>Profil</h2>

                        <!-- Form -->
                        <form class="form" method="post" action="#">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Customer-ID</label><br/>
                                        <input type="text" name="name" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Vorname</label><br/>
                                        <input type="text" name="name" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nachname</label><br/>
                                        <input type="text" name="name" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email Adresse</label>
                                        <input type="email" name="email" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Telefonnummer</label>
                                        <input type="number" name="number" placeholder="" required="required" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Land</label><br/>
                                        <input type="text" name="country" placeholder="" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Stadt</label><br/>
                                        <input type="text" name="city" placeholder="" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Straße</label><br/>
                                        <input type="text" name="street" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Hausnummer</label>
                                        <input type="text" name="housenumber" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Postleitzahl</label><br/>
                                        <input type="text" name="post" placeholder="" required="required" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="button" name="update" value="Bearbeiten" style="width: 150px; height: 35px; font-size: 15px;" />
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Letzte Bestellungen</h2>
                            <div class="content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
