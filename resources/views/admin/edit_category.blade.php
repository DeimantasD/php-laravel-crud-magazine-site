@include('admin.header')

@include('admin.sidebar')
<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>{{$page_title}} </h2>   
      </div>
          
            
          <div class="container-fluid col-lg-12">

            <?php if($row): ?>
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
                      <input id="category" type="text" class="form-control" placeholder="Category" name="category" value="{{$row->category}}"><br>
                    </div>
                  </div>

                    @csrf
                    
                    <input class="btn btn-primary" type="submit" value="Save">
                    <a href="{{url('admin/categories')}}">
                        <input class="btn btn-success" style="float: right;" type="button" value="Back">
                  </a>
                </form>
                <?php else: ?>
                <br><h4>Sorry, could not find that category! </h4><br>
                <a href="{{url('admin/categories')}}">
                  <input class="btn btn-success" style="float: right;" type="button" value="Back">
            </a>
                <?php endif; ?>
          </div>
       </div>              
        <hr />          
</div>

  </div>
</div>

@include('admin.footer')



