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
              <?php if($row->id == 1): ?>
              <h4>Acces denied! You cannot delete the main Admin!</h4> <br>
                <a href="{{url('admin/users')}}">
                  <input class="btn btn-success" style="float: right;" type="button" value="Back">
            </a>
              <?php else: ?>

            <h4>Are you sure you want to delete this User??</h4> <br>
                <form method="post" enctype="multipart/form-data">
                  @if (count($errors->all()))
                    <div class="alrt alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            {{$error}} <br>
                        @endforeach
                    </div>
                @endif
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                      <input disabled id="name" type="text" class="form-control" placeholder="User Name" name="namey" value="{{$row->name}}"><br>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="temail" class="col-sm-2 col-form-label">User Email</label>
                    <div class="col-sm-10">
                      <input disabled id="email" type="text" class="form-control" placeholder="User email" name="namey" value="{{$row->email}}"><br>
                    </div>
                  </div>

                    @csrf
                    
                    <input class="btn btn-danger" style="float: right;" type="submit" value="Delete">
                    <a href="{{url('admin/users')}}">
                        <input class="btn btn-success"  type="button" value="Back">
                  </a>
                </form>
                <?php endif; ?>
                <?php else: ?>
                <br><h4>Sorry, could not find that User! </h4><br>
                <a href="{{url('admin/users')}}">
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

