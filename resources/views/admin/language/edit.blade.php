@extends('admin.layout')
@section('title', 'Edit Language')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $language->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('language.update', $language->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ $language->name }}" autocomplete="name" placeholder="{{ __('Language name') }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="code" type="text" class="form-control  @error('code') is-invalid @enderror"
                               name="code" value="{{ $language->code }}" placeholder="{{ __('Language code') }}">

                        @error('code')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="1" name="is_active" class="form-check-input" id="exampleCheck1" {{ $language->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleCheck1">{{ __('Active') }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection()
