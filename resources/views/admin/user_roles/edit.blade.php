@extends('admin.layout')
@section('title', 'Edit Service')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $role->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action=" {{ route('user_roles.update', ['role_id'=>$role->id, 'user_id'=>$user->id]) }} ">
                    @csrf
                    @method('PUT')



                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Name</label>
                                <div class="col-sm-9">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" placeholder="{{ __('Name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role Name</label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control  @error('role') is-invalid @enderror">
                                        @foreach($roles as $r)
                                            @if($r->name != 'super-admin')
                                            <option @if($role->id==$r->id) selected @endif value="{{ $r->id }} "> {{ $r->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
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
