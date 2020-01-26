@extends("admin.layout")
@section('title', 'Article')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Show {{ $subscription->login }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('subscription.update', $subscription->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User</label>
                                <div class="col-sm-9">
                                    <input id="user" type="text" class="form-control "
                                           value="{{$subscription->user->name}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Package</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control"
                                           value="{{$subscription->tariff->name}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control"
                                           value="{{$subscription->account_number}}" readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Deadline</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control"
                                           value="{{$subscription->deadline}}" readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment Status</label>
                                <div class="col-sm-9">
                                    <input id="payment" type="text" class="form-control"
                                           value="{{ $subscription->payment_status ? 'Paid' : 'No Paid' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <input id="status" type="text" class="form-control"
                                           value="{{ $subscription->status ? 'Active' : 'Deactive' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Device</label>
                                <div class="col-sm-9">
                                    <input id="device" type="text" class="form-control"
                                           value="{{ $subscription->device ? ' MAG devices' : ' TV, Smartphones'}}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Period</label>
                                <div class="col-sm-9">

                                    <input id="period" type="text" class="form-control"
                                           value="{{$subscription->period}}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mac Address</label>
                                <div class="col-sm-9">
                                    <input id="period" type="text" class="form-control"
                                           value="{{$subscription->mac_address}}" readonly>
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

                </form>
            </div>
        </div>
    </div>


@endsection()
