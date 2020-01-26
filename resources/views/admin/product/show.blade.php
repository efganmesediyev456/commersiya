@extends("admin.layout")
@section('title', 'Article')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">{{$article->question}}</h6>
            <a href="{{ route('article.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                 All faqs</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
{{--                    <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>Question</th>--}}
{{--                        <th>Answer</th>--}}
{{--                        <th>Is active</th>--}}
{{--                        <th>Created at</th>--}}
{{--                        <th>Updated at</th>--}}
{{--                        <th>Operations</th>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>#</th>
                        <td>{{$article->id}}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{$article->title}}</td>
                    </tr>

                    <tr>
                        <th>Subtitle</th>
                        <td>{{$article->subtitle}}</td>
                    </tr>

                    <tr>
                        <th>Image</th>
                        <td><img style="width: 100%;" src="{{ asset('uploads/article').'/'.$article->image }}" ></td>
                    </tr>
                    <tr>
                        <th>Text</th>
                        <td>{!! $article->text !!}</td>
                    </tr>
                    <tr>
                        <th>Is active</th>
                        <td>
                            @if($article->is_active)
                                Active
                                @else
                                Deactive
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$article->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$article->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('article.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('article.edit', $article->id) }}">
                                    <i class="far fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection()
