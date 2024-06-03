@extends('layouts.main')
@section('content')

	@php
		$categories = App\Category::where('parent_id', 0)->get();
	@endphp

<main class="my-cart">
	<!-- banner start -->
	<div class="banner">
		<div class="container">
			<h1 class="wow bounceInDown" data-wow-delay="0.5s">Register</h1>
{{--			<p class="wow bounceInRight" data-wow-delay="0.5s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>--}}
		</div>
	</div>
	<!-- banner end -->
    
<div class="login-pg-forms">
  <div class="container">
    <div class="col-md-12">
      <div class="row my-4">
        <div class="col-md-12">
			<div class="rgster-login-form">
	{{--        <h2>Create Account</h2> --}}
	{{--        <p>To take advantage of personalized shopping</p> --}}
			  <form class="loginForm" method="POST" action="{{ route('register') }}">
			   @csrf
				  <label for="">Name</label>
				  <input class="form-control" type="text" name="name" placeholder="Name" required>
				   @if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
				   @endif
				  <br>

				  <label for="">Email</label>
				  <input class="form-control" type="text" name="email" placeholder="Email" required>
				   @if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
				   @endif
				  <br>

				  <label for="">Password</label>
				  <input class="form-control" type="password" name="password" placeholder="Password" required>
					@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				  <br>

				  <label for="">Confirm password</label>
				  <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>

				  <br>

				<input class="form-control form-btn btn btn-danger text-white" type="submit" value="Create my account">
	{{--			<a href="{{ URL('shop') }}">Return to store</a> --}}
			</form>
	  </div>
		</div>

      </div>
    </div>
  </div>
</div>
</div>

@endsection
@section('css')
<style type="text/css">
	
</style>
@endsection
@section('js')
<script type="text/javascript">
	 $(document).on('click', ".btn1", function(e){
			$('.loginForm').submit();
	 });
</script>
@endsection
