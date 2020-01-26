@extends("layout")
@section('page', 'about-us')
@section('title', __('site.faq'))
@section('content')

    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('/img/faq.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">@lang('site.faq')</h1>
                    <h4>@lang('site.frequently_asked_question')</h4>
                </div>
            </div>
        </div>
    </div>


    <div class="main main-raised">
        <div class="container">
            <div class="about-team team-1">
                <div id="collapse ">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 ">
                            <div id="accordion" role="tablist">

                                @foreach($faqs as $faq)
                                <div class="card card-collapse">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                                {!! $faq->question !!}
                                                <i class="material-icons">keyboard_arrow_down</i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse{{$faq->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                        <div class="card-body">
                                        {!! $faq->answer !!}
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


@endsection
