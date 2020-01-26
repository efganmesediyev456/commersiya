{!! '<'.'?xml version="1.0"?>' !!}
<response>
    <result>@if($status) 0 @else 1 @endif</result>
    <osmp_txn_id>{{$txn_id}}</osmp_txn_id>
    <comment>@if($status) OK @else Not found @endif</comment>
</response>
