@extends('admin.main')
@section('head')
    <script src="{{url('public/ckeditor')}}/ckeditor.js"></script>
@endsection

@section('contents')
    @include('admin.alert')
    <div class="card card-primary">
        <form role="form" action="" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name Category</label>
                    <input type="name" class="form-control" name="name" placeholder="Enter Name" value="{{$menu->name}}">
                </div>
                <div class="form-group">
                    <label for="parent">Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="{{$menu->parent_id == 0 ? 'selected' : ''}}">Danh Mục Cha</option>
                        @foreach($menus as $menuParent)
                            <option value="{{$menuParent->id}}" {{$menu->parent_id == $menuParent->id ? 'selected' : ''}}>{{$menuParent->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{$menu->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content" id="content">{{$menu->content}}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file"  id="upload">
                    <div id="image_show">
                        <a href="{{$menu->thumb}}" target="_blank">
                            <img src="{{$menu->thumb}}" alt="" width="100px">
                        </a>
                    </div>
                    <input type="hidden" name="thumb" id="thumb" value="{{$menu->thumb}}">
                </div>
                <div class="col-sm-6">
                    <label>Active</label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" {{$menu->active == 1 ? 'checked' : ''}} type="radio" id="active" name="active" checked>
                            <label for="active"  class="custom-control-label">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" {{$menu->active == 0 ? 'checked' : ''}} type="radio" id="deactive" name="active">
                            <label for="deactive" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script>

        CKEDITOR.replace( 'content' );
    </script>

@endsection
