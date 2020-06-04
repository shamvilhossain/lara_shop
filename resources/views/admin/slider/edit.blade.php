@extends('admin.admin_layouts')

@section('admin_content')

@php 
  $category=DB::table('categories')->get();
@endphp

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Lara Shop</a>
        <span class="breadcrumb-item active">Slider Section</span>
      </nav>
      <div class="sl-pagebody">
      	  <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title"> Slider Update </h6>
          <form action="{{ url('update/slider/'.$slider->id) }}" method="post" enctype="multipart/form-data">
          	@csrf
            

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-12">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Category" name="category_name">
                    <option label="Choose Category"></option>
                    @foreach($category as $row)
                    <option value="{{ $row->category_name }}" <?php if ($row->category_name == $slider->category_name) {
                       echo "selected";
                    } ?> >{{ $row->category_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Slider Offer Title: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="offer_title"  value="{{ $slider->offer_title }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="description"  value="{{ $slider->description }}">
                </div>
              </div><!-- col-4 -->
             
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Url: </label>
                  <input class="form-control" type="text" name="btn_url" value="{{ $slider->btn_url }}" >
                </div>
              </div><!-- col-12 -->

              
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Publication Status: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Publication status" name="publication_status" >
                    <option value="0" <?php if($slider->publication_status==0){ echo 'selected';} ?> >Unpublshed</option>
                    <option value="1" <?php if($slider->publication_status==1){ echo 'selected';} ?> >Published</option>
                  </select>
                </div>
              </div> 

              <div class="col-lg-4">
              	<label>Slider Image:<span class="tx-danger">*</span></label>
              	<label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="slider_img" onchange="readURL(this);"  accept="image">
      				  <span class="custom-file-control"></span>
      				  <img src="#" id="one" >
      				</label>
              </div>
              <div class="col-lg-4">
                <label>Old Image<span class="tx-danger">*</span></label>
                <label class="custom-file">
                <img src="{{ URL::to($slider->slider_img) }}" style="height: 80px; width: 140px;" >
                <input type="hidden" name="old_image" value="{{ $slider->slider_img }}">
              </label>
              </div>
             
            </div><!-- row -->
            <br><hr>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Update </button>
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
