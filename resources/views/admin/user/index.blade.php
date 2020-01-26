@extends("admin.layout")
@section('title', 'Users')
@section('content')

    <div class="card shadow mb-4">


        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Users table</h6>
            <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50" id="add"></i> Add New User</a>
        </div>


        <div class="card-body">

            <form action="" method="get">
                <input type="hidden" name="filter" value="1">
                <div class="form-row">
                    <div class="form-group col-md-2 ">
                        <label for="from" class="col-sm-12">From</label>
                        <div class="col-sm-9">
                            <input type="text" id="from" name="to[]" class="subscription_date form-control"
                                   autocomplete="off"
                                   @if(request()->to[0]) value=" {{ request()->to[0] }} "
                                   @endif placeholder="From Date">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="to" class="col-sm-12">To</label>
                        <div class="col-sm-9">
                            <input type="text" name="to[]" id="to" class="subscription_date form-control"
                                   autocomplete="off"
                                   @if(request()->to[1]) value=" {{ request()->to[1] }}" @endif  placeholder="To Date">
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputEmail3" class="col-sm-12">Status</label>
                        <div class="col-md-10 col-sm-9">
                            <select name="status" class="form-control">
                                <option value="">Choose</option>
                                <option @if(request()->status!='' and  request()->status==0) selected @endif value="0">
                                    Deactive
                                </option>
                                <option @if(request()->status!='' and request()->status==1) selected @endif  value="1">
                                    Active
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <div class="col-sm-9 col-md-12" style="margin-top: 30px;">
                            <input type="submit" class="btn btn-success" style="margin-right: 100px;" value="Search">
                        </div>
                    </div>


                </div>


            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Account Number</th>
                        <th>Ip Address</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Account Number</th>
                        <th>Ip Address</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a id="{{ $user->id }}" class="a_modal" href="#" data-toggle="modal"
                                   data-target=".bd-example-modal-lg">{{ $user->name }}</a></td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(isset($user->phone))
                                    {{ $user->phone }}
                                @else
                                    <span class="text-danger">Yoxdur</span>
                                @endif
                            </td>

                            <td>{{$user->account_number}}</td>
                            <td>{{$user->ip_address}}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>

                                @role('super-admin')
                                @if(!$user->hasRole('super-admin'))
                                    <form style="display: inline-block;" id="delete-form"
                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i>
                                        </button>

                                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    </form>
                                @endif
                                @endrole


                                @role('admin')
                                @if(!$user->hasRole('super-admin') and !$user->hasRole('admin'))
                                    <form style="display: inline-block;" id="delete-form"
                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i>

                                        </button>
                                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    </form>
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



    {{--modal user ucun scriptionslari cixartmaq ucun--}}


    <!-- Large modal -->


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subscriptions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body" style="max-width: 1000px;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>





    @push('scripts')
        <script>
            $(function () {
                $('body').on('click', '.a_modal', function () {
                    var id = $(this).attr('id');

                    $("#modal_body").html('');
                    $.ajax({
                        'url': '{{route('admin.modal')}}',
                        'data': {'_token': '{{csrf_token()}}', 'id': id},
                        'type': 'post',
                        'success': function (e) {

                            $("#modal_body").html(e);

                        }
                    })

                });
                $('.subscription_date').datepicker();
            })
        </script>
    @endpush
@endsection
