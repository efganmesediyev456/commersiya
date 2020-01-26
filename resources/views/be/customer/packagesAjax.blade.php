<select name="package_id" id="be-package_id" class="form-control @error('package_id') is-invalid @enderror">
    <option value="">Select custom package</option>
    @foreach($packages as $package)
        @if(!in_array($package->ministra_id, $default))
            <option data-id="{{ $package->id }}" value="{{ $package->ministra_id }}">{{ $package->name }}</option>
        @endif
        @endforeach
</select>
@error('package_id')
    <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
    </span>
@enderror
