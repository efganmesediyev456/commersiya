@extends('layout')
@section('page', 'contact-page')
@section('title', __('site.contact_us'))
@section('content')
    <div id="contactUsMap" class="big-map"></div>
    <div class="main main-raised">
        <div class="contact-content">
            <div class="container">
                @include('flash-message')
                <h2 class="title">@lang('site.send_us_message')</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="description">{{ __('site.help') }}
                            <br>
                            <br>
                        </p>
                        <form role="form" id="contact-form" method="post" action={{action('Frontend\HomeController@sendMessage')}}>
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name" class="bmd-label-floating">@lang('site.name')</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmails" class="bmd-label-floating">@lang('site.email')</label>
                                <input type="email" class="form-control" id="exampleInputEmails" name="email" required value="{{ old('email')  }}">
                                <span class="bmd-help">We'll never share your email with anyone else.</span>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="bmd-label-floating">@lang('site.phone')</label>
                                <input pattern="[0-9]{10}"  type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}" name="phone" required onkeyup="setCustomValidity('')" title="{{  __('site.phone example contact')  }}" onclick="setCustomValidity('')" oninvalid="setCustomValidity( '{{  __('site.phone example contact')  }}' )">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! $message !!}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group label-floating">
                                <label class="form-control-label bmd-label-floating" for="message"> @lang('site.message')</label>
                                <textarea class="form-control" rows="6" id="message" name="message" required>{{  old('message')  }}</textarea>
                            </div>
                            <div class="submit text-center">
                                <input type="submit" class="btn btn-danger btn-raised btn-round" value="@lang('site.send_message')">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 ml-auto">
                        <div class="info info-horizontal">
                            <div class="icon icon-danger">
                                <i class="material-icons">pin_drop</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">@lang('site.find_unvan')</h4>
                                <p>     Avirtoll MMC
                                    <br> M.Araz küç. 50c,
                                    <br> AZ 1106, Nərimanov ray.,
                                    <br> Bakı
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-danger">
                                <i class="material-icons">phone</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">@lang('site.customer_service')</h4>
                                <p> @lang('site.contact_number'): 176
                                    <br> contact@avirnet.az
                                    <br> Bazar ertəsi - Şənbə, 9:00-23:00
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6q83jcEbxloW8tYOXLgagBGJ1xrDowHc&language=az-AZ" async></script>
    <script>
    $().ready(function() {
        materialKitDemo.initContactUsMap();
    });
    </script>
@endpush
