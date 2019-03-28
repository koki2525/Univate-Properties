@extends('master')

@section('title', 'Login' )

@section('description', '')

@section('keywords', '')

@section('content')

<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 offset-md-1">
				<h1 class="my-4">Login</h1>
				<p>You are required to login to make an offer</p>
			</div>
		</div>
		<div class="row">
				<div class="col-md-7 offset-md-1">
					<div class="row">
						<div class="col-md-12">
							<form method="POST" action="/login">
								@csrf
								<div class="form-row">

									<div class="col-md-6">
										<input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">

										@if ($errors->has('username'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('username') }}</strong>
											</span>
										@endif
									</div>

									<div class="col-md-6">
										<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

										@if ($errors->has('password'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

										<label class="form-check-label" for="remember">
											{{ __('Remember Me') }}
										</label>
									</div>
								</div>

								<div class="form-group mb-0">
									<button type="submit" class="btn btn-blue">
										{{ __('Login') }}
									</button>

									<br><br><br>

									@if (Route::has('password.request'))
										<a class="btn btn-link" href="{{ route('password.request') }}">
											{{ __('Forgot Your Password?') }}
										</a>
									@endif
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
</div>
				
	
	<script>
		$('#loginModal').on('shown.bs.modal', function () {
			$('#myInput').trigger('focus')
		})
	</script>

	@stop