@extends('layouts.app')
@section('content')
@include('layouts.menubar')

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
                  <th scope="col">Status Code</th>
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
                 <td>{{$row->status_code}}</td>
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
                   <a href="#" class="btn btn-sm btn-info">View</a>
                   @if($row->status != 3 && $row->cancel_order == 0)
                   <a href="{{  url('/request/cancel/'.$row->id) }}" class="btn btn-sm btn-danger" id="cancel">Cancel</a>
                   @endif
                 </td>
                
               </tr>
              @endforeach 
             </tbody>
           </table>
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
