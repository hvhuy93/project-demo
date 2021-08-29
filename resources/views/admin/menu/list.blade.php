@extends('admin.main')

@section('contents')
@section('add')
    <a class="btn btn-primary" href="{{route('category.create')}}">Add new</a>
@endsection
<table class="table table-hover">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Active</th>
        <th>Update</th>
        <th>&nbsp;&nbsp</th>
    </tr>
    </thead>
    <tbody>
    {!!  \App\Http\Helpers\Helper::menu($menus) !!}
    </tbody>
</table>
@endsection

