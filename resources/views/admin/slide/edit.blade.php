@extends('admin.main')
@section('contents')
    <div class="card card-primary">
        <form role="form" action="" method="POST">
            @csrf
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="name" class="form-control" name="name" value="{{$slide->name}}">
                      </div>
                  </div>

                     <div class="col-md-6">
                         <div class="form-group">
                             <label for="name">Link</label>
                             <input type="name" class="form-control" name="url" value="{{$slide->url}}">
                         </div>
                     </div>
              </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file"  id="upload">
                    <div id="image_show">
                        <a href="{{$slide->thumb}}"><img src="{{$slide->thumb}}" target="_blank" width="100px"></a>
                    </div>
                    <input type="hidden" name="thumb" id="thumb" value="{{$slide->thumb}}">
                </div>

                <div class="form-group">
                    <label for="name">Sort</label>
                    <input type="number" class="form-control" name="sort_by" value="{{$slide->sort_by}}">
                </div>
                <div class="col-sm-6">
                    <label>Active</label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                {{$slide->active == 1 ? 'checked' : ''}}>
                            <label for="active"  class="custom-control-label">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="deactive" name="active"
                                {{$slide->active == 0 ? 'checked' : ''}}>
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

