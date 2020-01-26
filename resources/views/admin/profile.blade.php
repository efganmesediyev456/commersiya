@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{route('admin.change-pass', $admin->id)}}">
                    @csrf

                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="name" type="text" class="form-control" value="{{$admin->name}}" placeholder="{{ __('Name') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Surname</label>
                                <div class="col-sm-9">
                                    <input id="surname" type="text" class="form-control" value="{{$admin->surname}}" placeholder="{{ __('Surname') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input id="e-mail" type="email" class="form-control" value="{{$admin->email}}" placeholder="{{ __('Password') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Current password</label>
                                <div class="col-sm-9">
                                    <input id="current" type="password" class="form-control" name="current"  placeholder="{{ __('Password') }}" required>
                                    @error('current')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New password</label>
                                <div class="col-sm-9">
                                    <input id="newpass" required type="password" class="form-control" name="newpass"  placeholder="{{ __('New password') }}" >
                                    @error('newpass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input id="confirm" required type="password" class="form-control " name="confirm" value="" placeholder="{{ __('Confirm password') }}" >
                                    @error('confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
