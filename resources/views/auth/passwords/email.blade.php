@extends('login-layout')
@section('page', 'login-page')
@section('title', 'Reset password')
@section('content')
    <div class="page-header header-filter" style="background-image: url('/img/login.jpg'); background-size: cover; background-position: top center;">

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

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-center">{{ __('site.e-mail address') }}</label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                          </span>
                                    </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid
                                @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-default ">
                                {{ __('site.send') }}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
