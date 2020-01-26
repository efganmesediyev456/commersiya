@extends("admin.layout")
@section('title', 'Payment Methods')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">{{$payment_method->name}}</h6>
            <a href="{{ route('payment_methods.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                 All faqs</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
{{--                    <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>Question</th>--}}
{{--                        <th>Answer</th>--}}
{{--                        <th>Is active</th>--}}
{{--                        <th>Created at</th>--}}
{{--                        <th>Updated at</th>--}}
{{--                        <th>Operations</th>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>#</th>
                        <td>{{ $payment_method->id }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{!! $payment_method->address !!} </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{!! $payment_method->name !!} </td>
                    </tr>
                    <tr>
                        <th>Job Date</th>
                        <td>{!! $payment_method->job_date !!} </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$payment_method->phone}}</td>
                    </tr>

                    <tr>
                        <th>Map Link</th>
                        <td>{{$payment_method->map_link}}</td>
                    </tr>

                    <tr>
                        <th>Image</th>
                        <td><img style="width: 100%;" src="{{ asset('uploads/payment_methods').'/'.$payment_method->image }}" ></td>
                    </tr>

                    <tr>
                        <th>Created</th>
                        <td>{{$payment_method->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$payment_method->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('payment_methods.destroy', $payment_method->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('payment_methods.edit', $payment_method->id) }}">
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
