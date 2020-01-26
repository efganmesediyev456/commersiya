@extends("admin.layout")
@section('title', 'Payment')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Payments table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Subscription</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Subscription</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->subscription_id }}</td>
                            <td>{{$payment->user->name}}</td>
                            <td>
                                @if($payment->type == 1)
                                    BE payment
                                @else
                                    {{$payment->type}}
                                @endif
                            </td>
                            <td>
                                @if($payment->status)
                                    Unavailable
                                @else
                                    Available
                                @endif
                            </td>
                            <td>{{$payment->paid_at}}</td>
                            <td>{{ $payment->created_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('payment.show',$payment->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
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
