@extends("admin.layout")
@section('title', 'Roles')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Roles table</h6>

        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($user_roles as $k=>$cc)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td> @if( isset( \App\User::find($cc->model_id)->name )) {{ \App\User::find($cc->model_id)->name }}  @endif  </td>
                            <td>{{ \Spatie\Permission\Models\Role::find($cc->role_id)->name  }}</td>
                            <td>
                                <a href="{{route('roles.show',$cc->role_id)}}"
                                   class="btn btn-primary btn-circle btn-sm">
                                    <i class="far fa-eye"></i>
                                </a>

                                @role('super-admin')
                                @if(\Spatie\Permission\Models\Role::find($cc->role_id)->name!='super-admin')
                                    <a class="btn btn-primary btn-circle btn-sm"
                                       href="{{ route('user_roles.edit',['role_id'=> $cc->role_id,'user_id'=>$cc->model_id]) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endif
                                @endrole

                                @role('admin')
                                @if(\Spatie\Permission\Models\Role::find($cc->role_id)->name!='super-admin' and \Spatie\Permission\Models\Role::find($cc->role_id)->name!='admin')
                                    <a class="btn btn-primary btn-circle btn-sm"
                                       href="{{ route('user_roles.edit',['role_id'=> $cc->role_id,'user_id'=>$cc->model_id]) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endif
                                @endrole
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
