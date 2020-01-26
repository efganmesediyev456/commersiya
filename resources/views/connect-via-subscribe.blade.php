@extends('layout')
@section('page', 'about-us')
@section('title', __('site.How to connect us'))
@section('content')
    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('/img/about-us.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">@lang('site.How to connect us')</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="about-description text-center">
                <div class="row">
                    <div class="col-md-9 ml-auto mr-auto">
                        <div class="table">
                            <table class="table table-bordered table-responsive-sm  table-white" style="background: white !important">
                                <thead>
                                <tr>
                                    <th>{{ __('site.Ministra Url') }}</th>
                                    <th>{{ __('site.Ministra login') }}</th>
                                    <th>{{ __('site.Ministra password') }}</th>
                                    <th>{{ __('site.License key') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="http://ministra.avirtel.az/stalker_portal/" target="_blank">http://ministra.avirtel.az/stalker_portal/</a></td>
                                    <td>{{ $subscription->service->login }}</td>
                                    <td>{{ $subscription->service->password }}</td>
                                    <td>{{ $subscription->service->license }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col">
                                    {!! $content->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection()
