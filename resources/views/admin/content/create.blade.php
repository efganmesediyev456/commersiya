@extends('admin.layout')
@section('title', 'Create Content')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create content</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('content.store') }}">
                    @csrf
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($locales as $locale)
                            <li class="nav-item">
                                <a class="nav-link {{ ($locale->code == 'az') ? 'active': '' }}" id="pills-tab-{{ $locale->code }}"
                                   data-toggle="pill" href="#pills-{{ $locale->code }}" role="tab"
                                   aria-controls="pills-{{ $locale->code }}" aria-selected="true">{{ $locale->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">

                        <div class="form-group">
                            <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror"
                                   name="icon" value="{{ old('icon') }}"
                                   placeholder="Icon">
                            @error('icon')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        @foreach ($locales as $locale)
                            <div class="tab-pane fade show {{ ($locale->code == 'az') ? 'active': '' }}" id="pills-{{ $locale->code }}"
                                 role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">
                                <div class="form-group">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title[{{ $locale->code }}]" value="{{ old('title') }}"
                                           placeholder="{{ __('Title -').$locale->name }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea id="text" rows="5" class="form-control @error('text') is-invalid @enderror"
                                              name="text[{{ $locale->code }}]"
                                              placeholder="{{ __('Text -').$locale->name }}">{{ old('text') }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach


                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" value="1" name="is_active" class="form-check-input" id="exampleCheck1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">{{ __('Active') }}</label>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection
