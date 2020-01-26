@extends("admin.layout")
@section('title', 'Content')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Content table</h6>
            <a href="{{ route('content.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add content</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($contents as $content)
                        <tr>
                            <td>{{ $content->id }}</td>
                            <td>{{ $content->icon }}</td>
                            <td>{{$content->title}}</td>
                            <td>{{ $content->created_at }}</td>
                            <td>{{ $content->updated_at }}</td>
                            <td class="activate" data-id="{{$content->id}}">
                                @if($content->is_active)
                                    <button class="btn btn-outline-danger w-100 ">Deactivate</button>
                                @else
                                    <button class="btn btn-outline-success w-100">Activate</button>
                                @endif
                            </td>
                            <td>

                                <form id="delete-form" action="{{ route('content.destroy', $content->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('content.edit', $content->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{route('content.show',$content->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
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

@endsection


@push('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.activate').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $(this).data('id');
                $.ajax({
                    type:"POST",
                    data: { 'id' : id  },
                    url:'content/activate',
                    success:function(data){
                        location.reload();
                    }
                })
            });
        });

    </script>


@endpush
