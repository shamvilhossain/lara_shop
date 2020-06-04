@extends('layouts.app')
@section('content')
@include('layouts.menubar')

<section id="aa-myaccount">
  <div class="container">
      <div class="row"><br>
         <div class="col-md-8 table-responsive" >
           <table class="table">
             <thead>
               <tr>
                 <th scope="col">PaymentType</th>
                 <th scope="col">Payment ID</th>
                 <th scope="col">Amount</th>
                 <th scope="col">Date</th>
                  <th scope="col">Status Code</th>
                  <th scope="col">Status </th>
                  <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
              
               <tr>
                 <th >a</th>
                 <td>a</td>
                 <td>a</td>
                 <td>a</td>
                 <td>a</td>
                 <td>a</td>
                 <td>
                   <a href="#" class="btn btn-sm btn-info">View</a>
                 </td>
               </tr>
              
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
              <li class="list-group-item"><a href=""> Return Order </a></li>
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
