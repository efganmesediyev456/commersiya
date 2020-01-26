@extends("admin.layout")
@section('title', 'Tariffs')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Tariffs table</h6>
            <a href="{{ route('tariff.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Ministra id</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Detail</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Ministra id</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Detail</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($tariffs as $tarif)
                        <tr>
                            <td>{{ $tarif->id }}</td>
                            <td>{{$tarif->name}}</td>
                            <td>{{$tarif->ministra_id}}</td>
                            <td>
                                @if($tarif->type)
                                    Custom
                                @else
                                    Full
                                @endif
                            </td>
                            <td>{{$tarif->price}}</td>
                            <td>{{$tarif->detail}}</td>
                            <td>{{$tarif->created_at}}</td>
                            <td>{{$tarif->updated_at}}</td>
                            <td>
                                <form id="delete-form" action="{{ route('tariff.destroy', $tarif->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('tariff.show',$tarif->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('tariff.edit', $tarif->id) }}">
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
