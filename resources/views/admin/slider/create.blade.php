@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Lara Shop</a>
        <span class="breadcrumb-item active">Slider Section</span>
      </nav>
      <div class="sl-pagebody">
      	<div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">New Slider Add </h6>
   
          <form action="{{ route('store.slider') }}" method="post" enctype="multipart/form-data">
          	@csrf
          
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Category" name="category_name">
                    <option label="Choose Category"></option>
                    @foreach($category as $row)
                    <option value="{{ $row->category_name }}">{{ $row->category_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Slider Offer Title:</label>
                  <input class="form-control" type="text" name="offer_title"  >
                </div>
              </div><!-- col-12 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="description"  >
                </div>
              </div><!-- col-12 -->
             
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Url: </label>
                  <input class="form-control" type="text" name="btn_url"  >
                </div>
              </div><!-- col-12 -->
             
              

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Publication Status: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Publication status" name="publication_status">
                    <option label="Choose Category"></option>
                    <option value="0">Unpublshed</option>
                    <option value="1">Published</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
              	<label>Slider Image <span class="tx-danger">*</span></label>
                  <label class="custom-file">
                  <input type="file" id="file" class="custom-file-input" name="slider_img" onchange="readURL(this);" required="" accept="image">
                  <span class="custom-file-control"></span>
                  <img src="#" id="one" >
      				  </label>
              </div>

            </div><!-- row -->
            <hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Submit </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->
       
      </div><!-- sl-pagebody --> 
    </div><!-- sl-mainpanel -->





<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(140)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

@endsection
