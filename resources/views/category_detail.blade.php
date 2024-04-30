@extends('layouts.main')

@section('title', 'Category detail')

@section('css')
    <style>
        thead th { position: sticky; top: 0; background: white; }
    </style>
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
                <div class="col-lg-3 col-md-3 col-12 d-none">
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
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="table-right">
                        <div class="top-discription">
                            <div class="steel-nuts">
                                <h6>{{number_format($category->products->count(), 0)}} Items</h6>
                                <figure>
                                    <img src="{{asset(file_get_contents($category->image) ? $category->image : 'images/noimg.png')}}" class="img-fluid" alt="">
                                </figure>
                            </div>
                            <div class="steel-nuts-inf0">
                                <h3>{{$category->name}}</h3>
{{--                                <p>Steel is the most common fastener material due to its strength properties.--}}
{{--                                    Unalloyed steel may be surface treated to enhance corrosion resistance and other--}}
{{--                                    desirable properties.</p>--}}
                            </div>
                        </div>
                        <div class="catalog float-right">
                            <ul>
                                <li>
                                    <a href="{{route('front.shop', ['category_id' => $category->id])}}">CatalogView </a>
                                </li>
                            </ul>
                        </div>
                    </div>
{{--                    <div class="acme-plan">--}}
{{--                        <h5>Type: <span>Acme Nut</span></h5>--}}
{{--                        <h5>Material: <span>Steel</span></h5>--}}
{{--                    </div>--}}
{{--                    <div class="plan-para">--}}
{{--                        <p>Finish : Plain</p>--}}
{{--                    </div>--}}
{{--                    <div class="top-discription">--}}
{{--                        <div class="steel-nuts">--}}
{{--                            <figure>--}}
{{--                                <img src="{{asset('images/Finish - Plain (Hex Nut).jpg')}}" class="img-fluid" alt="">--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div class="steel-nuts-inf0">--}}
{{--                            <p>Nothing has been done to this bare metal surface to improve appearance or corrosion--}}
{{--                                resistance, which is very low if the material is steel. Often the surface has been--}}
{{--                                oiled which improves lubricity. This finish is susceptible to rusting and corrosion--}}
{{--                                in exterior environments. This most basic finish can be used when protection is not--}}
{{--                                an issue or indoors.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <?php $used_keys = []; ?>
                                @foreach(json_decode($category->products[0]->attributes) as $key => $value)
                                    <?php $used_keys []= $key; ?>
                                    <th>{{ucfirst(str_replace('_', ' ', $key))}}</th>
                                @endforeach
                                <th> Item number </th>
                                <th>SKU </th>
                                <th> Price</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->products as $product)
                                <?php $decoded_object = json_decode($product->attributes); ?>
                                <tr>
                                    @foreach($used_keys as $key)
                                        <td>{{$decoded_object->$key ?? 'N/A'}}</td>
                                    @endforeach
                                    <td>{{$product->item_number ?? 'N/A'}}</td>
                                    <td>
                                        {{$product->sku ?? 'N/A'}}
                                    </td>
                                    <td>{{('$' . $product->price) ?? 'N/A'}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary text-white" style="background: #e01c1e; border: 0px;" href="{{route('front.productDetail', $product->id)}}">
                                            BUY
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <form id="form_search" action="{{route('front.shop')}}" hidden>
        <div class="row">
            <div class="col-10">
                <input type="hidden" id="input_category_id" name="category_id" value="{{$filters['category_id'] ?? ''}}">
            </div>
        </div>
    </form>

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
