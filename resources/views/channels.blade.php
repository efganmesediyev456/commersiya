@extends("layout")
@section('page', 'profile-page')
@section('title', __('site.channels'))
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('/img/city-profile.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ __('site.channels') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="about-team team-1">
                <div id="collapse ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div id="accordion" role="tablist">
                                @foreach($packages as $package)

                                    <div class="card card-collapse">
                                        <div class="card-header" role="tab" id="headingOne">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" href="#collapse{{$package->id}}" aria-expanded="@if($loop->iteration ==1) true @else false @endif" aria-controls="collapseOne" class="collapsed">
                                                    {{$package->name}}
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapse{{$package->id}}" class="collapse @if($loop->iteration ==1) show @endif" role="tabpanel"  aria-labelledby="headingOne" data-parent="#accordion" style="">
                                            <div class="card-body">


                                                <div class="profile-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 ml-auto mx-auto">
                                                                <div class="social-line social-line-big-icons social-line-white">
                                                                    <div class="container">
                                                                        <div class="row ">
                                                                            @foreach($package->services as $channel)
                                                                                @if($channel->logo)
                                                                                    <div class="col-md-2" style="margin-bottom: 30px">
                                                                                        <a href="" class="btn btn-link btn-just-icon btn-twitter"                                                                                                   style="height: unset">
                                                                                            <img src="http://ministra.avirtel.az/stalker_portal/misc/logos/320/{{ $channel->logo}}" title="{{$channel->name}}" class="">
                                                                                            <div class="ripple-container"></div>
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="main main-raised" style="min-height: 80vh;">--}}
{{--        <div class="profile-content">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-10 col-md-12 ml-auto mx-auto">--}}
{{--                        <div class="row">--}}
{{--                            <div class="social-line social-line-big-icons social-line-white">--}}
{{--                                <div class="container">--}}
{{--                                    <div class="row">--}}
{{--                                        @foreach($channels as $channel)--}}
{{--                                            @if($channel->logo)--}}
{{--                                                <div class="col-md-2 col-4" style="margin-bottom: 30px">--}}
{{--                                                    <a href="" class="btn btn-link btn-just-icon btn-twitter" style="height: unset">--}}
{{--                                                       <img src="http://ministra.avirtel.az/stalker_portal/misc/logos/320/{{ $channel->logo}}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    @endsection
