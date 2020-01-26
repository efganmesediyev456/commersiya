@extends("admin.layout")
@section('title', 'Service')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Show {{ $service->login }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">





                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input id="password" type="text" class="form-control " value="{{$service->password}}"  readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control"  value="{{$service->login}}"  readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                    <input id="account_number" type="text" class="form-control" value="{{$service->account_number}}"  readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">License</label>
                                <div class="col-sm-9">
                                    <input id="license" type="text" class="form-control" value="{{$service->license}}"readonly>
                                </div>
                            </div>


                        </div>

                    </div>


                    {{--<div class="form-group">--}}
                    {{--<div class="form-check">--}}
                    {{--<input type="checkbox" value="1" name="is_active" class="form-check-input" id="exampleCheck1"--}}
                    {{--{{ $service->is_active ? 'checked' : '' }}>--}}
                    {{--<label class="form-check-label" for="exampleCheck1">{{ __('Active') }}</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}

        </div>
    </div>


@endsection()
