@extends('layout')
@section('page', 'profile-page')
@section('title',  __('site.profile'))
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('img/city-profile.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h1 class="title">{{ __("site.profile") }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main main-raised" style="min-height: 80vh;">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 ml-auto mx-auto">
                        <div class="card card-nav-tabs mar-t-10">
                            <div class="card-header card-header-danger">
                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active show" href="#profile" data-toggle="tab">
                                                    <i class="material-icons">dashboard</i> {{ __('site.dashboard') }}
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#account" data-toggle="tab">
                                                    <i class="material-icons">account_box</i> {{ __('site.account') }}
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#subscriptions" data-toggle="tab">
                                                    <i class="material-icons">done_all</i> {{ __('site.subscriptions') }}
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#settings" data-toggle="tab">
                                                    <i class="material-icons">build</i> {{ __('site.settings') }}
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content text-center">
                                    <div class="tab-pane active show" id="profile">
                                        <div class="row">
                                            <div class="col-12">
                                                @include('flash-message')
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col " style="font-weight:500; padding-top:80px;">
                                                <p style="font-size:20px !important; text-align: center !important">Əgər
                                                    sizin İPTV kartınız varsa , kartın arxasındakı şifrəni buradan daxil
                                                    edərək 12 aylıq <b>FULL</b> paketə qoşula bilərsiniz.</p>
                                            </div>
                                            <div class="col ">
                                                <div class="card" style="width: 20rem;">
                                                    <img class="card-img-top" style="border-radius: 10px !important; "
                                                         src="{{asset('img/card.png')}}" alt="Card image cap">
                                                </div>
                                            </div>

                                        </div>

                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger">
                                                    <div class="container">
                                                        <div class="alert-icon">
                                                            <i class="material-icons">error_outline</i>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                                        </button>
                                                        <b> {{ __('site.error') }} : </b> {{ $error }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(session()->has('success'))

                                            <div class="alert alert-success">
                                                <div class="container">
                                                    <div class="alert-icon">
                                                        <i class="material-icons">check</i>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                                    </button>
                                                    {{ session()->get('success') }}
                                                </div>
                                            </div>

                                        @endif

                                        <form action="{{ route('frontend.search.coupon') }}" class="user" method="post">

                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-6 has-danger">
                                                    <input id="code" type="text" class="form-control" name="code"
                                                           value=" {{ old('code') }} " placeholder="Promo kodu daxil edin" autofocus>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-danger btn-round">Daxil et</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane" id="account">
                                        <div class="container emp-profile">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="avatar">
                                                            <img src="https://www.w3schools.com/howto/img_avatar.png"
                                                                 style="width: 100%;  border-radius: 50%;" alt="Circle Image" class="circle">
                                                        </div>
                                                        <div class="profile-head" style="text-align: center;">
                                                            <h5 class='text-danger font-italic '>
                                                                {{ ucfirst(auth()->user()->name) }}
                                                            </h5>
                                                            <h6>
                                                                {{ auth()->user()->email }}
                                                            </h6>
                                                            {{--                                                            <p class="proile-rating">RANKINGS : <span class="font-weight-bold">8/10</span></p>--}}
                                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col"> {{ __('site.tariff name') }}</th>
                                                                <th scope="col">{{ __('site.deadline') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($user->orders as $k=>$s)
                                                                <tr  @if($k%2==0) class="table-warning" @endif>
                                                                    <td>{{ $k+1 }}</td>
                                                                    <td>{{ $s->tariff->name }}</td>
                                                                    <td>
                                                                        @if(isset($s->deadline))
                                                                            {{ \Carbon\Carbon::parse($s->deadline)->translatedFormat('d F Y')  }}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach()
                                                            </tbody>
                                                        </table>







                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="subscriptions">
                                        <a href="{{ route('pricing') }}" class="btn btn-success float-right">
                                            <i class="material-icons">add</i>
                                            {{ __('site.add') }}
                                        </a>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('site.package') }}</th>
                                                    <th>{{ __('site.payment_date') }}</th>
                                                    <th>{{ __('site.payment_status') }}</th>
                                                    <th class="text-right">{{ __('site.price') }}</th>
                                                    <th class="text-right">{{ __('site.period') }}</th>
                                                    <th class="text-right">{{ __('site.payed') }}</th>
                                                    <th class="text-right">{{ __('site.actions') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user->orders as $order)
                                                    <tr>
                                                        <td>{{ $order->tariff->name }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                       <span class="badge badge-pill {{ $order->payment_status ? 'badge-success' : 'badge-danger' }}">
                                                           {{ $order->payment_status ? __('site.payed') : __('site.not-payed') }}
                                                       </span>
                                                        </td>
                                                        <td class="text-right">{{ $order->tariff->price }} ₼</td>
                                                        <td class="text-right">
                                                            @if($order->month)
                                                                {{ $order->month->month }}
                                                                {{ __('site.month') }}
                                                            @else
                                                                7 Gün
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ $order->amount }} ₼</td>
                                                        <td class="td-actions text-right">
                                                            @if($order->payment_status)
                                                                <button type="button" data-id="{{ $order->id }}"
                                                                        rel="tooltip"
                                                                        class="btn btn-info btn-sm service-detail"
                                                                        data-original-title="{{ __('site.view-details') }}"
                                                                        title="{{ __('site.view-details') }}"
                                                                        data-toggle="modal"
                                                                        data-target="#customerDetailModal">
                                                                    <i class="material-icons">visibility</i>
                                                                    {{ __('site.view-details') }}
                                                                    <div class="ripple-container"></div>
                                                                </button>
                                                            @else
                                                                <form action="{{ route('order.payment', $order->id) }}"
                                                                      method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                            rel="tooltip"
                                                                            data-original-title="{{ __('site.pay') }}"
                                                                            title="{{ __('site.pay') }}">
                                                                        <i class="material-icons">payment</i>
                                                                        {{ __('site.pay') }}
                                                                        <div class="ripple-container"></div>
                                                                    </button>
                                                                </form>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="settings">
                                        <h3>{{ __('site.change_password') }}</h3>

                                        <form action="{{url('change-pass')}}" method="post" class="form">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                      </span>
                                                    </div>
                                                    <input id="current" type="password"
                                                           class="form-control @error('current') is-invalid @enderror"
                                                           name="current" required
                                                           placeholder="{{ __('site.current_password') }}">

                                                    @error('current')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                      </span>
                                                    </div>
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password" required
                                                           placeholder="{{ __('site.new_password') }}">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                      </span>
                                                    </div>
                                                    <input type="password"
                                                           class="form-control @error('confirm') is-invalid @enderror"
                                                           name="confirm" required
                                                           placeholder=" {{ __('site.confirm_new_password') }}">

                                                    @error('confirm')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-danger btn-round">
                                                {{ __('site.change') }}
                                            </button>
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
    <div class="modal fade" id="customerDetailModal" tabindex="-1" role="dialog" aria-labelledby="customerDetailModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('site.close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.service-detail').click(function () {
                var id = $(this).data('id');

                $("#modal_body").html('');
                $.ajax({
                    'url': '{{route('service.detail')}}',
                    'data': {'_token': '{{ csrf_token() }}', 'id': id},
                    'type': 'post',
                    'success': function (e) {

                        $("#modal_body").html(e);

                    }
                })

            })
        })
    </script>
@endpush

