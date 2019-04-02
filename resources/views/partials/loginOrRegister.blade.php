<!-- Login or Register Modal -->
<div class="modal fade" id="loginOrRegister" tabindex="-1" role="dialog" aria-labelledby="loginOrRegisterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-0 px-md-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginOrRegisterModalLabel">Login or Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="container">

                                <div class="row mb-4">

                                    <div class="col-md-6">
                                            <p>Login</p>
                                            <form method="POST" action="/login">
                                                @csrf

                                                <div class="form-row">
                            <!--                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>-->

                                                    <div class="col-md-12">
                                                        <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">

                                                        @if ($errors->has('username'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('username') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <br>

                            <!--                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->

                                                    <div class="col-md-12">
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
                                                    <button style="width: 100%;" type="submit" class="btn btn-blue">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>
                                            </form>
                                    </div>

                                    <div class="col-md-6">
                                        <h5>Register</h5>
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <a style="width: 100%;" class="btn btn-blue" href="/register">Private Individial</a><br><br>
                                        </div>
                                        <div class="col-md-12">
                                            <a style="width: 100%;" class="btn btn-blue" href="/register-agency">Agency Registration</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#loginOrRegister').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
