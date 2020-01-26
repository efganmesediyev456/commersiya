@extends("admin.layout")
@section('title', 'License')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('license.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                All license</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$license->id}}</td>
                    </tr>

                    <tr>
                        <th>User</th>
                        <td>
                            @if($license->user_id !==0)
                                {{$license->user->id}} - {{$license->user->name}}
                                @endif
                        </td>
                    </tr>

                    <tr>
                        <th>License</th>
                        <td>{{$license->license}}</td>
                    </tr>
                    <tr>
                        <th>Created by</th>
                        <td>{{$license->created_by}}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($license->status)
                                Unavailable
                            @else
                                Available
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Is active</th>
                        <td>
                            @if($license->is_active)
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Subscribe</th>
                        <td>
                            {{$license->subscribe_id}}
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$license->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$license->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('license.destroy', $license->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection()

