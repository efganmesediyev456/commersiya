@extends('admin.layout')
@section('title', 'Create User')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('admin-be.store') }}">
                    @csrf

                    <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name='name' value="{{ old('name') }}"
                               placeholder="Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                               name='surname' value="{{ old('surname') }}"
                               placeholder="Surname">
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name='email' value="{{ old('email') }}"
                               placeholder="E-mail">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name='password'
                               placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="confirm" type="password" class="form-control @error('confirm') is-invalid @enderror"
                               name='confirm'
                               placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="">Select status</option>
                            <option value="0">Admin</option>
                            <option value="1">Baku Electronics User</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>





@endsection
