@extends('layout')
@section('page', 'about-us')
@section('title', __('site.Ödəmə nöqtələri'))
@section('css')
    <style>
        .cards{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            align-content: center;
        }
        .card {
            font-family: PrivaPro-one;

            border-radius: 8px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
            top: 0;
            text-align: center;
            transition: all 0.25s;
            background: white;
        }
        .card{
            margin: 10px 5px;
        }
        .card:hover
        {
            top: -15px;
            box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
        }
        .card__title{
            font-family: PrivaPro-one;
            font-weight: 600;
            margin-top:15px;
            margin-bottom:15px;
            color: #003366;
        }
        .card__text {
            font-family: PrivaPro-one;
            padding:0 30px;
            font-size: 16px;
            font-weight: 300;
            margin-bottom:10px;
        }
        .card__link {
            font-weight: 500;
            text-decoration: none;
            color:#8ec64d;
            padding:2px;
        }
        .card__link:hover
        {
            text-decoration: none;
            color:#1070B4;
            border-bottom:1px solid #8ec64d;
            font-weight:bold;
        }
        .card__img{
            height:200px;
            width:250px;
        }
        .main-links_ {
            height: 130px;
        }
        .main-links_ .link {
            position: relative;
            width: 312px;
            margin-right: 10px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 2px 3px 7px -2px rgba(165, 156, 156, 0.19);
            cursor: pointer;
        }
        .main-links_ .link img {
            max-width: 100%;
        }
        .main-links_ a {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 10;
        }
        .main-links_ .link:hover {
            opacity: 0.85;
        }
        .main-links_ .link .icon {
            width: 26px;
            height: 26px;
            position: absolute;
            left: 14px;
            bottom: 20px;
        }
        .main-links_ .link .title {
            position: absolute;
            bottom: 22px;
            left: 52px;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 19px;
            line-height: 16px;
            color: #1aa0e1;
            border-bottom: 1px solid #1aa0e1;
        }
        .main-links_ .link .description {
            width: 105px;
            position: absolute;
            bottom: 20px;
            right: 22px;
            text-align: right;
            font-family: 'Calibri';
            font-style: italic;
            font-size: 12px;
            color: #aaa;
        }
    </style>
@endsection
@section('content')



    <div class="page-header header-filter header-small" data-parallax="true"
         style="background-image: url('/img/about-us.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ __('site.Ödəmə nöqtələri') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="about-description text-center">


                <div class="row">
                    @foreach($payment_methods as $payment_method)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top"
                                 src="{{  asset('uploads/payment_methods/'.$payment_method->image)  }}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{  $payment_method->name  }}</h5>
                                <table class="table">

                                    <tbody class="text-muted">
                                    <tr>
                                        <td>{{ __('site.address') }}</td>
                                        <td>{!! $payment_method->address !!}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('site.phone payment') }}</td>
                                        <td>{{ $payment_method->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('site.job_date')  }}</td>
                                        <td >{{$payment_method->job_date}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a target="_blank" class="btn btn-danger btn-round btn-block" href="{{ $payment_method->map_link  }}">{{  __('site.map view')  }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection()
