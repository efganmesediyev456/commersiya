@extends("admin.layout")
@section('title', 'Period')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">{{$period->question}}</h6>
            <a href="{{ route('period.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                 All Periods</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <tr>
                        <th>#</th>
                        <td>{{$period->id}}</td>
                    </tr>
                    <tr>
                        <th>Month</th>
                        <td>{{$period->month}}</td>
                    </tr>


                    <tr>
                        <th>Type</th>
                        <td>{!! $period->type !!}</td>
                    </tr>

                    <tr>
                        <th>Discount</th>
                        <td>{{$period->discount}}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{$period->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{$period->updated_at}}</td>
                    </tr>
                    <tr>
                        <th>Operations</th>
                        <td>
                            <form id="delete-form" action="{{ route('period.destroy', $period->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary btn-circle btn-sm" href="{{ route('period.edit', $period->id) }}">
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
