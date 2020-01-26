@extends("admin.layout")
@section('title', 'About')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">About table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Content</th>
                        <th>Key</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Content</th>
                        <th>Key</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($abouts as $about)
                        <tr>
                            <td>{{$about->id}}</td>
                            <td>{!! $about->content !!}</td>
                            <td>{{$about->key}}</td>
                            <td>
{{--                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('about.edit', $about->id) }}">--}}
{{--                                        <i class="far fa-edit"></i>--}}
{{--                                    </a>--}}

                                <form id="delete-form" action="{{ route('about.destroy', $about->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('about.edit', $about->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection()
