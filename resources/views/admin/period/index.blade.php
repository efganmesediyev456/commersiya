@extends("admin.layout")
@section('title', 'Period')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Period table</h6>
            <a href="{{ route('period.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    @if(session()->has('success'))
                        <div class="alert-success alert">{{session()->get('success')}}</div>
                        @endif

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Type</th>
                        <th>Discount</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Type</th>
                        <th>Discount</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($periods as $period)
                        <tr>
                            <td>{{ $period->id }}</td>
                            <td>{{ $period->month }} months</td>
                            <td>{{ $period->type }}</td>
                            <td> {{ $period->discount }} percent</td>
                            <td>{{ $period->created_at }}</td>
                            <td>{{ $period->updated_at }}</td>
                            <td>

                                <form id="delete-form" action="{{ route('period.destroy', $period->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('period.edit', $period->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{route('period.show',$period->id)}}" class="btn btn-primary btn-circle btn-sm">
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
