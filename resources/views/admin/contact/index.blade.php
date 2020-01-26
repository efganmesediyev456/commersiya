@extends("admin.layout")
@section('title', 'Contact')
@section('content')

    <div class="card shadow mb-4">
{{--        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">--}}
{{--            <h6 class="m-0 font-weight-bold text-primary">Faq table</h6>--}}
{{--            <a href="{{ route('contact.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">--}}
{{--                <i class="fas fa-plus text-white-50"></i> Add new</a>--}}
{{--        </div>--}}


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{route('contact.show',$contact->id)}}" class="btn btn-primary btn-circle btn-sm">
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
