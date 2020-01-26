@extends("be.layout")
@section('title', 'Customer')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
        <a href="{{ route('be.customers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus text-white-50"></i> Add new</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account Number</th>
                    <th>Created at</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account Number</th>
                    <th>Created at</th>
                    <th>Operations</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->account_number}}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="#" data-id="{{ $user->id }}" class="d-none customer-detail d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                           data-toggle="modal" data-target="#customerDetailModal">
                            <i class="fas fa-eye fa-sm text-white-50"></i>
                            View details</a>
                        <a id="{{ $user->id }}" href="javascript:void(0)"  class="d-none print d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Print</a>

                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="customerDetailModal" tabindex="-1" role="dialog" aria-labelledby="customerDetailModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

</script>






@endsection
@push('scripts')
    <script>
        $(function () {
            $('.customer-detail').click(function () {
                var id=$(this).data('id');

                $("#modal_body").html('');
                $.ajax({
                    'url':'{{route('be.customers.detail')}}',
                    'data':{'_token':'{{ csrf_token() }}', 'id':id},
                    'type':'post',
                    'success':function (e) {

                        $("#modal_body").html(e);

                    }
                })

            });

            $("body").on('click','.print',function(){

                $.ajax({
                    'url':'{{route('be.customers.print')}}',
                    'data':{'_token':'{{ csrf_token() }}'},
                    'type':'post',
                    'success':function (e) {
                        var printContents = e;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                    }
                });
            })
        })
    </script>
@endpush
