@extends("admin.layout")
@section('title', 'Services')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Login</th>
                        <th>License</th>
                        <th>Account Number</th>
                        <th>Password</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Login</th>
                        <th>License</th>
                        <th>Account Number</th>
                        <th>Password</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->login }}</td>
                            <td>{{ $service->license }}</td>
                            <td>{{$service->account_number}}</td>
                            <td>{{$service->password}}</td>
                            <td>{{ $service->created_at }}</td>
                            <td>{{ $service->updated_at }}</td>

                            <td>

                                <form id="delete-form" action="{{ route('service.destroy', $service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{route('service.show',$service->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('service.edit', $service->id) }}">
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
