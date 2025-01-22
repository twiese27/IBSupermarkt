<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Meta Tag -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="copyright" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Title Tag  -->
    <title>Eshop - eCommerce HTML5 Template.</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <!-- Web Font -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
      rel="stylesheet"
    />

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}" />
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" />
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('css/niceselect.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('css/flex-slider.min.css') }}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}" />
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" />

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- <link rel="stylesheet" href="/style.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />

    <!-- Color CSS -->
    <link rel="stylesheet" href="css/color/color1.css') }}" />
    <!--<link rel="stylesheet" href="{{ asset('css/color/color2.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color3.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color4.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color5.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color6.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color7.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color8.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color9.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color10.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color11.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('css/color/color12.css') }}">-->

    <link rel="stylesheet" href="#" id="colors" />
  </head>
  <body class="js">
    <!-- Preloader -->
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- End Preloader -->

    <!-- Eshop Color Plate -->
    <div class="color-plate">
      <a class="color-plate-icon"><i class="ti-paint-bucket"></i></a>
      <h4>Eshop Colors</h4>
      <p>Here is some awesome color's available on Eshop Template.</p>
      <span class="color1"></span>
      <span class="color2"></span>
      <span class="color3"></span>
      <span class="color4"></span>
      <span class="color5"></span>
      <span class="color6"></span>
      <span class="color7"></span>
      <span class="color8"></span>
      <span class="color9"></span>
      <span class="color10"></span>
      <span class="color11"></span>
      <span class="color12"></span>
    </div>
    <!-- /End Color Plate -->

    <!-- Include Header -->
    @include('partials.header')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container">
      <div class="row">
      <div class="col-12"></div>
      <div class="bread-inner"></div>
          <ul class="bread-list">
          <li>
            <a href="/html/must-have/index4.html">Startseite<i class="ti-arrow-right"></i></a>
          </li>
          <li class="active"><a href="blog-single.html">Warenkorb</a></li>
          </ul>
        </div>
        </div>
      </div>
      </div>
    </div>
    <!-- End Breadcrumbs -->

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
            <i class="ti-trash remove-icon"></i>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td class="image" data-title="No">
            <img src="https://placehold.co/100x100" alt="#" />
            </td>
            <td class="product-des" data-title="Description">
            <p class="product-name"><a href="#">Frauenkleid</a></p>
            <p class="product-des">
              Maboriosam in a tonto nesciung eget distingy magndapibus.
            </p>
            </td>
            <td class="price" data-title="Price">
            <span>110,00€ </span>
            </td>
            <td class="qty" data-title="Qty">
            <!-- Input Order -->
            <div class="input-group">
              <div class="button minus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                disabled="disabled"
                data-type="minus"
                data-field="quant[1]"
              >
                <i class="ti-minus"></i>
              </button>
              </div>
              <input
              type="text"
              name="quant[1]"
              class="input-number"
              data-min="1"
              data-max="100"
              value="1"
              />
              <div class="button plus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                data-type="plus"
                data-field="quant[1]"
              >
                <i class="ti-plus"></i>
              </button>
              </div>
            </div>
            <!--/ End Input Order -->
            </td>
            <td class="total-amount" data-title="Total">
            <span>220,88€</span>
            </td>
            <td class="action" data-title="Remove">
            <a href="#"><i class="ti-trash remove-icon"></i></a>
            </td>
          </tr>
          <tr>
            <td class="image" data-title="No">
            <img src="https://placehold.co/100x100" alt="#" />
            </td>
            <td class="product-des" data-title="Description">
            <p class="product-name"><a href="#">Frauenkleid</a></p>
            <p class="product-des">
              Maboriosam in a tonto nesciung eget distingy magndapibus.
            </p>
            </td>
            <td class="price" data-title="Price">
            <span>110,00€ </span>
            </td>
            <td class="qty" data-title="Qty">
            <!-- Input Order -->
            <div class="input-group">
              <div class="button minus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                disabled="disabled"
                data-type="minus"
                data-field="quant[2]"
              >
                <i class="ti-minus"></i>
              </button>
              </div>
              <input
              type="text"
              name="quant[2]"
              class="input-number"
              data-min="1"
              data-max="100"
              value="2"
              />
              <div class="button plus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                data-type="plus"
                data-field="quant[2]"
              >
                <i class="ti-plus"></i>
              </button>
              </div>
            </div>
            <!--/ End Input Order -->
            </td>
            <td class="total-amount" data-title="Total">
            <span>220,88€</span>
            </td>
            <td class="action" data-title="Remove">
            <a href="#"><i class="ti-trash remove-icon"></i></a>
            </td>
          </tr>
          <tr>
            <td class="image" data-title="No">
            <img src="https://placehold.co/100x100" alt="#" />
            </td>
            <td class="product-des" data-title="Description">
            <p class="product-name"><a href="#">Frauenkleid</a></p>
            <p class="product-des">
              Maboriosam in a tonto nesciung eget distingy magndapibus.
            </p>
            </td>
            <td class="price" data-title="Price">
            <span>110,00€ </span>
            </td>
            <td class="qty" data-title="Qty">
            <!-- Input Order -->
            <div class="input-group">
              <div class="button minus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                disabled="disabled"
                data-type="minus"
                data-field="quant[3]"
              >
                <i class="ti-minus"></i>
              </button>
              </div>
              <input
              type="text"
              name="quant[3]"
              class="input-number"
              data-min="1"
              data-max="100"
              value="3"
              />
              <div class="button plus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                data-type="plus"
                data-field="quant[3]"
              >
                <i class="ti-plus"></i>
              </button>
              </div>
            </div>
            <!--/ End Input Order -->
            </td>
            <td class="total-amount" data-title="Total">
            <span>220,88€</span>
            </td>
            <td class="action" data-title="Remove">
            <a href="#"><i class="ti-trash remove-icon"></i></a>
            </td>
          </tr>
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
              <form action="#" target="_blank">
              <input name="Coupon" placeholder="Geben Sie Ihren Gutschein ein" />
              <button class="btn">Anwenden</button>
              </form>
            </div>
            <div class="checkbox">
              <label class="checkbox-inline" for="2"
              ><input name="news" id="2" type="checkbox" /> Versand
              (+10€)</label
              >
            </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-7 col-12">
            <div class="right">
            <ul>
              <li>Zwischensumme<span>330,00€</span></li>
              <li>Versand<span>Kostenlos</span></li>
              <li>Sie sparen<span>20,00€</span></li>
              <li class="last">Sie zahlen<span>310,00€</span></li>
            </ul>
            <div class="button5">
              <a href="#" class="btn">Zur Kasse</a>
              <a href="#" class="btn">Weiter einkaufen</a>
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

    <!-- Include Shop Services Area-->
    @include('partials.shop-service-area')

    <!-- Include Newsletter -->
    @include('partials.newsletter')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
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
              <img src="/images/modal1.jpg" alt="#" />
            </div>
            <div class="single-slider">
              <img src="/images/modal2.jpg" alt="#" />
            </div>
            <div class="single-slider">
              <img src="/images/modal3.jpg" alt="#" />
            </div>
            <div class="single-slider">
              <img src="/images/modal4.jpg" alt="#" />
            </div>
            </div>
          </div>
          <!-- End Product slider -->
          </div>
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
              <button
                type="button"
                class="btn btn-primary btn-number"
                disabled="disabled"
                data-type="minus"
                data-field="quant[1]"
              >
                <i class="ti-minus"></i>
              </button>
              </div>
              <input
              type="text"
              name="quant[1]"
              class="input-number"
              data-min="1"
              data-max="1000"
              value="1"
              />
              <div class="button plus">
              <button
                type="button"
                class="btn btn-primary btn-number"
                data-type="plus"
                data-field="quant[1]"
              >
                <i class="ti-plus"></i>
              </button>
              </div>
            </div>
            <!--/ End Input Order -->
            </div>
            <div class="add-to-cart">
            <a href="#" class="btn">In den Warenkorb</a>
            <a href="#" class="btn min"><i class="ti-heart"></i></a>
            <a href="#" class="btn min"
              ><i class="fa fa-compress"></i
            ></a>
            </div>
            <div class="default-social">
            <h4 class="share-now">Teilen:</h4>
            <ul>
              <li>
              <a class="facebook" href="#"
                ><i class="fa fa-facebook"></i
              ></a>
              </li>
              <li>
              <a class="twitter" href="#"
                ><i class="fa fa-twitter"></i
              ></a>
              </li>
              <li>
              <a class="youtube" href="#"
                ><i class="fa fa-pinterest-p"></i
              ></a>
              </li>
              <li>
              <a class="dribbble" href="#"
                ><i class="fa fa-google-plus"></i
              ></a>
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

    <!-- Include Footer -->
    @include('partials.footer')

    <!-- Jquery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('js/magnific-popup.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('js/facnybox.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('js/nicesellect.js') }}"></script>
    <!-- Ytplayer JS -->
    <script src="{{ asset('js/ytplayer.min.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('js/active.js') }}"></script>
    <!-- Include HTML -->
    <script src="{{ asset('js/include-html.js') }}"></script>
  </body>
</html>
