@extends('admin.layout')
@section('title', 'Packages')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Package table</h6>
            <a href="{{ route('package.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Ministra id</th>
                        <th>Created at</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Ministra id</th>
                        <th>Created at</th>
                        <th>Is active</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($packages as $package)
                        <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->price }}</td>
                        <td>
                            @foreach($ministras as $min_package)
                                @if($package->ministra_id == $min_package->id)
                                    {{$min_package->name}}
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $package->created_at }}</td>
                        <td class="activate" data-id="{{$package->id}}">
                            @if($package->is_active)
                                <button class="btn btn-outline-danger w-100">Deactivate</button>
                            @else
                                <button class="btn btn-outline-success w-100">Activate</button>
                            @endif
                        </td>
                        <td>
                            <form id="delete-form" action="{{ route('package.destroy', $package->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('package.edit', $package->id) }}">
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
                url:'package/activate',
                success:function(data){
                    location.reload();
                }
            })
        });
        });

    </script>


    @endpush
