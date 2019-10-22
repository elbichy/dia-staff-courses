<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ config('app.name') }}</title>
	<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
	<style>
		:root {
			--primary-bg-dark: #164f6b; 
			--primary-bg-mid: #0e75a7; 
			--primary-bg-light: #039be5;  
			
			--primary-trans-bg-dark: #164f6b;
			--primary-trans-bg-light: #039be5;
			
			--secondary-bg-dark: #8d1003; 
			--secondary-bg-light: #c91e0b; 
			
			--switch-dark: #164f6b; 
			--switch-light: #039be5; 

			--button-dark: #164f6b; 
			--button-light: #039be5;
			--button-secondary: #8d1003;
		}
	</style>
	<link rel="stylesheet" href="{{asset('css/material-icons.css')}}">
	{!! MaterializeCSS::include_js() !!}
    {!! MaterializeCSS::include_css() !!}
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div class="app" style="display:flex; flex-direction:column; justify-content:center; align-items:center;">
		<div class="card form_wrap">
			<div class="heading">
				<img src="{{ asset('storage/adminlogo.png') }}" alt="logo" width="100px" height="100px">
				<h6 class="">Defence Intelligence Agency</h6>
				<p class="">Staff Courses Management Platform</p>
			</div>
			<form action="{{ route('login') }}" method="POST" class="form row" id="login_form">
				@csrf
				<div class="input-field col s12">
					<i class="material-icons prefix">person</i>
					<input id="service_number" name="service_number" type="number" required autofocus>
					@if ($errors->has('service_number'))
						<span class="helper-text red-text">
							<strong>{{ $errors->first('service_number') }}</strong>
						</span>
					@endif
					<label for="service_number">{{ __('Service No') }}</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input id="password" name="password"  type="password">
					@if ($errors->has('password'))
						<span class="helper-text red-text">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
					<label for="password">{{ __('Password') }}</label>
				</div>
				<button class="login_btn btn waves-effect waves-light" type="submit">Sign In
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
	<script>
		$(function() {
			$('#login_form').submit(function (e) { 
				$('.login_btn').prop('disabled', true).html('SIGNING IN...');
			});
		});
	</script>
</body>
</html>