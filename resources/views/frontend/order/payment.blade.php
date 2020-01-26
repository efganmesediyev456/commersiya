@extends('layout')
@section('page', 'profile-page')
@section('title', __('site.payment'))
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('/img/city-profile.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ __('site.payment') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised" style="min-height: 80vh;">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 ml-auto mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <address>
                                            <strong>{{ $subscription->user->name }}</strong>
                                        </address>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p>
                                            <em>{{__('site.date')}}: {{ $subscription->created_at }}</em>
                                        </p>
                                        <p>
                                            <em>{{__('site.receipt')}} #: {{ $subscription->account_number }}</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <h3>{{__('site.receipt')}}</h3>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{__('site.product')}}</th>
                                            <th>{{ __('site.period') }}</th>
                                            <th class="text-center">{{ __('site.price') }}</th>
                                            <th class="text-center">{{ __('site.total') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-md-9"><em><h4>{{ $subscription->tariff->name }}</h4></em></td>
                                            <td class="col-md-1"> {{ $subscription->month->month }} {{ __('site.month') }} </td>
                                            <td class="col-md-1 text-center">{{ $subscription->tariff->price }}</td>
                                            <td class="col-md-1 text-center">{{ $subscription->amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td class="text-right">
                                                <p>
                                                    <strong>{{__('site.subtotal')}}: </strong>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p>
                                                    <strong>{{ $subscription->amount }}</strong>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <h4>
                                                    {{__('site.pay million or card')}}
                                                </h4>
                                            <h4> Account number: <b>{{$subscription->account_number}}</b></h4>
                                            </td>
                                            <td>   </td>
                                            <td class="text-right"><h4><strong>{{__("site.total")}}: </strong></h4></td>
                                            <td class="text-center text-danger"><h4><strong>{{ $subscription->amount }} ₼</strong></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-lg btn-block">
                                        {{__('site.pay')}}  <span class="glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
