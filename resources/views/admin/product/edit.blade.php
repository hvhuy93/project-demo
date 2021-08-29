@extends('admin.main')
@section('head')
    <script src="{{url('public/ckeditor')}}/ckeditor.js"></script>
@endsection

@section('contents')
    <div class="card card-primary">
        <form role="form" action="" method="POST">
            @csrf
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Name Product</label>
                          <input type="name" class="form-control" name="name" value="{{$product->name}}" placeholder="Enter Name">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="menu_id">Category</label>
                          <select name="menu_id" class="form-control">
                              @foreach($menus as $menu)
                                  <option value="{{$menu->id}}" {{$product->menu_id == $menu->id ? 'selected' : '' }}>{{$menu->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control"  name="price" value="{{$product->price}}" placeholder="Enter Price">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale">Price</label>
                            <input type="number" class="form-control" name="price_sale" value="{{$product->price_sale}}" placeholder="Enter Sale Price">
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{$product->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content" id="content">{{$product->content}}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file"  id="upload">
                    <div id="image_show">
                        <a href="{{$product->thumb}}" target="_blank">
                            <img src="{{$product->thumb}}" alt="" width="100px">
                        </a>
                    </div>
                    <input type="hidden" name="thumb" id="thumb" value="{{$product->thumb}}">
                </div>
                <div class="col-sm-6">
                    <label>Active</label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                            {{$product->active == 1 ?'checked' : ''}}
                            >
                            <label for="active"  class="custom-control-label">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="deactive" name="active"
                                {{$product->active == 0 ?'checked' : ''}}>
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
