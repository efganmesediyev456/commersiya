@extends("admin.layout")
@section('title', 'Promocode')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Promocode table</h6>
            <a href="{{ route('promocode.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Discount</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Deadline</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Discount</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Deadline</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($promocodes as $promocode)

                        <tr>
                            <td>{{ $promocode->id }}</td>
                            <td>{{ $promocode->code }}</td>
                            <td>
                                @if($promocode->status)
                                        Used
                                @else
                                        Not used
                                 @endif
                            </td>
                            <td>{{ $promocode->discount }}</td>
                            <td>{{ $promocode->created_at->format('Y-m-d') }}</td>
                            <td>{{ $promocode->updated_at->format("Y-m-d") }}</td>
                            <td>{{$promocode->deadline}}</td>
                            <td class="activate" data-id="{{$promocode->id}}">
                                @if($promocode->is_active)
                                    <button class="btn btn-outline-danger w-100 ">Deactivate</button>
                                @else
                                    <button class="btn btn-outline-success w-100">Activate</button>
                                @endif
                            </td>
                            <td>

                                <form id="delete-form" action="{{ route('promocode.destroy', $promocode->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('promocode.edit', $promocode->id) }}">
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
                    url:'promocode/activate',
                    success:function(data){
                        location.reload();
                    }
                })
            });
        });

    </script>


@endpush
