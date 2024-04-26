{{--@foreach($blog as $key => $val_blog)--}}
{{--<a href="{{ route('blog_detail',['id' => $val_blog->id]) }}">--}}
{{--{{ route('blog_detail',['id' => $val_blog->id]) }}--}}
{{--{{asset($val_blog->image)}}--}}
{{--{{ $val_blog->name }}--}}
{{--{!! $val_blog->short_detail !!}--}}
@extends('layouts.main')

@section('title', 'Blog')

@section('css')

@endsection


@section('content')

    <section class="second-sec about-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="three-img">
                        <div class="btn-flux">
                            <a class="btn btn-custom about" type="submit">Blogs</a>
                        </div>
                        <div class="buld-img">
                            <h2>Lorem Ipsum is simply dummy text of the printing and typesetting<span> industry. Lorem Ipsum
                                has been the industry's standard.</span> </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="color-extra sec5">
                        <span></span>
                    </div>
                    <div class="sec5-img-book">
                        <figure>
                            <img src="{{asset('images/book.png')}}" class="img-fluid" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6 pr-0" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="sec5-text">
                        <span>Purchase My Book</span>
                        <h1>Hope For<span>Newport</span></h1>
                        <span>by Fran Johnson</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut
                            perspiciatis
                            unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
                            aperiam,
                            eaque</p>
                        <div class="sec5-flux">
                            <a href="#" class="btn btn-custom b">Learn More</a>
                            <p>$350.99</p>
                        </div>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec6-text-flux">
                        <div class="text-h1-sec-6">
                            <h1 class="ml2">LATEST BOOKS</h1>
                        </div>

                        <div class="text-a-sec-6">
                            <a href="#">
                                <p>Explore more</p><i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt1.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>First Stone</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-down">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt2.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>Yesterday’s Shadows</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt3.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>Yesterday’s Shadows</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-down">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt4.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>First Stone</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt1.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>First Stone</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-down">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt2.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>Yesterday’s Shadows</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-up">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt3.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>Yesterday’s Shadows</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3" data-aos="fade-down">
                    <div class="sec6-opt">
                        <div class="sec6-opt-img">
                            <figure>
                                <img src="{{asset('images/sec5-opt4.png')}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                        <div class="sec6-opt-text">
                            <h6>First Stone</h6>
                            <div class="small-p-flux">
                                <div class="p-smallflux-main">
                                    <p>Dennis Hodgdon</p>
                                </div>
                                <div class="i-smallflux-main">
                                    <i class="fa-solid fa-star"></i>
                                    <p>4.8</p>
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
    <script type="text/javascript"></script>
@endsection
