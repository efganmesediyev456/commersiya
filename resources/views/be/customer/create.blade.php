@extends('be.layout')
@section('title', 'Create customer')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create new customer</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                <form class="user" method="POST" action="{{ route('be.customers.store') }}">
                    @csrf
                    <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name='name' value="{{ old('name') }}"
                               placeholder="{{ __('Name') }}">
                        @error('name')
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
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                               name='phone'
                               placeholder="Phone number">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select name="tariff_id" id="be-tariff-plan" class="form-control @error('tariff_id') is-invalid @enderror">
                            <option value="">Select tariff plan</option>
                            @foreach($tariffs as $tariff)
                                <option data-type="{{ $tariff->type }}" value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                            @endforeach
                        </select>
                        @error('tariff_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group" id="be-package">

                    </div>
                    <div class="form-group">
                        <select name="device" id="" class="form-control device">
                            <option value="0">Tv or other devices</option>
                            <option value="1">MAG devices</option>
                        </select>
                        @error('device')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mac_address" style="display: none">
                        <input type="text" name="mac_address" class="form-control" placeholder="{{ __('Mac address of MAG device') }}">
                    </div>
                    <div class="form-group">
                        <select name="period" id="" class="form-control">
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}">{{ $period->month }} {{ __('month') }} ({{ $period->discount }} %)</option>
                            @endforeach
                        </select>
                        @error('device')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#be-tariff-plan").change(function(){
                let type = $(this).find(':selected').data('type');
                let tariff_id = $(this).val();
                let package_div =$('#be-package');
                if (type === 1){
                    $.ajax({
                        'url':'{{route('be.customers.get-packages')}}',
                        'data':{'_token':'{{ csrf_token() }}', 'tariff_id':tariff_id},
                        'type':'post',
                        'success':function (data) {
                            package_div.show();
                            package_div.html(data)
                        }
                    })
                }
                else {
                    $('#be-package').hide();
                }
            });
        });
    </script>
@endpush
