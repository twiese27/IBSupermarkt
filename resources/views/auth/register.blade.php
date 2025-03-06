@extends('layouts.app')

@section('title', 'Registrieren')

@section('content')

    <!-- Shop Registrierung -->
    <section class="shop login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Register</h2>
                        
                        <!-- Formular -->
                        <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf <!-- CSRF-Schutz für Laravel -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Forename<span>*</span></label>
                                        <input type="text" name="forename" class="form-control @error('forename') is-invalid @enderror"
                                               value="{{ old('forename') }}" placeholder="John" required />

                                        @error('forename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                                               value="{{ old('middle_name') }}" placeholder="F." />

                                        @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Lastname<span>*</span></label>
                                        <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                                               value="{{ old('lastname') }}" placeholder="Doe" required />

                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Street</label>
                                        <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                                               value="{{ old('street') }}" placeholder="Wallstreet" />

                                        @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>House Number</label>
                                        <input type="text" name="house_number" class="form-control @error('house_number') is-invalid @enderror"
                                               value="{{ old('house_number') }}" placeholder="1" />

                                        @error('house_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Postal Code<span>*</span></label>
                                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                                               value="{{ old('postal_code') }}" placeholder="10005" required />

                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                               value="{{ old('city') }}" placeholder="New York" />

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                                               value="{{ old('country') }}" placeholder="USA" />

                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>IBAN</label>
                                        <input type="text" name="iban" class="form-control @error('iban') is-invalid @enderror"
                                               value="{{ old('iban') }}" placeholder="US12345678901234567890" />

                                        @error('iban')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                                               value="{{ old('birth_date') }}" />

                                        @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>E-Mail-Address<span>*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="John.Doe@example.com" required />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password<span>*</span></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="********" required />

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Confirm Password<span>*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="********" required />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label>Favourite Beer</label>
                                    <div class="form-group" id="favorite_beer">
                                    <select name="favorite_beer" >
                                        <option value="Heineken1">Heineken</option>
                                        <option value="Heineken2">Heineken</option>
                                        <option value="Heineken3">Heineken</option>
                                        <option value="Heineken4">Heineken</option>
                                        <option value="Heineken5">Heineken</option>
                                        <option value="Heineken6">Heineken</option>
                                        <option value="Heineken7">Heineken</option>
                                        <option value="Oettinger">Öttinger</option>
                                        <option value="Andere Ploere">Other plonk</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn btn-primary" type="submit">Register</button>
                                        <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Formular -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Registrierung -->

@endsection
