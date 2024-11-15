@extends('layouts.main')

@section('title', 'Home')

@section('css')

<style>

    .product-category:before {
        position: absolute;
        z-index: 0;
        content: "";
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
         background: none !important;
        border-radius: 10px;
        transition: all ease 0.5s;
        opacity: 1;
        /* border: 1px solid #949494; */
    }

    .product-category {
        background: white !important;
        padding-bottom: 30px !important;
    }

    .product-info img {
        height: 250px !important;
        object-fit: contain !important;
        width: 220px !important;
        margin: auto;
    }

    .animate-blue {
        padding-bottom: 10px !important;
    }

    .animate-blue h6 {
        margin-bottom: 5px !important;
    }

    .product-category:hover .animate-blue h6 {
        opacity: 1 !important;
    }

    .animate-blue a h6 {
        color: black !important;
        opacity: 1 !important;
    }

</style>

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
                            <h1>GNS HOSE & FITTINGS <span class="d-block">INDUSTRIAL SUPPLY INC </span></h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s </p>
                            <a href="{{ route('front.shop') }}" class="btn red-btn">SHOP NOW </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--    <section class="arrival-discount">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-4 col-md-4 col-12 p-0">--}}
{{--                    <div class="discount-solution">--}}
{{--                        <div class="solution-img">--}}
{{--                            <img src="{{asset('images/01.jpg')}}" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="info-shop">--}}
{{--                            <h3>20% DISCOUNT</h3>--}}
{{--                            <a href="{{ route('front.shop') }}" class="btn blue-btn">SHOP NOW </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-4 col-12 p-0">--}}
{{--                    <div class="discount-solution">--}}
{{--                        <div class="solution-img">--}}
{{--                            <img src="{{asset('images/02.jpg')}}" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="info-shop">--}}
{{--                            <h3>NEW ARRIVALS</h3>--}}
{{--                            <a href="{{ route('front.shop') }}" class="btn blue-btn">SHOP NOW </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-4 col-12 p-0">--}}
{{--                    <div class="discount-solution">--}}
{{--                        <div class="solution-img">--}}
{{--                            <img src="{{asset('images/03.jpg')}}" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="info-shop">--}}
{{--                            <h3>SUPPLIES & SOLUTIONS</h3>--}}
{{--                            <a href="{{ route('front.shop') }}" class="btn blue-btn">SHOP NOW </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


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
                        @foreach($get_product as $val)
                        <div class="item">
                            <div class="product-category">
                                <div class="product-info">
                                    <img src="{{url($val->image)}}" class="img-fluid" alt="">
                                </div>
                                <div class="animate-blue">
                                    <h6>{{ $val->categorys->name }}</h6>
                                    <a href="{{ route('front.productDetail', ['id' => $val->id]) }}">
                                        <h6>{{ $val->product_title }}</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="featured-pro-info">
                            <div class="featured-side-icon">
                                <div class="cart-product">
                                    <a href="{{route('front.productDetail', $featured_product->id)}}">
                                        @if(!is_null($featured_product->image))
                                            <img src="{{file_get_contents($featured_product->image) ? asset($featured_product->image) : asset('images/noimg.png')}}" class="img-fluid" alt="">
                                        @else
                                            <img src="{{asset('images/noimg.png')}}" class="img-fluid" alt="">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="discription-pro">
                                <a href="{{route('front.productDetail', $featured_product->id)}}">{{$featured_product->product_title}}</a>
{{--                                <span>${{$featured_product->price}}</span>--}}
                            </div>
                        </div>
                    </div>
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
                        <p>GNS Hose & Fitting is a leading provider in the hose and fitting industry, known for its exceptional products and services. Our commitment to quality and customer satisfaction has established us as a trusted name in the market.</p>
                        <p>We offer a wide range of hoses and fittings to meet the diverse needs of our clients. Our products are designed to withstand the toughest conditions and deliver optimal performance. With years of experience and a dedication to innovation, GNS Hose & Fitting continues to set the standard in the industry.</p>
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
                        @foreach($reviews as $review)
                            <div class="item">
                            <div class="main-testimonials">
                                <div class="star-rating-{{$review->rating ?? '1'}}">

                                </div>
                                <div class="review-discription">
{{--                                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting--}}
{{--                                        industry. Lorem Ipsum has been the industry&#8217;s standard dummy--}}
{{--                                        text ever since the 1500s, when an unknown printer took a galley of--}}
{{--                                        type and scrambled it to make a type specimen book--}}
{{--                                    </p>--}}
                                    {!! $review->review ?? '' !!}
                                    <h6>{{$review->name}}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
