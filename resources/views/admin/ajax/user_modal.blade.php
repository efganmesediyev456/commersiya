<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">Subscription Id</th>
        <th scope="col">User</th>
        <th scope="col">Tariff</th>
        <th scope="col">Payment Status</th>
        <th scope="col">Account Number</th>
    </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
           <td>{{$order->id}}</td>
          <td> @if(isset($order->user->name)) {{$order->user->name}} @endif</td>
          <td> @if(isset($order->tariff->name)) {{$order->tariff->name}}  @endif</td>
          <td>
              @if($order->payment_status)
                  Paid
              @else
                  Not paid
              @endif
          </td>
          <td>{{$order->account_number}}</td>
            </tr>
        @endforeach
    </tbody>
</table>