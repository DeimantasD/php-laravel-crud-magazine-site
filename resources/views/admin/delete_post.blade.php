@include('admin.header')
@include('admin.sidebar')
<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>{{$page_title}} </h2>   
      </div>
          
            
          <div class="container-fluid col-lg-12">
            <h4>Are you sure you want to delete this post??</h4>
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
                      <input disabled id="title" type="text" class="form-control" placeholder="Title" name="title" value="{{$row->title}}"><br>
                    </div>
                  </div>

                    <div class="form-group row">
                      <label for="file" class="col-sm-2 col-form-label">Featured image</label>
                      <div class="col-sm-10">
                        <img src="{{url('uploads/' .$row->image)}}" style="width: 200px;">
                      </div>
                    </div>


                    @csrf
                    
                   
                    <input class="btn btn-danger" style="float: right;" type="submit" value="Delete">
                    <a href="{{url('admin/posts')}}">
                        <input class="btn btn-success"  type="button" value="Back">
                  </a>
                </form>
          </div>
       </div>              
        <hr />
               
</div>
  </div>
</div>

@include('admin.footer')



