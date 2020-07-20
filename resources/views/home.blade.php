@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<style type="text/css">
  



.modal-content {
    border-radius: 0.7rem
}

@media(width:1024px) {
    .modal-dialog {
        max-width: 700px
    }
}

.modal-title {
    text-align: center;
    font-size: 3vh;
    font-weight: bold
}

h4 {
    margin-left: auto
}

.modal-header {
    border-bottom: none;
    text-align: center;
    padding-bottom: 0
}

h5 {
    color: rgb(2, 55, 230);
    margin-top: 2vh;
    margin-bottom: 0;
    
}

.modal-body {
    padding: 2vh
}

.modal-footer {
    border-top: none;
    justify-content: center;
    padding-top: 0;
    text-align: center;
}

.row {
    border-bottom: 1px solid rgba(0, 0, 0, .2);
    /*padding: 2vh 0 2vh 0;*/
    justify-content: space-between;
    flex-wrap: unset;
    margin: 0
}

ul {
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-around
}

ul li {
    font-size: 2vh;
    /*font-weight: bold;*/
    line-height: 4vh
}

.left {
    float: left;
    font-weight: normal;
    color: rgb(126, 123, 123)
}

.right {
    float: right;
    text-align: right
}

.col {
    padding-left: 0
}

@media(min-width:1025px) {
    img {
        col-sm-40%
    }
}

.openmodal {
    background-color: white;
    color: black;
    width: 30vw
}

:-moz-any-link:focus {
    outline: none
}

button:active {
    outline: none
}

button:focus {
    outline: none
}

.btn:focus {
    box-shadow: none
}

</style>
<section id="aa-myaccount">
  <div class="container">
      <div class="row"><br>
         <div class="col-md-8 table-responsive" >
           <table class="table">
             <thead>
               <tr style="text-align:center">
                 <th scope="col">PaymentType</th>
                <!--  <th scope="col">Payment ID</th> -->
                 <th style="text-align:center" scope="col">Amount</th>
                 <th style="text-align:center" scope="col">Date</th>
                  <th scope="col">Tracking Code</th>
                  <th scope="col">Status </th>
                  <th  scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
              @foreach($order as $row)
               <tr>
                
                 <td >{{$row->payment_type}}</td>
                 <!-- <td>{{$row->payment_id}}</td> -->
                 <td style="text-align:right">{{$row->total}} $</td> 
                 <td style="text-align:center">{{$row->date}}</td>
                 <td style="text-align:center">{{$row->status_code}}</td>
                 <td>
                 @if($row->cancel_order == 0)
                    @if($row->status == 0)
                     <span class="badge badge-warning">Pending</span>
                    @elseif($row->status == 1)
                    <span class="badge badge-info">Payment Accept</span>
                    @elseif($row->status == 2) 
                     <span class="badge badge-info">Progress </span>
                     @elseif($row->status == 3)  
                     <span class="badge badge-success">Delivered </span>
                     @else
                     <span class="badge badge-danger">Cancel By Admin </span>
                     @endif
                  @elseif($row->cancel_order == 1)
                    <span class="badge badge-warning">Cancel Request Sent</span>
                  @else 
                    <span class="badge badge-danger">Canceled BY You </span>
                  @endif  
                 </td>
                 <td >
                   <a href="#" id="{{ $row->id }}" class="btn btn-sm btn-info" data-placement="top" data-toggle="modal" data-target="#modal1" onclick="orderview(this.id)">View</a>
                   
                   @if($row->status != 3 && $row->cancel_order == 0)
                   <a href="{{  url('/request/cancel/'.$row->id) }}" class="btn btn-sm btn-danger" id="cancel">Cancel</a>
                   @endif
                 </td>
                
               </tr>
              @endforeach 
             </tbody>
           </table>
         </div>

<div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #ff6666;">Order Summery</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> <!-- Modal body -->
                <div class="modal-body">
                    
                        <h5>Item Details</h5>
                        <div id="order_items">
                          
                        </div>
                        <h5>Order Details</h5>
                        <div class="row">
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="left">Order number:</li>
                                    <li class="left">Date:</li>
                                    <li class="left">Subtotal:</li>
                                    <li class="left">Shipping:</li>
                                    <li class="left">Total Price:</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul class="right" type="none">
                                    <li class="right" id="stripe_order_id"></li>
                                    <li class="right" id="order_date"></li>
                                    <li class="right" id="order_subtotal"></li>
                                    <li class="right" id="order_shipping"></li>
                                    <li class="right" id="order_total"></li>
                                </ul>
                            </div>
                        </div>
                        <h5>Shipment</h5>
                        <div class="row" style="border-bottom: none">
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="left">Address</li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <ul type="none">
                                    <li class="right" id="ship_address">25-03-2020</li>
                                </ul>
                            </div>
                        </div>
                    
                </div> <!-- Modal footer -->
                <div class="modal-footer"> 
                  <form action="{{route('order.tracking')}}" method="post">
                    @csrf
                    <input type="hidden" name="code" id="track_code" value="">
                    <button type="submit" class="aa-browse-btn">Track Order</button> 
                  </form>
                </div>
            </div>
        </div>
    </div>




         <div class="col-md-4">
           <div class="card" style="">
            <img src="{{ asset('public/avatar.jpg') }}" class="card-img-top" style="height: 90px; width: 90px; margin-left: 34%;" >
            <div class="card-body">
              <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="{{ route('password.change') }}"> Password Change </a></li>
              <li class="list-group-item"><a href=""> Edit Profile </a></li>
              <li class="list-group-item"><a href="" > Return Order </a></li>
            </ul>
            <div class="card-body">
              <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a><br>
            </div>
          </div>
         </div>
      </div>
  </div>
</section>


@endsection
