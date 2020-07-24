@extends('admin.admin_layouts')
@section('admin_content')
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5> Orders Details</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Orders List </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Payment Type</th>
                  <th class="wd-15p">Transection ID</th>
                  <th class="wd-15p">Subtotal</th>
                  <th class="wd-20p">Shipping</th>
                  <th class="wd-20p">Total</th>
                   <th class="wd-20p">Date</th>
                   <th class="wd-20p">Cancel</th>
                   <th class="wd-20p" style="text-align:center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order as $row)
                <tr>
                  <td>{{ $row->payment_type }}</td>
                  <td>{{ $row->blnc_transection }}</td>
                  <td>{{ $row->subtotal }} $</td>
                  <td>{{ $row->shipping }} $</td>
                  <td>{{ $row->total }} $</td>
                  <td>{{ $row->date }} </td>
                  <td>
                    @if($row->cancel_order == 1)
                     <span class="badge badge-warning">Cancel Request</span>
                    @elseif($row->cancel_order == 2)
                    <span class="badge badge-danger">Request Canceled</span>
                     @endif
              
                  <td>
                    <a href="{{ URL::to('admin/view/order/'.$row->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ URL::to('admin/approve/cancel/'.$row->id) }}" class="btn btn-sm btn-info">Approve</a>
                  	<a href="{{ URL::to('admin/reject/cancel/'.$row->id) }}" class="btn btn-sm btn-danger">Reject</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->



@endsection