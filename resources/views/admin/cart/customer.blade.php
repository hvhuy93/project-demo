@extends('admin.main')

@section('contents')
<table class="table table-hover">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Date Order</th>
        <th>&nbsp;&nbsp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{$customer->created_at}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{route('cart.view',$customer->id)}}">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm"
                   onclick="removeRow({{$customer->id}}, '/fashion/admin/product/destroy')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
{!! $customers->links() !!}
@endsection

