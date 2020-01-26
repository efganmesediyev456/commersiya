@extends('login-layout')
@section('page', 'login-page')
@section('title', 'Avirnet Login')
@section('content')
    <div class="page-header header-filter" style="background-image: url('https://images.unsplash.com/photo-1565335020653-1d1c4fc20bbc');
     background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-danger text-center">
                                <h4 class="card-title">@lang('site.login')</h4>
                            </div>
                            <div class="card-body ">
                                <span class="bmd-form-group has-danger">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                          </span>
                                        </div>
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required  autofocus placeholder="@lang('site.login_email')">
                                            @error('email')
                                            <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                                </span>
                                <span class="bmd-form-group has-danger">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" required placeholder="@lang('site.login_password')">
                                            @error('password')
                                            <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                                </span>
                                @if (Route::has('password.request'))
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                @lang('site.forgot_password')
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a  class="btn btn-link text-danger" href="{{ route('register') }}">
                                                @lang('site.register')
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-danger btn-lg">
                                    @lang('site.login')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="">
                                Avirnet
                            </a>
                        </li>
                        <li>
                            <a href="">
                                @lang('site.about_us')
                            </a>
                        </li>
                        <li>
                            <a href="">
                                @lang('site.blog')
                            </a>
                        </li>
                        <li>
                            <a href="">
                                @lang('site.licences')
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="" target="_blank">Avirnet</a>
                </div>
            </div>
        </footer>
    </div>
@endsection






