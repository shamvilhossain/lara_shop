@extends('admin.admin_layouts')
@section('admin_content')
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Lara Shop</a>
        <span class="breadcrumb-item active">Site Setting</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Website Setting  </h6>
          <p class="mg-b-20 mg-sm-b-30"> Website Update</p>
          <form action="{{ route('update.sitesetting') }}" method="post" enctype="multipart/form-data">
          	@csrf
          <input type="hidden" name="id" value="{{ $setting->id }}">
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label"> Phone One: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone_one"  required="" value="{{ $setting->phone_one }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone Two: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone_two"  required="" value="{{ $setting->phone_two }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email"  required="" value="{{ $setting->email }}">
                </div>
              </div><!-- col-4 -->
               <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Company Name <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="company_name"  required="" value="{{ $setting->company_name }}">
                </div>
              </div><!-- col-4 -->

               <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Company Address <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="company_address"  required="" value="{{ $setting->company_address }}">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Logo <span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="logo"  required="" value="{{ $setting->logo }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <label>Old Image<span class="tx-danger">*</span></label>
                <label class="custom-file">
                <img src="{{ URL::to($setting->logo) }}" style="height: 80px; width: 140px;" >
                <input type="hidden" name="old_image" value="{{ $setting->logo }}">
              </label>
              </div>

                <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Facebook Link<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="facebook"  required="" value="{{ $setting->facebook }}">
                </div>
              </div><!-- col-4 -->
                <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Youtube Link<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="youtube"  required="" value="{{ $setting->youtube }}">
                </div>
              </div><!-- col-4 -->
                <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Instagram Link<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="instagram"  required="" value="{{ $setting->instagram }}">
                </div>
              </div><!-- col-4 -->
                <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Twitter Link<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="twitter"  required="" value="{{ $setting->twitter }}">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label"> Vat: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="vat"  required="" value="{{ $setting->vat }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Charge: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="shipping_charge"  required="" value="{{ $setting->shipping_charge }}">
                </div>
              </div><!-- col-4 -->
              

               <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Our Story<span class="tx-danger">*</span></label>
                   <textarea class="form-control summernote"  name="our_story">
                    {{ $setting->our_story}}
                   </textarea>
                </div>  
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Privacy Policy<span class="tx-danger">*</span></label>
                   <textarea class="form-control summernote"  name="privacy_policy">
                    {{ $setting->privacy_policy}}
                   </textarea>
                </div>  
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Terms of Use<span class="tx-danger">*</span></label>
                   <textarea class="form-control summernote"  name="terms_of_use">
                    {{ $setting->terms_of_use }}
                   </textarea>
                </div>  
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">FAQ<span class="tx-danger">*</span></label>
                   <textarea class="form-control summernote"  name="faq">
                    {{ $setting->faq }}
                   </textarea>
                </div>  
              </div>

            </div><!-- row -->
            <br>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Update </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->
       
      </div><!-- sl-pagebody --> 
    </div><!-- sl-mainpanel -->




@endsection
