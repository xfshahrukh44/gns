@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Job {{ $job->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/admin/job') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $job->id }}</td>
                            </tr>
                            <tr><th> Title </th><td> {{ $job->title }} </td></tr><tr><th> Location </th><td> {{ $job->location }} </td></tr><tr><th> Description </th><td> {{ $job->description }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')
</div>
@endsection

