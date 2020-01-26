@extends("admin.layout")
@section('title', 'Faq')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">{{$content->title}}</h6>
            <a href="{{ route('content.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                 All faqs</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$content->id}}</td>
                    </tr>

                    <tr>
                        <th>Icon</th>
                        <td>{{$content->icon}}</td>
                    </tr>

                    <tr>
                        <th>Title</th>
                        <td>{{$content->title}}</td>
                    </tr>


                    <tr>
                        <th>Text</th>
                        <td>{!! $content->text !!}</td>
                    </tr>
                    <tr>
                        <th>Is active</th>
                        <td>
                            @if($content->is_active)
                                Active
                                @else
                                Deactive
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$content->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$content->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('content.destroy', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('content.edit', $content->id) }}">
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
