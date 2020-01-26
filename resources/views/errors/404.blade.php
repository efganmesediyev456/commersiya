@extends('layout')
@section('page', 'about-us')
@section('title', __('site.error'))
@section('content')
    ​


    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('/img/error.jpeg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
{{--                    <h1 class="title">@lang('site.error')</h1>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised"   >
        <div class="container">
            <div class="about-description text-center">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto" >

                        <h3 class="description">{{__('site.not found')}}</h3>
                        <a class="btn btn-danger" href="{{ url()->previous() }}"> {{__('site.back')}} </a>

                        ​
                    </div>
                </div>
            </div>
            ​
            ​
        </div>
    </div>
    ​
    ​
@endsection()
