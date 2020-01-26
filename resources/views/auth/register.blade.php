@extends('login-layout')
@section('page', 'signup-page')
@section('title', __('site.register') )
@section('content')
    <div class="page-header header-filter" filter-color="yellow" style="background-image: url('img/register.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-5 ml-auto mr-auto">
                    <div class="card card-signup">
                        <h2 class="card-title text-center"> {{ __('site.register') }} </h2>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mr-auto">
                                    <form class="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group has-danger">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">face</i>
                                                      </span>
                                                </div>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                       required autocomplete="name" autofocus placeholder=" {{ __('site.register name') }} ">
                                                @error('name')
                                                <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">mail</i>
                                                      </span>
                                                </div>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                                       required autocomplete="email" placeholder=" {{ __('site.register email')  }} ">
                                                @error('email')
                                                <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{!! $message !!}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="input-group has-danger">
                                                        <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">phone</i>
                                                      </span>
                                                        </div>

                                                        <input name="country_code" id="country_code"  pattern="[0-9]{3}"    type="text" class="form-control @error('country_code') is-invalid @enderror" value="{{ old('country_code') }}"
                                                               required autocomplete="country_code" placeholder=" {{ __('site.country code')  }} " onkeyup="setCustomValidity('')" title="{{ __('site.country code example') }}" onclick="setCustomValidity('')" oninvalid="setCustomValidity('{{ __('site.country code example')  }}')">
                                                        @error('country_code')
                                                        <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{!! $message !!}</strong>
                                                 </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <div class="input-group has-danger">

                                                        <input id="phone"  pattern="[0-9]{9}"     type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
                                                               required autocomplete="phone" placeholder=" {{ __('site.register phone')  }} " onkeyup="setCustomValidity('')" title="{{  __('site.phone example')  }}" onclick="setCustomValidity('')" oninvalid="setCustomValidity( '{{  __('site.phone example')  }}' )">
                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{!! $message !!}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group has-danger">
                                            <div class="input-group has-danger">
                                                <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                      </span>
                                                </div>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('site.register password') }}">
                                                @error('password')
                                                <span class="invalid-feedback pl-5" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group has-danger">
                                                <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                      </span>
                                                </div>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder=" {{ __('site.register confirm') }} ">
                                            </div>
                                        </div>
                                        {{--                                        <div class="form-check">--}}
                                        {{--                                            <label class="form-check-label" data-toggle="modal" data-target="#exampleModal">--}}
                                        {{--                                                <input class="form-check-input" type="checkbox" value="" id="condition">--}}

                                        {{--                                                <span class="form-check-sign">--}}
                                        {{--                                                    <span class="check"></span>--}}
                                        {{--                                                    </span>--}}
                                        {{--                                               {{ __('site.register agree') }}--}}

                                        {{--                                                <a href="#something">{{ __('site.register more') }}</a>--}}
                                        {{--                                                <span type="button" data-toggle="modal" data-target="#exampleModal">--}}
                                        {{--                                                    { __('site.register agree') }}--}}
                                        {{--                                                </span>--}}
                                        {{--                                            </label>--}}

                                        {{--                                        </div>--}}

                                        <div class="form-group has-danger" style="padding-left: 40px;">
                                            <div class="input-group">
                                                <label data-toggle="modal" class="form-check-label" data-target="#exampleModal">
                                                    <input type="checkbox" class="form-check-input @error('condition') is-invalid @enderror" name="condition" id="condition" style="margin-top:0px;" value="1">
                                                    {{ __('site.register agree') }}
                                                    <a href="#something">{{ __('site.register more') }}</a>
                                                </label>
                                            </div>
                                            @error('condition')
                                            <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"  id="register" class="btn btn-danger btn-round">
                                                {{ __('site.register button') }}
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" style="" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! $conditions->content !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="disagree" data-dismiss="modal">{{__('site.close')}}</button>
                        <button type="button" class="btn btn-danger"  data-dismiss="modal" id="agree">{{__('site.accept')}}</button>
                    </div>
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
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Licenses
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

@push('js')
    {{--    <script>--}}
    {{--        $('#register').click(function(){--}}
    {{--            if( $('input[type=checkbox]').attr('checked') ){--}}
    {{--                $('.form').submit();--}}
    {{--            }--}}
    {{--            else {--}}
    {{--                $('#condition-error').show();--}}
    {{--                $('#condition-error-text').html('Şərtlərin seçilməsi mütləqdir');--}}
    {{--            }--}}

    {{--        })--}}
    {{--    </script>--}}



@endpush
