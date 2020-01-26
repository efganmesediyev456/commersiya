@extends("admin.layout")
@section('title', 'Payment')
@section('content')
    <div class="card shadow mb-4">
{{--        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">--}}
{{--            <h6 class="m-0 font-weight-bold text-primary">{{$contact->question}}</h6>--}}
{{--            <a href="{{ route('faq.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">--}}
{{--                 All faqs</a>--}}
{{--        </div>--}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <td>{{$contact->id}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$contact->name}}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{!! $contact->message !!}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$contact->phone}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$contact->email}}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$contact->created_at}}</td>
                    </tr>

                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('contact.destroy', $contact->id) }}" method="POST">
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
