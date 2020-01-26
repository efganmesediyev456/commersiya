@extends('admin.layout')
@section('title', 'Create Period')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Period</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('period.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills"
                             role="tabpanel" aria-labelledby="pills-tab">





                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Month</label>
                                <div class="col-sm-9">
                                    <input  id="month" type="number"
                                           class="form-control @error('month') is-invalid @enderror"
                                           name="month" value="{{ old('month') }}"
                                           placeholder="{{ __('Month') }}">
                                    @error('month')
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
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Discount</label>
                                <div class="col-sm-9">
                                <input step="0.01" id="type" type="number"
                                       class="form-control @error('discount') is-invalid @enderror"
                                       name="discount" value="{{ old('discount') }}"
                                       placeholder="{{ __('Discount') }}">
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
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
