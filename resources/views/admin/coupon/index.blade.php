@extends("admin.layout")
@section('title', 'Coupon')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Coupons table</h6>
            <a href="{{ route('coupon.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50" id="add"></i> Add new</a>
        </div>
        <div class="card-body">

            <form action="" method="get">
                <input type="hidden" name="filter" value="1">
                <div class="form-row">
                    <div class="col-md-3">
                        <input type="text" id="coupon" name="coupon" class="form-control"
                               autocomplete="off"
                               @if(request()->coupon) value=" {{ request()->coupon }} " style="float: left;" @endif placeholder="Coupon Name">
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-success" style="margin-right: 100px; float: left" value="Search">
                    </div>
                </div>
            </form>

            <div class="table-responsive">



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Coupon Id</th>
                        <th>Subscription</th>
                        <th>User</th>
                        <th>Coupon</th>
                        <th>Is Active</th>
                        <th>Status</th>
                        <th>Period</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Coupon Id</th>
                        <th>Subscription</th>
                        <th>User</th>
                        <th>Coupon</th>
                        <th>Is Active</th>
                        <th>Status</th>
                        <th>Period</th>
                        <th>Created at</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($coupons as $key=>$coupon)

                        <tr>
                            <td>{{ ($key+1)+(request()->page-1)*$per_page }}</td>
                            <td>{{ $coupon->id }}</td>
                            <td>
                                @if($coupon->user_id)
                                    <a id="{{ $coupon->subscription_id }}" data-toggle="modal"
                                       data-target=".bd-example-modal-lg" class="coupon-subscription"
                                       href="#">
                                        {{$coupon->subscription_id}}
                                        @if($coupon->subscription_id)
{{--                                                {{$coupon->subscription->account_number}}--}}
                                        @endif
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($coupon->user_id)
                                    <a id="{{ $coupon->user->id }}" data-toggle="modal"
                                       data-target=".bd-example-modal-lg-2" class="a_modal"
                                       href="#"> {{$coupon->user->name}} - {{$coupon->user->id}}</a>
                                @endif
                            </td>
                            <td>{{ $coupon->coupon }}</td>
                            <td>
                                @if($coupon->is_active)
                                    Active
                                @else
                                    No Active
                                @endif
                            </td>
                            <td>
                                @if($coupon->status)
                                    Used
                                @else
                                    Not Used
                                @endif
                            </td>
                            <td>
                                @if($coupon->period_id)
                                    {{$coupon->period->month}} Months
                                @else
                                    1 week
                                 @endif
                            </td>
                            <td>{{ $coupon->created_at->format('d-M-Y') }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div style="" class="float-right">
                    {{ $coupons->appends( request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service</h5>
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


    {{--modal user ucun scriptionslari cixartmaq ucun--}}


    <!-- Large modal -->


    <div class="modal fade bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subscriptions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body2" style="max-width: 1000px;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

    <script>
        $(function () {

            $('.dataTable').dataTable({
                // "order": [[4, "desc"]],
                "ordering": true,
                "bDestroy": true,
                "bPaginate": false,
                "info": false,
                "searching": false
            });

            $('body').on('click', '.coupon-subscription', function () {
                var id = $(this).attr('id');

                $("#modal_body").html('');
                $.ajax({
                    'url': '{{route('admin.coupon.services')}}',
                    'data': {'_token': '{{csrf_token()}}', 'id': id},
                    'type': 'post',
                    'success': function (e) {

                        $("#modal_body").html(e);

                    }
                })

            });




                 $('body').on('click', '.a_modal', function () {
                    var id = $(this).attr('id');

                    $("#modal_body2").html('');
                    $.ajax({
                        'url': '{{route('admin.modal')}}',
                        'data': {'_token': '{{csrf_token()}}', 'id': id},
                        'type': 'post',
                        'success': function (e) {

                            $("#modal_body2").html(e);

                        }
                    })
                });




        })
    </script>


@endpush
