@extends("admin.layout")
@section('title', 'Admin-Users')
@section('content')

    <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary">Admins and BE users</h6>
                <a href="{{ route('admin-be.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus text-white-50"></i> Add new user</a>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>

                            <td>{{$user->email}}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                            @if($user->status == 1)
                                <form id="delete-form" action="{{ route('admin-be.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{--                                    <a href="{{route('user.show',$user->id)}}" class="btn btn-primary btn-circle btn-sm">--}}
                                    {{--                                        <i class="far fa-eye"></i>--}}
                                    {{--                                    </a>--}}
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{route('admin-be.edit',$user->id)}}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
