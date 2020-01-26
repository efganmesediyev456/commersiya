@extends("admin.layout")
@section('title', 'Payment')
@section('content')
    <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                    <a href="{{ route('payment.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                         All payments</a>
                </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$payment->id}}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{$payment->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Subscription</th>
                        <td>{!! $payment->subscription_id !!}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>
                            @if($payment->type == 1)
                                BE payment
                            @else
                            {{$payment->type}}
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th>Amount</th>
                        <td>{{$payment->amount}}</td>
                    </tr>

                    <tr>
                        <th>Payment details</th>
                        <td>{{$payment->payment_details}}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($payment->status)
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Paid</th>
                        <td>{{$payment->paid_at}}</td>
                    </tr>

                    <tr>
                        <th>Created</th>
                        <td>{{$payment->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$payment->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('payment.destroy', $payment->id) }}" method="POST">
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
