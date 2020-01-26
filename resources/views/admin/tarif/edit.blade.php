@extends('admin.layout')
@section('title', 'Edit Tariff')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $tariff->name }}</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('tariff.update', $tariff->id) }}">
                    @csrf
                    @method('PUT')
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
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name[{{ $locale->code }}]" value="{{ $tariff->getTranslation('name', $locale->code) }}"
                                           placeholder="{{ __('Package name-').$locale->code}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <input id="price" type="text" class="form-control  @error('price') is-invalid @enderror"
                               name="price" value="{{ $tariff->price }}" placeholder="{{ __('Price') }}">

                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="detail" type="text" class="form-control  @error('detail') is-invalid @enderror"
                               name="detail" value="{{ $tariff->detail }}" placeholder="{{ __('Detail') }}">

                        @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="icon" type="text" class="form-control  @error('icon') is-invalid @enderror"
                               name="icon" value="{{ $tariff->icon }}" placeholder="{{ __('Icon') }}">

                        @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select name="type" class="form-control  @error('type') is-invalid @enderror" required>
                            <option value="0" @if($tariff->type == 0) selected @endif>full</option>
                            <option value="1" @if($tariff->type == 1) selected @endif>custom</option>
                        </select>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select name="ministra_id" class="form-control  @error('ministra_id') is-invalid @enderror">
                            <option>Select ministra package</option>
                    @foreach($packages as $min_package)
                                    <option value="{{ $min_package->id }}" {{ ($min_package->id == $tariff->ministra_id) ? 'selected': '' }}>{{ $min_package->name }}</option>
                     @endforeach
                        </select>

                        @error('ministra_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                    <div class="form-group">


                        @foreach($site_packages as $package)

                            <div class="form-check">
                                <input  type="checkbox" class="form-check-input" id="default-package{{ $package->id }}" @if(in_array($package->id, $choose_packages)>0) checked  @endif value="{{ $package->id }}" name="default[]">
                                <label class="form-check-label" for="default-package{{ $package->id }}">{{ $package->name }}</label>
                            </div>
                        @endforeach

                        @error('default')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="1" name="is_active" class="form-check-input" id="exampleCheck1"
                                {{ $tariff->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleCheck1">{{ __('Active') }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Edit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection()
