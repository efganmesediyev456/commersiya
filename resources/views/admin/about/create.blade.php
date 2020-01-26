@extends("admin.layout")
@section('title', 'About')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create </h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('about.store') }}">
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
                        @foreach ($locales as $locale)
                            <div class="tab-pane fade show {{ ($locale->code == 'az') ? 'active': '' }}" id="pills-{{ $locale->code }}"
                                 role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">

                                <div class="form-group">
                                    <textarea id="content" rows="5" class="form-control textarea @error('content') is-invalid @enderror"
                                              name="content[{{ $locale->code }}]"
                                              placeholder="{{ __('Content -').$locale->name }}">{{ old('content') }}</textarea>
                                    @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
<<<<<<< HEAD

                            </div>
                        @endforeach

                            <div class="form-group">
                                <input id="key" class="form-control @error('key') is-invalid @enderror"
                                       name="key"
                                       placeholder="{{ __('Key')}}" value="{{ old('key') }}">
                                @error('key')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

=======
                            </div>
                        @endforeach

>>>>>>> e4127e9e087a418979f19f83d8627a1092b01b6c
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    @endsection
