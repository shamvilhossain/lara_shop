@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Main Sliders</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Slider List
          	<a href="{{ URL::to('admin/add/slider') }}" class="btn btn-sm btn-success" style="float: right;" >Add New</a>
          </h6>
        <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Offer Title</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-15p">Image</th>
                  <th>Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($slider as $row)
                <tr>
                  <td>{{ $row->offer_title }}</td>
                  <td>{{ $row->category_name }}</td>
                  <td><img src="{{ URL::to($row->slider_img ) }}" height="50px;" width="120px;"></td>
                  <td class="center">
                    <?php if($row->publication_status==1){ ?>
                      <span class="label label-success">Published</span>
                    <?php } else{ ?>
                      <span class="label label-important">Unpublished</span>
                    <?php } ?>	
                  </td>
                  <td>
                  	<a href="{{ URL::to('edit/slider/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{ URL::to('delete/slider/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                  </td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
  </div>



@endsection