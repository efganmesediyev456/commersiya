@extends('admin.layout')
@section('title', 'Create Payment Method')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Article</h6>
        </div>
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <form class="user" method="POST" action="{{ route('payment_methods.store') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($locales as $locale)
                            <li class="nav-item">
                                <a class="nav-link {{ ($locale->code == 'az') ? 'active': '' }}"
                                   id="pills-tab-{{ $locale->code }}"
                                   data-toggle="pill" href="#pills-{{ $locale->code }}" role="tab"
                                   aria-controls="pills-{{ $locale->code }}"
                                   aria-selected="true">{{ $locale->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">

                        @foreach ($locales as $locale)

                            <div class="tab-pane fade show {{ ($locale->code == 'az') ? 'active': '' }}"
                                 id="pills-{{ $locale->code }}"
                                 role="tabpanel" aria-labelledby="pills-tab-{{ $locale->code }}">




                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="name">Name</label>
                                        <div class="col-sm-9">
                                        <input id="name"
                                               class=" form-control @error('name') is-invalid @enderror"
                                               name="name[{{ $locale->code }}]"
                                               placeholder="{{ __('name -').$locale->name }}" value=""/>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="address">Address</label>
                                    <div class="col-sm-9">
                                    <textarea id="address" rows="5"
                                              class="ckeditor-text form-control @error('address') is-invalid @enderror"
                                              name="address[{{ $locale->code }}]"
                                              placeholder="{{ __('address -').$locale->name }}">{{ old('') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="job_date">Job Date</label>
                                <div class="col-sm-9">

                                <input id="job_date" type="text"
                                       class="form-control @error('job_date') is-invalid @enderror"
                                       name="job_date" value="{{ old('job_date') }}"
                                       placeholder="{{ __('Job Date') }}">
                                @error('job_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                                <div class="col-sm-9">
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}"
                                       placeholder="{{ __('Phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>




                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="map_link">Map Link</label>
                                <div class="col-sm-9">

                                <input id="map_link" type="text"
                                       class="form-control @error('map_link') is-invalid @enderror"
                                       name="map_link" value="{{ old('map_link') }}"
                                       placeholder="{{ __('Map Link') }}">
                                @error('map_link')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="image">Image</label>
                                <div class="col-sm-9">

                                <input id="question" type="file" class="form-control @error('image') is-invalid @enderror"
                                       name="image"
                                       placeholder="{{ __('Image -') }}">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@push('scripts')

    <script>

            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
            $('.ckeditor-text').ckeditor(options);

      @foreach ($locales as $key=>$locale)
            let selectorTitle{{$locale->code}}="title[{{$locale->code}}]";
            $('[name="'+ selectorTitle{{$locale->code}} +'"]').keyup(function(e)
            {
                const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;=!`~\"\'@%'
                const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnooooooooprrsssssttuuuuuuuuuwxyyzzz----------------'
                const p = new RegExp(a.split('').join('|'), 'g')
                let val = $(this).val();
                val = val.toLowerCase().
                replace(/ /g,'-').
                replace(/\.+/g,'-').
                replace(/ı/g,'i').
                replace(/[-]+/g, '-').
                replace(/ğ/g,'g').
                replace(/\$/g,'-').
                replace(/ç/g,'c').
                replace(/\^/g,'-').
                replace(/\*/g,'-').
                replace(/\(/g,'-').
                replace(/\)/g,'-').
                replace(/{/g,'-').
                replace(/}/g,'-').
                replace(/\?/g,'-').
                replace(/\[/g,'-').
                replace(/\]/g,'-').
                replace(/\\/g,'-').
                replace(/ü/g,'u').
                replace(/ö/g,'o').
                replace(/ş/g,'s').
                replace(/ə/g,'e').
                replace(/\s+/g, '-').                                          // Replace spaces with -
                replace(p, c => b.charAt(a.indexOf(c))).                       // Replace special characters
                replace(/&/g, '-').
                {{-- @if($locale->code <> 'ru')  replace(/[^\w\-]+/g, ''). @endif    // Remove all non-word characters--}}
                replace(/\-\-+/g, '-').                                        // Replace multiple - with single -
                replace(/^-+/, '').                                            // Trim - from start of text
                replace(/-+$/, '');                                            // Trim - from end of text;
                let selectorSlug{{$locale->code}}="slug[{{$locale->code}}]";
                $('[name="'+ selectorSlug{{$locale->code}} +'"]').val(val);
            });
        @endforeach


    </script>
@endpush
