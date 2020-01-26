@extends("admin.layout")
@section('title', 'Subscriptions')
@section('content')
    <style>
        td, tr, th {
            text-align: center;
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="get">
                <input type="hidden" name="filter" value="1">
                <div class="form-row">
                    <div class="form-group col-md-2 ">
                        <label for="to" class="col-sm-12">From</label>
                        <div class="col-sm-9">
                            <input type="text" id="from" name="to[]" class="subscription_date form-control"
                                   autocomplete="off"
                                   @if(request()->to[0]) value=" {{ request()->to[0] }} " @endif placeholder="From Date">
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
                    <div class="form-group col-md-2 ">
                        <label for="inputEmail3" class="col-sm-12">Payment Status</label>
                        <div class="col-sm-9">
                            <select name="payment_status" class="form-control">
                                <option value="">Choose</option>
                                <option @if(request()->payment_status!='' and  request()->payment_status==0) selected
                                        @endif value="0">Not Paid
                                </option>
                                <option @if(request()->payment_status!='' and request()->payment_status==1) selected
                                        @endif value="1">Paid
                                </option>
                            </select>
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
                        <label for="inputEmail3" class="col-sm-12">Tariff</label>
                        <div class="col-sm-9">
                            <select name="tariff_id" class="form-control">
                                <option value="">Choose</option>
                                @foreach($tariff as $t)
                                    <option @if( request()->tariff_id and $t->id==request()->tariff_id)  selected
                                            @endif value="{{ $t->id }}"> {{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="inputEmail3" class="col-sm-12">Device</label>
                        <div class="col-sm-9 col-md-12">
                            <select name="device" class="form-control ">
                                <option value="">Sec</option>
                                <option @if(request()->device!='' and  request()->device==0) selected @endif value="0">
                                    TV, Smartphone
                                </option>
                                <option @if(request()->device!='' and request()->device==1) selected @endif  value="1">
                                    MAG devices
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
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
                        <th>User</th>
                        <th>Tariff id</th>
                        <th>Payment status</th>
                        <th>Status</th>
                        <th>Device</th>
                        <th>Account Number</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Tariff id</th>
                        <th>Payment status</th>
                        <th>Status</th>
                        <th>Device</th>
                        <th>Account Number</th>
                        <th>Created at</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($subscriptions as $k=>$sub)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $sub->user->name }}</td>
                            <td>{{ $sub->tariff->name }}</td>
                            <td>
                                @if($sub->payment_status)
                                    Paid
                                @else
                                    Not paid
                                @endif
                            </td>
                            <td>
                                @if($sub->status)
                                    Active
                                @else
                                    Deactive
                                @endif
                            </td>
                            <td>
                                @if($sub->device)
                                    MAG devices
                                @else
                                    TV, Smartphones
                                @endif
                            </td>
                            <td>{{ $sub->account_number }}</td>
                            <td class="created">{{ $sub->created_at->format('m/d/Y') }}</td>
                            <td>
                                <form id="delete-form" action="{{ route('service.destroy', $sub->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('subscription.show', $sub->id)}}"
                                       class="btn btn-primary btn-circle btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i>
                                    </button>
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

@push('scripts')
    <script>
        $(function () {
            $('.subscription_date').datepicker();
        });
    </script>
@endpush