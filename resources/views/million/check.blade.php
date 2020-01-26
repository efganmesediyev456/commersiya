{!! '<'.'?xml version="1.0"?>' !!}

<response>
    <osmp_txn_id>{{ $osmp_txn_id }}</osmp_txn_id>
    <result>@if($check) 0 @else 1 @endif</result>
    <comment>@if($check) OK @else NOT OK @endif</comment>
    <addinfo>@if($user) {{$user->name}} @endif</addinfo>
</response>
