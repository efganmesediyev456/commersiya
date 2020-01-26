@extends("admin.layout")
@section('title', 'Payment Methods')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Payment Methods table</h6>
            <a href="{{ route('payment_methods.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone</th>

                        <th>Image</th>
                        <th>Map Link</th>

                        <th>Operations</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone</th>

                        <td>Image</td>
                        <th>Map Link</th>

                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($payment_methods as $payment_method)

                        <tr>
                            <td>{{ $payment_method->id }}</td>
                            <td> {{ mb_substr( $payment_method->address,0,50,'utf-8') }} @if(strlen($payment_method->address)>50) ... @endif </td>
                            <td>{{ $payment_method->name }}</td>
                            <td>{{ $payment_method->phone }}</td>

                            <td><img style="width: 100px; height: 100px;" src="{{ asset('uploads/payment_methods').'/'.$payment_method->image }}"></td>
                            <td> {{ mb_substr( $payment_method->map_link,0,20,'utf-8') }} @if(strlen($payment_method->map_link)>20) ... @endif </td>

                            <td>
                                <form id="delete-form" action="{{ route('payment_methods.destroy', $payment_method->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('payment_methods.edit', $payment_method->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{route('payment_methods.show',$payment_method->id)}}" class="btn btn-primary btn-circle btn-sm">
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

@endsection


