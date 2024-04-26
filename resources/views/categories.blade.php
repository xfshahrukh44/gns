@extends('layouts.main')

@section('title', 'Categories')

@section('css')

@endsection


@section('content')

    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="about-banner">
                        <h1>CATEGORIES</h1>
                        <h5><a href="#">HOME </a><span>/</span> CATEGORIES</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="shop-category category-pg">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-3 col-6">
                            <div class="product-category">
                                <a href="{{ ($category->children->count() == 0 && $category->products->count() > 0) ? route('front.categoryDetail', $category->id) : route('front.categories', ['category_id' => $category->id]) }}">
                                    <div class="product-info">
                                        <img src="{{asset(file_get_contents($category->image) ? $category->image : 'images/noimg.png')}}" class="img-fluid" alt="">
                                    </div>
                                </a>
                                <div class="animate-blue">
                                    <h6>{{$category->name}}</h6>
{{--                                    <a href="{{route('front.categories', ['category_id' => $category->id])}}">--}}
{{--                                        <h6>{{$category->products->count()}} products</h6>--}}
{{--                                    </a>--}}
                                </div>
                            </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
