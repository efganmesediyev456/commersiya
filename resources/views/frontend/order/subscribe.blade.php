@extends('layout')
@section('page', 'profile-page')
@section('title', __('site.subscribe'))
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('/img/city-profile.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ __('site.subscribe') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised" style="min-height: 80vh;">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-12 ml-auto mx-auto">
                        <div class="row">
                            <div class="col-md-4 order-md-2 mb-4">
                                <div class="card card-nav-tabs mar-t-10">
                                    <div class="card-body ">
                                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                                            {{ __('site.Your packages') }}
                                        </h4>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div>
                                                    <h6 class="my-0">{{ $tariff->name }}</h6>
                                                    <small class="text-muted">{{ __('Base package') }}</small>
                                                </div>
                                                <span class="text-muted">{{ $tariff->price }} ₼</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>{{__('site.total')}} (₼)</span>
                                                <strong class="total_price">{{ $tariff->price }} ₼</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 order-md-1">
                                <div class="mt-2">
                                    @include('flash-message')
                                </div>

                                <div class="card card-nav-tabs mar-t-10">
                                    <div class="card-body ">
                                        <form class="needs-validation" method="POST" action="{{ route('order.order', $tariff->id) }}">
                                            @csrf
                                            <input type="hidden" class="unit_price" value="{{ $tariff->price }}">
                                            <h4 class="mb-3">{{ __('site.checkout') }}</h4>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group bmd-form-group">
                                                        <select class="form-control device @error('device') is-invalid @enderror"
                                                                name="device" data-style="select-with-transition" title="{{ __('Device type') }}" data-size="7">
                                                            <option>{{ __('site.Choose device') }}</option>
                                                            <option value="1">MAG  {{ __('site.devices') }}</option>
                                                            <option value="0" selected>{{ __('site.tv_and_smartphone') }}</option>
                                                        </select>
                                                        @error('device')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if($tariff->price != 0)

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group bmd-form-group">
                                                        <select class="form-control subscribe-period @error('period') is-invalid @enderror"
                                                                name="period" data-style="select-with-transition" title="{{ __('Subscribe period') }}" data-size="7">
                                                            <option>{{ __('site.Choose period') }}</option>
                                                            @foreach($periods as $period)
                                                                <option data-type="{{ $period->type }}" data-discount="{{ $period->discount }}" data-month="{{ $period->month }}"
                                                                        value="{{ $period->id }}">{{ $period->month }} {{ __('site.month') }} ( -{{ $period->discount }} %)</option>
                                                            @endforeach
                                                        </select>
                                                        @error('period')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-6 mb-3 mac_address" style="display: none">
                                                    <div class="form-group has-default bmd-form-group">
                                                        <input type="text" name="mac_address" class="form-control" placeholder="{{ __('Mac address of MAG device') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-danger btn-md btn-block" type="submit">{{__('site.subscribe')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
