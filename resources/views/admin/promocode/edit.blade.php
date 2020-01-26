@extends('admin.layout')
@section('title', 'Create Promocode')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Promocode</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('promocode.update', $promocode->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert-danger alert">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">

                        <div class="row">
                            <div class="col-2">
                                <label for="code" class="col-form-label">Code</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <input id="code" type="text"
                                           class="form-control @error('code') is-invalid @enderror"
                                           name="code" value="{{$promocode->code}}"
                                           placeholder="Code">
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="discount" class="col-form-label">Discount</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <input id="discount" type="text"
                                           class="form-control @error('discount') is-invalid @enderror"
                                           name="discount" value="{{ $promocode->discount }}"
                                           placeholder="Discount">
                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label for="deadline" class="col-form-label">Deadline</label>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <input id="deadline" type="date"
                                           class="form-control @error('deadline') is-invalid @enderror"
                                           name="deadline" value="{{$promocode->deadline}}">
                                    @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Update') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
