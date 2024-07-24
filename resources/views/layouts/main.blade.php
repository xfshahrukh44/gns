<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Livvic:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <link href="https://db.onlinewebfonts.com/c/f890eea2e91e1270ce7109e36a42260a?family=woodmart-font" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset(!empty($favicon->img_path)?$favicon->img_path:'')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        @yield('css')
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/inner.css')}}">
        <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">

        <title>{{ config('app.name') }} | @yield('title')</title>

        <style>
            .myaccount-tab-menu.nav a {
                display: block;
                padding: 20px;
                font-size: 16px;
                align-items: center;
                width: 100%;
                font-weight: bold;
                color: black;
            }
            .myaccount-tab-menu.nav a i {
                padding-right: 10px;
            }

            .myaccount-tab-menu.nav {
                border: 1px solid;
            }

            .myaccount-tab-menu.nav .active, .myaccount-tab-menu.nav a:hover {
                background-color: #e01c1e;
                color: white;
            }

            .account-details-form label.required {
                width: 100%;
                font-weight: 500;
                font-size: 18px;
            }
            .account-details-form input {
                border-width: 1px;
                border-color: white;
                border-style: solid;
                padding-left: 15px;
                color: black;
                width: 100%;
                border-radius: 3px;
                background-color: rgb(255, 255, 255);
                height: 52px;
                padding-left: 15px;
                margin-bottom: 30px;
                color: #000000;
                font-size: 15px;
            }
            .account-details-form legend {
                font-family: CottonCandies;
                font-size: 50px;
            }
        </style>
    </head>

    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="top-header">
                            <div class="logo-web">
                                <a class="navbar-brand" href="#"><img src="{{asset($logo->img_path)}}" class="img-fluid" alt=""></a>
                            </div>
{{--                            <div>--}}
                            <form class="category-search" id="form_search" action="{{route('front.shop')}}">
                                <input type="search" name="title" class="form-control" placeholder="Search for products"
                                       required="" value="{{request()->get('title')}}">
                                <button type="submitf" class="search-icon fa-microphone">

                                </button>
                                @php
                                    $categories_for_dropdown = \App\Category::with('parent', 'children')->where('parent_id', '!=', 0)->get();
                                @endphp
                                <div class="selet-top">
                                    <select name="category_id" id="">
                                        @foreach($categories_for_dropdown as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
{{--                            </div>--}}
                            <div class="top-right-links">
                                <div class="side-links">
                                    <a href="{{route('signin')}}" type="button"
{{--                                       data-bs-toggle="offcanvas"--}}
{{--                                       data-bs-target="#offcanvasRightes" aria-controls="offcanvasRightes"--}}
{{--                                       class="lock-icon"--}}
                                    >
                                        @if(auth()->check())
                                            Account
                                        @else
                                            LOGIN / REGISTER
                                        @endif
                                    </a>
                                </div>
                                <div class="side-icon">
{{--                                    <a href="{{route('front.wishlist')}}" class="heart-icon">--}}
{{--                                    </a>--}}
{{--                                    <a href="{{route('front.compare')}}" class="cut-icon">--}}
{{--                                        <span>1</span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"--}}
{{--                                       aria-controls="offcanvasRight" class="lock-icon">--}}
{{--                                        <span>0</span>--}}
{{--                                    </a>--}}
                                    <a href="{{route('cart')}}" type="button" aria-controls="offcanvasRight" class="lock-icon">
                                        <span>{{count(session()->get('cart')) ?? 0}}</span>
                                    </a>
                                </div>
{{--                                <div class="side-zero">--}}
{{--                                    <a href="#" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"--}}
{{--                                       aria-controls="offcanvasRight">--}}
{{--                                        <span>$0.00</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 p-0">

                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="collaps-side">
                                    <div class="drop-menu">
                                        <span>Browse Categories</span>
                                    </div>
                                    <ul id="menu-categories" class="menu-browse">
                                        @foreach($categories as $val)
                                        <li id="menu-item">
                                            <a href="{{ url('categories?category_id='.$val->id) }}"><span class="nav-link-text">{{ $val->name }}</span></a>
                                        </li>
                                        @endforeach
                                        <!--<li id="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Abrasives</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Bins &amp; Storage</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Chemicals</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Cleaning</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Cutting Tools</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Electrical</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Fasteners</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Hydraulics</span></a>-->
                                        <!--</li>-->
                                        <!--<li id="menu-item" class="menu-item">-->
                                        <!--    <a href="#"><span class="nav-link-text">Paints</span></a>-->
                                        <!--</li>-->
                                    </ul>
                                </div>
                                <ul class="navbar-nav m-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('home')}}">HOME <span
                                                    class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('front.about')}}">ABOUT US</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('front.shop')}}"> ONLINE CATALOG</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('front.categories')}}">CATEGORIES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('front.contact')}}">CONTACT US</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>


        @yield('content')

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="footer-links">
                            <h6>ABOUT</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="footer-links">
                            <h6>QUICK LINKS</h6>
                            <ul>
                                <li>
                                    <a href="{{route('home')}}"> Home</a>
                                </li>
                                <li>
                                    <a href="{{route('front.about')}}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{route('front.shop')}}">Online Catalog</a>
                                </li>
                                <li>
                                    <a href="{{route('front.categories')}}">Categories</a>
                                </li>
                                <li>
                                    <a href="{{route('front.contact')}}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="footer-links">
                            <h6>CATEGORIES</h6>
                            <ul>
                                @php
                                    $footer_categories = \App\Category::where('parent_id', 0)->get();
                                @endphp
                                @foreach($footer_categories as $footer_category)
                                    <li>
                                        <a href="{{route('front.shop', ['category_id' => $footer_category->id])}}"> {{$footer_category->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="footer-links">
                            <h6>CONTACT INFO</h6>
                            <ul>
                                <li>
                                    <a href="#"> Address: {!! App\Http\Traits\HelperTrait::returnFlag(519) !!}</a>
                                </li>
                                <li>
                                    <a href="mailto:{!! App\Http\Traits\HelperTrait::returnFlag(218) !!}"><span>Email:</span> {!! App\Http\Traits\HelperTrait::returnFlag(218) !!}</a>
                                </li>
{{--                                <li>--}}
{{--                                    <a href="#">Chemicals</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">Cleaning</a>--}}
{{--                                </li>--}}
                                <li>
                                    <a href="tel:{!! App\Http\Traits\HelperTrait::returnFlag(59) !!}"><span>Phone: </span> {!! App\Http\Traits\HelperTrait::returnFlag(59) !!}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="footer-links">--}}
{{--                            <h6>PAYMENT SYSTEM</h6>--}}
{{--                            <img src="images/payment.png" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="footer-links">--}}
{{--                            <h6>SHIPPING SYSTEM</h6>--}}
{{--                            <img src="images/shipping.png" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-4">
                        <div class="footer-links">
                            <h6>FOLLOW US</h6>
                            <ul class="icon-links">
                                <li>
                                    <a href="{!! App\Http\Traits\HelperTrait::returnFlag(682) !!}"><img src="images/facebook.png" class="img-fluid" alt=""></a>
                                </li>
                                <li>
                                    <a href="{!! App\Http\Traits\HelperTrait::returnFlag(1960) !!}"><img src="images/twitter.png" class="img-fluid" alt=""></a>
                                </li>
                                <li>
                                    <a href="{!! App\Http\Traits\HelperTrait::returnFlag(1964) !!}"><img src="images/linkedin.png" class="img-fluid" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 p-0">
                        <div class="copy-right-para">
                            <p>© 2024 GNS HOSE & FITTING INDUSTRIAL SUPPLY INC ALL RIGHT RESERVED</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <div class="offcanvas offcanvas-end right-modal-side" tabindex="-1" id="offcanvasRight"
             aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">SHOPPING CART</h5>
                <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><span
                            class="btn-close"></span> Close</button>
            </div>
            <div class="offcanvas-body">
                <div class="main-mid-canvas">
                    <div class="cart-items">
                        <h6>NO PRODUCTS IN THE CART.</h6>
                        <a href="#" class="btn blue-btn">RETURN TO SHOP </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end right-modal-side right_modal_side" tabindex="-1" id="offcanvasRightes"
             aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">SIGN IN</h5>
                <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><span
                            class="btn-close"></span> Close</button>
            </div>
            <div class="offcanvas-body">
                <div class="main-mid-canvas">
                    <div class="modal-form-product">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Username or email address *</label>
                                        <input type="text" name="username" value="" class="form-control"
                                               placeholder="info@bicycle.com">
                                        <label>Password *</label>
                                        <input type="password" name="password" autocomplete="current-password"
                                               class="form-control" placeholder=".......">
                                        <button type="submit" class="btn blue-btn">LOG IN </button>
                                        <div class="check-remember">
                                            <input type="checkbox" name="" id="">
                                            <label> Remember me</label>
                                        </div>
                                        <a href="#">Lost your password?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="cart-items">
                        <h6>No account yet?</h6>
                        <a href="#">CREATE AN ACCOUNT </a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
                integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{asset('js/custom.js')}}"></script>
        @yield('js')
    </body>

</html>