@extends('admin.layout')
@section('title', 'Create Article')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Create Article</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
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

                                <div class="form-group">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title[{{ $locale->code }}]" value="{{ old('') }}"
                                           placeholder="{{ __('Title -').$locale->name }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">

                                    <input id="slug" type="text"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           name="slug[{{ $locale->code }}]" value="{{ old('') }}"
                                           placeholder="{{ __('Slug -').$locale->name }}">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">

                                    <input id="subtitle" type="text"
                                           class="form-control @error('subtitle') is-invalid @enderror"
                                           name="subtitle[{{ $locale->code }}]" value="{{ old('') }}"
                                           placeholder="{{ __('Subtitle -').$locale->name }}">
                                    @error('subtitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <textarea id="text" rows="5"
                                              class="ckeditor-text form-control @error('text') is-invalid @enderror"
                                              name="text[{{ $locale->code }}]"
                                              placeholder="{{ __('Text -').$locale->name }}">{{ old('answer') }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach


                        <div class="form-group">
                            <input id="question" type="file" class="form-control @error('image') is-invalid @enderror"
                                   name="image"
                                   placeholder="{{ __('Image -') }}">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" value="1" name="is_active" class="form-check-input"
                                       id="exampleCheck1" {{ old('is_active') ? 'checked' : '' }}>
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
