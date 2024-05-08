@include('admin.header')
<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />
@include('admin.sidebar')
<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>{{$page_title}} </h2>   
           <a href="{{url('admin/posts/add')}}">
           <button class="btn btn-primary btn-sm" style="float:right;"><i class="fa fa-plus"></i> Add Post</button>
          </a>
          </div>
          <table class="table table-striped table-hover">
              <thead>
                <tr><th>Title</th><th>Content</th><th>Category</th><th>Featured Image</th><th>Date</th><th>Action</th></tr>
              </thead>
              <tbody>
                @if ($rows)
                  @foreach ($rows as $row)
                      <tr><td>{{$row->title}}</td><td><?=$row->content?></td><td>{{$row->category}}</td><td><img src="{{url($row->image)}}" style="width: 150px"></td><td>{{date("jS M, Y",strtotime($row->created_at) )}}</td>

                        <td>
                          <a href="{{url('admin/posts/edit/' .$row->id)}}">
                            <button class="btn-sm btn btn-success"><i class="fa fa-edit"></i> Edit</button>
                          </a>
                          <a href="{{url('admin/posts/delete/' .$row->id)}}">
                              <button class="btn-sm btn btn-warning"><i class="fa fa-times"></i> Delete</button>
                          </a>
                      </td>
                    </tr>

                  @endforeach
                @endif
              </tbody>
          </table>

          @include('pagination')

      </div>              
        <hr />
               
</div>
  </div>
</div>

@include('admin.footer')

