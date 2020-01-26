@extends("admin.layout")
@section('title', 'Tariff')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('tariff.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                All Tariffs</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$tariff->id}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$tariff->name}}</td>
                    </tr>
                    <tr>
                        <th>Ministra</th>
                        <td>{{$tariff->ministra_id}}</td>
                    </tr>
                    <tr>
                        <th>Is active</th>
                        <td>
                            @if($tariff->is_active)
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Type</th>
                        <td>
                            @if($tariff->type)
                                Custom
                            @else
                                Full
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Price</th>
                        <td>{{$tariff->price}}</td>
                    </tr>

                    <tr>
                        <th>Detail</th>
                        <td>{{$tariff->detail}}</td>
                    </tr>

                    <tr>
                        <th>Icon</th>
                        <td>{{$tariff->icon}}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$tariff->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$tariff->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('tariff.destroy', $tariff->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('tariff.edit', $tariff->id) }}">
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
