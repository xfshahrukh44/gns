@extends('layouts.main')

@section('title', 'Featured detail')

@section('css')

@endsection


@section('content')

    <section class="section5 mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h_p">
                        <h2 class="mb-0">Videos</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-sec">
        <div class="container">
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-lg-4">
                        <div class="video">
                            <h2>{{$video->title}}</h2>
                            <a href="{{asset($video->video)}}" target="_blank">
                                <video width="320" height="240" muted class="vid">
                                    <source src="{{asset($video->video)}}" type="video/mp4">
                            </a>
                            </video>
                            <a href="{{asset($video->youtube)}}"  class="btn btn-custom">Watch on YouTube</a>
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
