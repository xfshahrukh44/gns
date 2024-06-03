@extends('layouts.main')

@section('title', 'Home')

@section('css')

@endsection


@section('content')

    <section class="banner-video">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 p-0">
                    <div class="gns-fitting">
                        <video width="100%" height="50%" autoplay="" muted="" loop="">
                            <source src="{{asset('images/video-1.mp4')}}" type="video/mp4">
                            <source src="{{asset('images/video.ogg')}}" type="video/ogg">
                        </video>
                        <div class="banner-info">
                            <h1>GNS HOSE & FITTINGS <span class="d-block">INDSUTRIAL SUPPLY INC </span></h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s </p>
                            <a href="#" class="btn red-btn">SHOP NOW </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="arrival-discount">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 p-0">
                    <div class="discount-solution">
                        <div class="solution-img">
                            <img src="{{asset('images/01.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="info-shop">
                            <h3>20% DISCOUNT</h3>
                            <a href="#" class="btn blue-btn">SHOP NOW </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 p-0">
                    <div class="discount-solution">
                        <div class="solution-img">
                            <img src="{{asset('images/02.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="info-shop">
                            <h3>NEW ARRIVALS</h3>
                            <a href="#" class="btn blue-btn">SHOP NOW </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 p-0">
                    <div class="discount-solution">
                        <div class="solution-img">
                            <img src="{{asset('images/03.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="info-shop">
                            <h3>SUPPLIES & SOLUTIONS</h3>
                            <a href="#" class="btn blue-btn">SHOP NOW </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="shop-category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="same-heading">
                        <h2>SHOP BY CATEGORIES</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="product-slides owl-carousel owl-theme">
                        @foreach($shop_by_categories as $shop_by_category)
                            <a href="{{route('front.shop', ['category_id' => $shop_by_category->id])}}">
                                <div class="item">
                                    <div class="product-category">
                                        <div class="product-info">
                                            <img src="{{asset( $shop_by_category->image ?? 'images/noimg.png' )}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="animate-blue">
                                            <h6>{{$shop_by_category->name}} </h6>
    {{--                                        <a href="#">--}}
    {{--                                            <h6>3 products</h6>--}}
    {{--                                        </a>--}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="feature-porduct">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="same-heading">
                        <h2>FEATURED PRODUCTS</h2>
                    </div>
                </div>
                @foreach($featured_products as $featured_product)
                    <a href="{{route('front.productDetail', $featured_product->id)}}">
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="featured-pro-info">
                                <div class="featured-side-icon">
                                    <div class="cart-product">
                                        <a href="{{route('front.productDetail', $featured_product->id)}}">
                                            <img src="{{file_get_contents($featured_product->image) ? asset($featured_product->image) : asset('images/noimg.png')}}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="discription-pro">
                                    <a href="{{route('front.productDetail', $featured_product->id)}}">{{$featured_product->product_title}}</a>
                                    <span>${{$featured_product->price}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="about-fitting">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">

                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="about-gns-fitting">
                        <h5>ABOUT</h5>
                        <h3>GNS HOSE & FITTING</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry’s standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry’s standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has
                            survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of
                            Letraset sheets containing</p>
                        <a href="#" class="btn red-btn">READ MORE </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="client-review">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="same-heading">
                        <h2>WHAT OUR CLIENTS SAY</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="client_testimonials owl-carousel owl-theme">
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ARLENE COOPER</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> JHON DOE</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ARLENE COOPER</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> JHON DOE</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ARLENE COOPER</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> JHON DOE</h6>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating">

                                </div>
                                <div class="review-discription">
                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book
                                    </p>
                                    <h6> ROBERT DOS</h6>
                                </div>
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
        @if(session()->has('success'))
        toastr.success('{{session()->get('success')}}');
        @endif
        @if(session()->has('error'))
        toastr.error('{{session()->get('error')}}');
        @endif
    </script>
@endsection
