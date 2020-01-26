@extends('login-layout')
@section('page', 'login-page')
@section('title', 'Reset password')
@section('content')
    <div class="page-header header-filter"
         style="background-image: url('/img/login.jpg'); background-size: cover; background-position: top center;">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <div class="card card-login card-hidden">
                        <div class="card-header card-header-danger text-center">
                            <h4 class="card-title">{{ __('site.reset password') }}</h4>
                        </div>
                        <div class="card-body">


                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <span class="bmd-form-group has-danger text-center">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                          </span>
                                        </div>
                                         <input id="email" type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" required
                                                autocomplete="email"
                                                placeholder="@lang('site.login_email')" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback " role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                                </span>


                                <span class="bmd-form-group has-danger text-center">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                        </div>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password"
                                               placeholder="{{ __('site.password') }}">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                                </span>


                                <span class="bmd-form-group has-danger text-center">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                        </div>
                                        <input id="password-confirm" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="{{ __('site.confirm') }}">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                                </span>


                                <div class="card-footer justify-content-center">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        {{ __('site.reset') }}
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>



                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
