@extends('layouts.main')

@section('title', 'Compare')

@section('css')

@endsection


@section('content')

    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="about-banner">
                        <h1>COMPARE</h1>
                        <h5><a href="#">HOME </a><span>/</span> COMPARE</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="compare-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="empty-compare">
                        <h2>Compare list is empty.</h2>
                        <p>No products added in the compare list. You must add some products to compare them.
                            You will find a lot of interesting products on our "Shop" page.</p>
                        <a href="#" class="btn blue-btn">RETURN TO SHOP </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
