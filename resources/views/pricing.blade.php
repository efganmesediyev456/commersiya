@extends('layout')
@section('page', 'pricing')
@section('title', __('site.pricing'))
@section('content')
    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('/img/pricing.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">@lang('site.pricing')</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="pricing-2">
{{--                <div class="row">--}}
{{--                    <div class="col-md-6 ml-auto mr-auto text-center">--}}
{{--                        <ul class="nav nav-pills nav-pills-danger">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" href="#pill1" data-toggle="tab">@lang('site.monthly')</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#pill2" data-toggle="tab">@lang('site.yearly')</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row">
                    @foreach($tariffs as $tariff)
                        <div class="col-lg-3 col-md-3">
                            <div class="card card-pricing">
                                <div class="card-body ">
                                    <h4 class="card-title">{{ $tariff->name }}</h4>
                                    <div class="icon icon-danger">
                                        <i class="material-icons">{{ $tariff->icon }}</i>
                                    </div>
                                    <h3 class="card-title">{{ $tariff->price }}<small> ₼</small></h3>
                                    <p class="card-description">
                                        {{ $tariff->detail }}
                                    </p>
                                    @if($tariff->type == 1)
                                        <a href="{{ route('frontend.select-package', $tariff->id) }}" class="btn btn-danger btn-round">{{ __('site.choose_plan') }}</a>
                                    @else
                                        <a href="{{ route('order.subscribe', $tariff->id) }}" class="btn btn-danger btn-round">{{ __('site.choose_plan') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="features-2">
                <div class="text-center">
                    <h3 class="title">@lang('site.frequently_asked_question')</h3>
                </div>



                @foreach(collect($faqs)->chunk(2) as $v=>$faq)
                    <div class="row">
                        @foreach($faq as $k=>$add)
                            <div class="col-md-4 @if ($k % 2 == 0) ml-auto  @else mr-auto @endif ">
                                <div class="info info-horizontal">
                                    <div class="icon icon-{{ $icons[$k]['icon_color'] }}">
                                        <i class="material-icons">{{ $icons[$k]['icon_name'] }}</i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">{{ $add->question }}</h4>
                                        <p>{{ $add->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach




            </div>
        </div>
    </div>

    @endsection
