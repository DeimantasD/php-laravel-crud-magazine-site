@include('admin.header')
<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />
@include('admin.sidebar')
<div id="page-wrapper" >
  <div id="page-inner">
    <div class="row">
            <div class="col-md-12">
            <h2>{{$page_title}} </h2>   
            </div>
            
              
            <div class="container-fluid col-lg-12">
                  <form method="post" enctype="multipart/form-data">
                    @if (count($errors->all()))
                    <div class="alrt alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            {{$error}} <br>
                        @endforeach
                    </div>
                @endif
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Post title</label>
                      <div class="col-sm-10">
                        <input id="title" type="text" class="form-control" placeholder="Title" name="title" autofocus value="{{old('title')}}"><br>
                      </div>
                    </div>

                      <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Featured image</label>
                        <div class="col-sm-10">
                          <input id="image" type="file" class="form-control" name="image">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Post category</label>
                        <div class="col-sm-10">
                          <select id="category_id" name="category_id" class="form-control">
                            <option>--Select a Category--</option>

                            @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->category}}</option>
                            @endforeach
                            

                          </select>
                        </div>
                      </div>

                      @csrf
                      <h4>Post content</h4>
                      <textarea id="summernote" name="content" value="{{old('content')}}" ></textarea>
                      <input class="btn btn-primary" type="submit" value="Post">
                  </form>
            </div>
      </div>              
        
          <hr />
      
                    
    </div>
    
  </div>

</div>

@include('admin.footer')

<script src="{{url('summernote/summernote-lite.min.js')}}"></script>
<script>
  $(document).ready(function() {
  $('#summernote').summernote({height:400});
});
</script>

