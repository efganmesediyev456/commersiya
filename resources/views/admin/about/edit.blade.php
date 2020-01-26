@extends("admin.layout")
@section('title', 'About')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form class="user" method="POST" action="{{ route('about.update', $about->id) }}">
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
                                    <textarea id="content" rows="5" class="form-control textarea @error('content') is-invalid @enderror"
                                              name="content[{{ $locale->code }}]"
                                              placeholder="{{ __('Content -').$locale->name }}">{{ $about->getTranslation('content', $locale->code) }}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Edit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection()


@push('scripts')
    <script>
        $(function () {

            $('.textarea').ckeditor(
                {
                    filebrowserBrowseUrl : '{{asset('kcfinder/browse.php?opener=ckeditor&type=files')}}',
                    filebrowserImageBrowseUrl : '{{asset('kcfinder/browse.php?opener=ckeditor&type=images')}}',
                    filebrowserFlashBrowseUrl : '{{asset('kcfinder/browse.php?opener=ckeditor&type=flash')}}',
                    filebrowserUploadUrl : '{{asset('kcfinder/upload.php?opener=ckeditor&type=files')}}',
                    filebrowserImageUploadUrl : '{{asset('kcfinder/upload.php?opener=ckeditor&type=images')}}',
                    filebrowserFlashUploadUrl : '{{asset('kcfinder/upload.php?opener=ckeditor&type=flash')}}',
                });
        })

    </script>
@endpush