@extends('layouts.login')

@section('content')
<form class="login100-form validate-form"  method="POST" action="{{ route('login') }}">
        @csrf
        <span class="login100-form-title">
            <i class="fa fa-store-alt"></i>
            SAE
        </span>
        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            {{-- <input class="input100" type="text" name="email" placeholder="Usuario"> --}}
            <input id="username" type="text" class="input100" name="username" value="{{ old('username') }}" required autofocus>

            {{-- @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif --}}
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            {{-- <input class="input100" type="password" name="pass" placeholder="Password"> --}}
            <input id="password" type="password" class="input100" name="password" required>

            {{-- @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif --}}
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>

        {{-- <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> --}}
        <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    Iniciar Sesion
                </button>
        </div>
        {{-- <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Iniciar Sesion
                </button>
            </div>
        </div> --}}
    </form>
@endsection
