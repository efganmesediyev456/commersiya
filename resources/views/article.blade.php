@extends('layout')
@section('page', 'about-us')
@section('title', __('site.article'))
@section('content')

    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('{{ asset('uploads/article/'.$article->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ $article->getTranslationWithoutFallback('title', app()->getLocale()) }}</h1>
{{--                    <h4>Meet the amazing team behind this project and find out more about how we work.</h4>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="about-description text-center">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        @if(isset($article))
                            {!! $article->getTranslationWithoutFallback('text', app()->getLocale()) !!}
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection()
