@extends('admin.layout')
@section('title', 'Create Coupon')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Coupon</h6>
        </div>
        <div class="card-body">
            <div class="col-md-4 mr-auto ml-auto">
                <form class="user" method="POST" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills"
                             role="tabpanel" aria-labelledby="pills-tab">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Seriya Code</label>
                                <div class="col-sm-9">
                                    <input  id="month" type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            name="code"
                                            value="{{ old('code') }}" >
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Coupon Count</label>
                                <div class="col-sm-9">
                                    <input  id="month" type="number"
                                            class="form-control @error('count') is-invalid @enderror"
                                            name="count"
                                            value="{{ old('count') }}" >
                                    @error('count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control  @error('type') is-invalid @enderror">
                                        <option value="2" >Trial</option>
                                        <option value="1" selected>Full package</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Period</label>
                                <div class="col-sm-9">
                                    <select name="period" class="form-control  @error('period') is-invalid @enderror">
                                        <option value="0" selected>1 week (Trial)</option>
                                        @foreach($periods as $p)
                                            <option value="{{ $p->id }}">{{ $p->month }} Month</option>
                                        @endforeach
                                    </select>
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
