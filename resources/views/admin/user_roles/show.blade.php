@extends("admin.layout")
@section('title', 'Role')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Show {{ strtoupper($role->name) }} Role</h6>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">





                    <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills" role="tabpanel" aria-labelledby="pills-tab">


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="password" type="text" class="form-control " value="{{$role->name}}"  readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Guard Name</label>
                                <div class="col-sm-9">
                                    <input id="login" type="text" class="form-control"  value="{{$role->guard_name}}"  readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Created At</label>
                                <div class="col-sm-9">
                                    <input id="account_number" type="text" class="form-control" value="{{$role->created_at}}"  readonly>
                                </div>
                            </div>





                        </div>

                    </div>

        </div>
    </div>


@endsection()
