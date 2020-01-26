@extends("admin.layout")
@section('title', 'Products')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Products table</h6>
            <a href="{{ route('product.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>

                        <th>Quantity</th>
                        <th>Details</th>
                        <th>Operations</th>
                        
            
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>

                        <th>Quantity</th>
                        <th>Details</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($products as $article)

                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->name }}</td>
                            <td><img src="{{ asset('uploads/products/'.$article->image) }}" style="height: 100px; width: 100px;"> </td>
                            <td>{{ $article->price }}</td>
                            <td>{{ $article->quantity }}</td>
{{--                            <td> {{ mb_substr( $article->details,0,100,'utf-8') }} @if(strlen($article->text)>100) ... @endif </td>--}}
                            <td>{{ $article->details }}</td>
                            
                            <td>

                                <form id="delete-form" action="{{ route('article.destroy', $article->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-circle btn-sm" href="{{ route('article.edit', $article->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{route('article.show',$article->id)}}" class="btn btn-primary btn-circle btn-sm">
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

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.activate').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $(this).data('id');
                $.ajax({
                    type:"POST",
                    data: { 'id' : id  },
                    url:'article/activate',
                    success:function(data){
                        location.reload();
                    }
                })
            });
        });

    </script>


@endpush
