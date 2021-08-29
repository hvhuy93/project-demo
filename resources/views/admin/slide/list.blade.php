@extends('admin.main')

@section('contents')
@section('add')
    <a class="btn btn-primary" href="{{route('slide.create')}}">Add new</a>
@endsection
<table class="table table-hover">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Link</th>
        <th>Image</th>
        <th>Active</th>
        <th>Update</th>
        <th>&nbsp;&nbsp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slides as $key => $slide)
    <tr>
        <td>{{$slide->id}}</td>
        <td>{{$slide->name}}</td>
        <td>{{$slide->link}}</td>
        <td>
            <a href="{{$slide->thumb}}" target="_blank">
                <img src="{{$slide->thumb}}" width="70px">
            </a>

        </td>
        <td>{!!  \App\Http\Helpers\Helper::active($slide->active)!!}</td>
        <td>{{$slide->updated_at}}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{route('slide.edit',$slide->id)}}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm"
               onclick="removeRow({{$slide->id}}, '{{route('slide.destroy')}}')">
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
    </tbody>
    @endforeach
</table>
        {!! $slides->links() !!}
@endsection

