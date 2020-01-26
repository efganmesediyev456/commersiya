@extends('admin.layout')
@section('title', 'Edit Admin BE')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $user->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">

                <form class="user" method="POST" action="{{ route('admin-be.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{$user->name}}" placeholder="{{ __('Name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Surname</label>
                                <div class="col-sm-9">
                                    <input id="surname" type="text"
                                           class="form-control @error('surname') is-invalid @enderror" name="surname"
                                           value="{{$user->surname}}" placeholder="{{ __('Surname') }}">
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{$user->email}}" placeholder="{{ __('Email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                <select name="type"
                                        class="form-control  @error('type') is-invalid @enderror">
                                    <option @if($user->status==1) selected @endif value="1">BE</option>
                                    <option @if($user->status==0) selected @endif value="0">Admin</option>

                                </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input id="password" type="text"
                                           class="form-control @error('pssword') is-invalid @enderror" name="password"
                                           value="{{$user->pssword}}" placeholder="{{ __('Password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Edit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection
