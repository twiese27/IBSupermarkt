@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form method="post" action="{{ route('checkout.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Checkout</h2>
                            <!-- Form -->
                            <div class="form" method="post" action="{{ route('checkout.submit') }}"
                                 enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Forename<span>*</span></label>
                                            <input type="text" name="forename"
                                                   class="form-control @error('forename') is-invalid @enderror"
                                                   value="{{ $customer ? $customer->forename : '' }}" placeholder=""
                                                   required="required"/>
                                            @error('forename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Middlename<span>*</span></label>
                                            <input type="text" name="middlename"
                                                   class="form-control @error('middlename') is-invalid @enderror"
                                                   value="{{ $customer ? $customer->middlename : '' }}" placeholder=""
                                                   required="required"/>
                                            @error('middlename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Lastname<span>*</span></label>
                                            <input type="text" name="lastname"
                                                   value="{{ $customer ? $customer->lastname : '' }}" placeholder=""
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   required="required"/>
                                            @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input type="email" name="email"
                                                   value="{{ $customer ? $customer->email : '' }}" placeholder=""
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   required="required"/>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Country<span>*</span></label>
                                            <select name="country_name" id="country">
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="British Virgin Islands">British Virgin Islands</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Islands">Cocos Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo - Brazzaville">Congo - Brazzaville</option>
                                                <option value="Congo - Kinshasa">Congo - Kinshasa</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Ivory Coast">Ivory Coast</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany" selected>Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard and McDonald Islands">Heard and McDonald Islands</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia">Micronesia</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territories">Palestinian Territories</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Réunion">Réunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>City<span>*</span></label>
                                            <input type="text" name="city"
                                                   value="{{ $customer ? $customer->city : '' }}" placeholder=""
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   required="required"/>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Postcode<span>*</span></label>
                                            <input type="text" name="post"
                                                   value="{{ $customer ? $customer->postal_code : '' }}" placeholder=""
                                                   class="form-control @error('post') is-invalid @enderror"
                                                   required="required"/>
                                            @error('post')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Street<span>*</span></label>
                                            <input type="text" name="street"
                                                   value="{{ $customer ? $customer->street : '' }}" placeholder=""
                                                   class="form-control @error('street') is-invalid @enderror"
                                                   required="required"/>
                                            @error('street')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>House number<span>*</span></label>
                                            <input type="text" name="house"
                                                   value="{{ $customer ? $customer->house_number : '' }}" placeholder=""
                                                   class="form-control @error('house') is-invalid @enderror"
                                                   required="required"/>
                                            @error('house')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>IBAN<span>*</span></label>
                                            <input type="text" name="iban"
                                                   value="{{ $customer ? $customer->iban : '' }}" placeholder=""
                                                   class="form-control @error('iban') is-invalid @enderror"
                                                   required="required"/>
                                            @error('iban')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
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
                                    @if(!\Illuminate\Support\Facades\Auth::check())
                                    <div class="col-lg-6 col-md-6 col-12">
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
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Confirm Password<span>*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="********" required />
                                        </div>
                                    </div>

                                        <div class="col-12">
                                            <div class="form-group create-account">
                                                <input id="cbox" name="create_account" type="checkbox"/>
                                                <label>Create Account?</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Shopping Cart</h2>
                                <div class="content">
                                    <ul>
                                        <li>Subtotal<span>{{ $totalPriceWithoutDiscount }}€</span></li>
                                        <li>Discount<span>{{ $totalPriceWithDiscount - $totalPriceWithoutDiscount }}€</span></li>
                                        <li>(+) Shipping<span>Free</span></li>
                                        <li class="last">Total<span>{{ $totalPriceWithDiscount }}€</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Payment method</h2>
                                <div class="content" style="margin-left: 25px">
                                    <div class="radio-group">
                                        <label style="display: block" for="debit">
                                            <input type="radio" name="payment_method" id="Debit" value="Debit" required /> Debit
                                        </label>
                                        <label style="display: block" for="klarna">
                                            <input type="radio" name="payment_method" id="Klarna" value="Klarna" required /> Klarna
                                        </label>
                                        <label style="display: block" for="paypal">
                                            <input type="radio" name="payment_method" id="PayPal" value="PayPal" required /> PayPal
                                        </label>
                                    </div>
                                </div>
                            </div>

{{--                            <style>--}}
{{--                                .radio-group label {--}}
{{--                                    display: block;  /* Jedes Label in eine neue Zeile */--}}
{{--                                    margin-left: 10px; /* Falls nötig, nach rechts rücken */--}}
{{--                                    padding: 5px 0;--}}
{{--                                }--}}
{{--                            </style>--}}

                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->
                            <div class="single-widget payement">
                                <div class="content" style="display: flex; align-items: center; gap: 15px;">
                                    <img style="height: 40px; width: auto" src="{{ asset('images/debit.png') }}" alt="Debit" class="payment-icon" />
                                    <img style="height: 40px; width: auto" src="{{ asset('images/klarna.svg') }}" alt="Klarna" class="payment-icon" />
                                    <img style="height: 40px; width: auto" src="{{ asset('images/paypal.svg') }}" alt="PayPal" class="payment-icon" />
                                </div>
                            </div>
                            <!--/ End Payment Method Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" class="btn">Order now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Include Newsletter -->
    @include('partials.newsletter')

@endsection
