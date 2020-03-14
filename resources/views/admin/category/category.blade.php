
@extends('admin.admin_layouts')

@section('admin_content')
	<div class="sl-mainpanel">
     
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Category List
          	<a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
          </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Category name</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tiger</td>
                  <td>Nixon</td>
                  <td>
                  	<a href="" class="btn btn-sm btn-info">edit</a>
                  	<a href="" class="btn btn-sm btn-danger" id="delete">delete</a>
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
@endsection