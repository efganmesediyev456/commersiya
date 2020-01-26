<table class="table table-bordered">
    <thead>
    <tr>
        <th>Service Id</th>
        <th scope="col">Password</th>
        <th scope="col">Login</th>
        <th scope="col">License</th>
    </tr>
    </thead>
    <tbody>
    <tr>
           <td>{{$service->id}}</td>
           <td>{{$service->password}}</td>
           <td>{{$service->login}}</td>
           <td>{{$service->license}}</td>
    </tr>
    </tbody>
</table>