@extends('admin.main')

@section('contents')
@section('add')
    <a class="btn btn-primary" href="{{route('product.create')}}">Add new</a>
@endsection
<table class="table table-hover">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Category</th>
        <th>Price</th>
        <th>Sale Price</th>
        <th>Active</th>
        <th>Update</th>
        <th>&nbsp;&nbsp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>
            <a href="{{$product->thumb}}" target="_blank">
                <img src="{{$product->thumb}}" width="70px">
            </a>

        </td>
        <td>{{ $product->menu->name }}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->price_sale}}</td>
        <td>{!!  \App\Http\Helpers\Helper::active($product->active)!!}</td>
        <td>{{$product->updated_at}}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{route('product.edit',$product->id)}}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm"
               onclick="removeRow({{$product->id}}, '/fashion/admin/product/destroy')">
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
    </tbody>
    @endforeach
</table>
        {!! $products->links() !!}
@endsection

