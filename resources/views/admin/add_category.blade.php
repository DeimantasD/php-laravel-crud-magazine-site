@include('admin.header')

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
                    <label for="category" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input id="category" type="text" class="form-control" placeholder="Category Name" name="category" autofocus value="{{old('category')}}"><br>
                    </div>
                  </div>

                    @csrf
                   
                    <input class="btn btn-primary" type="submit" value="Post">
                </form>
          </div>
       </div>              
      
        <hr />
    
                 
  </div>
  
  </div>

</div>

@include('admin.footer')

