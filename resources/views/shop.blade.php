@extends('layouts.main')

@section('title', 'Shop')

@section('css')

@endsection


@section('content')

    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="about-banner">
                        <h1>ONLINE CATALOG</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="all-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="stock-category">
                        <div class="print-product">
                            <h3>STOCK STATUS</h3>
                            <div class="check-side">
                                <div class="checkbox-info">
                                    <input type="checkbox" name="" id="">
                                    <label>On sale</label>
                                </div>
                                <div class="checkbox-info">
                                    <input type="checkbox" name="" id="">
                                    <label>In stock</label>
                                </div>
                            </div>
                        </div>
                        <div class="print-product">
                            <h3>TOP RATED PRODUCTS</h3>
                            <div class="pro-price">
                                <a href="#">
                                    <figure>
                                        <img src="{{asset('images/p7-430x493.jpg')}}" class="img-fluid" alt="">
                                    </figure>
                                    <div class="pro-price_info">
                                        <h5>Product 7 <span>50.00</span></h5>
                                    </div>
                                </a>
                                <a href="#">
                                    <figure>
                                        <img src="{{asset('images/p6-430x493.jpg')}}" class="img-fluid" alt="">
                                    </figure>
                                    <div class="pro-price_info">
                                        <h5>Product 6 <span>50.00</span></h5>
                                    </div>
                                </a>
                                <a href="#">
                                    <figure>
                                        <img src="{{asset('images/p4-430x493.png')}}" class="img-fluid" alt="">
                                    </figure>
                                    <div class="pro-price_info">
                                        <h5>Product 5 <span>50.00</span></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="side-bar-menu">
                        <div class="print-product">
                            <h3>PRINT CATEGORIES</h3>
                            @include('category-sidebar')
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="products-img">
                        <form id="form_search" action="{{route('front.shop')}}">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" name="title" class="form-control" placeholder="Search product" value="{{$filters['title'] ?? ''}}">
                                    <input type="hidden" id="input_category_id" name="category_id" value="{{$filters['category_id'] ?? ''}}">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-block text-white" style="background: #e01c1e;"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <h5><a href="#">HOME </a><span>/</span> Online Catalog</h5>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_1')" id="showonly">--}}
{{--                                <span>Show :</span>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_2')">--}}
{{--                                <span>9 /</span>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_3')">--}}
{{--                                <span>12 /</span>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_4')">--}}
{{--                                <span>18 /</span>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_5')">--}}
{{--                                <span>24</span>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_6')">--}}
{{--                                <svg version="1.1" id="shop-view-column-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">--}}
{{--                                        <path d="M7,2v5H2V2H7 M9,0H0v9h9V0L9,0z"></path>--}}
{{--                                    <path d="M17,2v5h-5V2H17 M19,0h-9v9h9V0L19,0z"></path>--}}
{{--                                    <path d="M7,12v5H2v-5H7 M9,10H0v9h9V10L9,10z"></path>--}}
{{--                                    <path d="M17,12v5h-5v-5H17 M19,10h-9v9h9V10L19,10z"></path>--}}
{{--                                   </svg>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_7')">--}}
{{--                                <svg version="1.1" id="shop-view-column-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">--}}
{{--                                        <rect width="5" height="5"></rect>--}}
{{--                                    <rect x="7" width="5" height="5"></rect>--}}
{{--                                    <rect x="14" width="5" height="5"></rect>--}}
{{--                                    <rect y="7" width="5" height="5"></rect>--}}
{{--                                    <rect x="7" y="7" width="5" height="5"></rect>--}}
{{--                                    <rect x="14" y="7" width="5" height="5"></rect>--}}
{{--                                    <rect y="14" width="5" height="5"></rect>--}}
{{--                                    <rect x="7" y="14" width="5" height="5"></rect>--}}
{{--                                    <rect x="14" y="14" width="5" height="5"></rect>--}}
{{--                                   </svg>--}}
{{--                            </li>--}}
{{--                            <li class="number_tabs" onclick="openCity(event , 'info_8')">--}}
{{--                                <svg version="1.1" id="shop-view-column-4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">--}}
{{--                                        <rect width="4" height="4"></rect>--}}
{{--                                    <rect x="5" width="4" height="4"></rect>--}}
{{--                                    <rect x="10" width="4" height="4"></rect>--}}
{{--                                    <rect x="15" width="4" height="4"></rect>--}}
{{--                                    <rect y="5" width="4" height="4"></rect>--}}
{{--                                    <rect x="5" y="5" width="4" height="4"></rect>--}}
{{--                                    <rect x="10" y="5" width="4" height="4"></rect>--}}
{{--                                    <rect x="15" y="5" width="4" height="4"></rect>--}}
{{--                                    <rect y="15" width="4" height="4"></rect>--}}
{{--                                    <rect x="5" y="15" width="4" height="4"></rect>--}}
{{--                                    <rect x="10" y="15" width="4" height="4"></rect>--}}
{{--                                    <rect x="15" y="15" width="4" height="4"></rect>--}}
{{--                                    <rect y="10" width="4" height="4"></rect>--}}
{{--                                    <rect x="5" y="10" width="4" height="4"></rect>--}}
{{--                                    <rect x="10" y="10" width="4" height="4"></rect>--}}
{{--                                    <rect x="15" y="10" width="4" height="4"></rect>--}}
{{--                                   </svg>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <form class="select-product" method="get">--}}
{{--                                    <select name="orderby" class="orderby" aria-label="Shop order" fdprocessedid="y4sc2w">--}}
{{--                                        <option value="menu_order" selected="selected">Default sorting--}}
{{--                                        </option>--}}
{{--                                        <option value="popularity">Sort by popularity</option>--}}
{{--                                        <option value="rating">Sort by average rating</option>--}}
{{--                                        <option value="date">Sort by latest</option>--}}
{{--                                        <option value="price">Sort by price: low to high</option>--}}
{{--                                        <option value="price-desc">Sort by price: high to low</option>--}}
{{--                                    </select>--}}
{{--                                    <input type="hidden" name="paged" value="1">--}}
{{--                                </form>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>
                    <div class="main-product" id="info_1" class="row_tabs">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <div class="featured-pro-info">
                                            <div class="featured-side-icon">
{{--                                                <ul class="hover-icon">--}}
{{--                                                    <li>--}}
{{--                                                        <a href="#">--}}
{{--                                                            <span>Compare</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="#">--}}
{{--                                                            <span>Quick view</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="#">--}}
{{--                                                            <span>Add to wishlist</span>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
                                                <div class="cart-product">
                                                    <a href="{{route('front.productDetail', $product->id)}}">
                                                        <img src="{{asset($product->image != '' ? $product->image : 'images/noimg.png')}}" class="img-fluid" alt="">
                                                    </a>
                                                </div>
{{--                                                <div class="add-pro-info">--}}
{{--                                                    <a href="#" class="btn cart-red"><span>ADD TO--}}
{{--                                                                     CART</span></a>--}}
{{--                                                    <a href="#" class="btn cart-blue"><span class="cart-icon"></span></a>--}}
{{--                                                </div>--}}
                                            </div>
                                            <div class="discription-pro">
                                                <a href="#">{{$product->product_title}}</a>
                                                <span>${{$product->price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                {{ $products->appends($_GET)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.a_category').on('click', function () {
                $('#input_category_id').val($(this).data('id'));
                $('#form_search').submit();
            });
        });
    </script>
@endsection
