@extends('layouts.main')

@section('title', 'Product detail')

@section('css')

<style>
    
    
    .main-compilance {
        text-align: center;
    }
    
    .compliance-img {
        border: 1px solid black;
        box-shadow: 0 0px 10px #0000006b;
        border-radius: 10px; 
    }
    
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

    <?php
            
        $apiKey = 'WvWbX6ydJMwVfmsWMRRD6suC'; // Replace with your remove.bg API key
        $imageUrl = $product->feature_image();
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Set the URL and options for the cURL request
        curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'image_url' => $imageUrl,
            'size' => 'auto'
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $apiKey
        ]);
        
        // Execute the cURL request
        $response = curl_exec($ch);
        
        // Check for errors
        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
        // Close the cURL session
        curl_close($ch);
        
        // Save the processed image
        $image_name = explode(DIRECTORY_SEPARATOR, $imageUrl);
        $image_name = $image_name[count($image_name) - 1];
        $chunks = explode('.', $image_name);
        $image_name = $chunks[0];
        $extension = $chunks[1];
        $processedImage = $image_name . '.' . $extension;
        file_put_contents($processedImage, $response);

    
    ?>
 
    
    <section class="inner-product-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="main-compilance">
                        <div class="compliance-img">
                            <img src="{{asset(remove_image_bg($product->feature_image()))}}" class="img-fluid" id="img_feature">
                        </div>
                        <h3 class="inner-product-heading">Compliance</h3>
                        @if (count($product_images))
                            <div class="compliance-small-img">
                                
                                
                                @foreach($product_images as $product_image)
                                   
                                    <a href="#"><img class="imgs" src="{{asset(remove_image_bg($product_image->image))}}"></a>
{{--                                    <a href="#"><img class="imgs" src="{{asset(remove_image_bg($product_image->image))}}"></a>--}}

                                @endforeach
                                
                                
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="size-product">
                        <h2>{{$product->product_title}}</h2>
                        
                        @if($product->sku != "")
                        <div class="product-number">
                            <h5>Fastenal Part No. (SKU)</h5>
                            <h6>{{$product->sku}}</h6>
                        </div>
                        @endif
                        
                        
                        @if($product->item_number != "")
                        <div class="product-number">
                            <h5>Manufacturer Part No.</h5>
                            <h6>{{$product->item_number}}</h6>
                        </div>
                        @endif
                        
                        
                        @if($product->unspsc != "")
                        <div class="product-number">
                            <h5>UNSPSC</h5>
                            <h6>{{$product->unspsc}}</h6>
                        </div>
                        @endif
                        
                        
                        @if($product->manufacturer != "")
                        <div class="product-number">
                            <h5>Manufacturer</h5>
                            <h6>{{$product->manufacturer}}</h6>
                        </div>
                        @endif
                        
                        
                        @if($product->qty != "")
                        <div class="product-number">
                            <h5>Product Qty</h5>
                            <h6>{{$product->qty}}</h6>
                        </div>
                        @endif
                        
                        
                        @if($product->weight != "")
                        <div class="product-number">
                            <h5>Product Weight</h5>
                            <h6>{{$product->weight}}</h6>
                        </div>
                        @endif
                        
                        
{{--                        <div class="catalog">--}}
{{--                            <img src="{{asset('images/blue-book.png')}}" class="img-fluid">--}}
{{--                            <p>This is a Catalog Item</p>--}}
{{--                        </div>--}}
                        <div class="product-attribute">
                            <h3 class="inner-product-heading">Product Attributes</h3>
                            @foreach(json_decode($product->attributes) as $key => $value)
                                <div class="product-number">
                                    <h5>{{ucfirst(str_replace('_', ' ', $key))}}</h5>
                                    <h6>{{$value}}</h6>
                                </div>
                            @endforeach
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">

                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

                                            Note
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @php
                                                $description_string = $product->description;
                                                foreach(['Notes', '<i class="fas fa-chevron-up float-right fa-1x"></i>'] as $str) {
                                                    $description_string = str_replace($str, '', $description_string);
                                                }
                                            @endphp
                                            {!! $description_string !!}
{{--                                            <p>ClipSleeve™ wire markers allow you to quickly and easily identify wire and--}}
{{--                                                communication cables.</p>--}}
{{--                                            <ul>--}}
{{--                                                <li>Easy to install</li>--}}
{{--                                                <li>Split sleeve with "chevron" locking design snaps on the wire so it won't--}}
{{--                                                    slip or slide</li>--}}
{{--                                                <li>Black copy on white nylon for easy readability</li>--}}
{{--                                                <li>RoHS Compatibility Pass 2011/65/EU (Pass 2015/863)</li>--}}
{{--                                            </ul>--}}
{{--                                            <p>Cable & Wire Marking</p>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <form action="{{ route('save_cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <div class="wholesale">
    {{--                        <h2>Wholesale: $96.2600 / package</h2>--}}
    {{--                        <h2 class="bluee">Online Price: $72.2000 / package</h2>--}}
                            <div class="quantity-inner">
                                <h5>QTY</h5>
                                <input type="number" min="1" max="99999"
                                       class=" ecom-pd-qty-input-small ie-float-left form-control p-1"
                                       id="selected_quantity_99106553" aria-label="Quantity" value="1" name="qty">
                                <button href="#" type="submit" class="btn btn-blue-inner"><i class="fa-solid fa-cart-shopping"></i>ADD</button>
                            </div>
    {{--                        <div class="supply-chain">--}}
    {{--                            <h3 class="inner-product-heading">Supply Chainv           </h3>--}}
    {{--                            <div class="product-number">--}}
    {{--                                <h5>Availability</h5>--}}
    {{--                                <h6>Available Inventory</h6>--}}
    {{--                            </div>--}}
    {{--                            <p>This item ships from the manufacturer within 5 days</p>--}}
    {{--                        </div>--}}
                        </div>
                    </form>
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

            $('.imgs').on('click', function () {
                $('#img_feature').prop('src', $(this).prop('src'));
            })
        });
    </script>
@endsection
