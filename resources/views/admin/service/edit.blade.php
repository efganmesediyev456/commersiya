@extends('admin.layout')
@section('title', 'Edit Service')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $service->login }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('service.update', $service->id) }}">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert-danger alert">{{$error}}</div>
                        @endforeach
                    @endif

                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input id="password" type="text" class="form-control " name="password" value="{{$service->password}}" placeholder="{{ __('Password') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control" name="login" value="{{$service->login}}" placeholder="{{ __('Login') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control" name="account_number" value="{{$service->account_number}}" placeholder="{{ __('Account Number') }}" readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">License</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control " name="license" value="{{$service->license}}" placeholder="{{ __('License') }}" >
                                </div>
                            </div>



                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Edit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection
