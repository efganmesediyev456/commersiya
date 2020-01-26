@extends('admin.layout')
@section('title', 'Create User')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Update User</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 mr-auto ml-auto">
                <form class="user" method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills"
                             role="tabpanel" aria-labelledby="pills-tab">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ $user->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ $user->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $message  !!} </strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control  @error('period') is-invalid @enderror">
                                        @foreach($roles as $r)
                                            @if($r->name!='super-admin')
                                                <option @if($user->hasRole($r->name)) selected @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password">New Password</label>
                                <div class="col-sm-9">
                                    <input id="password" type="password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password"
                                           value="{{ old('password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password_confirmation">Confirm New Password</label>
                                <div class="col-sm-9">
                                    <input id="password_confirmation" type="password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation"
                                           value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        {{--<div class="form-group">--}}
                        {{--<div class="form-check">--}}
                        {{--<input type="checkbox" value="1" name="is_active" class="form-check-input"--}}
                        {{--id="exampleCheck1" {{ old('is_active') ? 'checked' : '' }}>--}}
                        {{--<label class="form-check-label" for="exampleCheck1">{{ __('Active') }}</label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>



@endsection
