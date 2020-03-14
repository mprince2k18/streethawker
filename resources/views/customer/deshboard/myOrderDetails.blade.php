@extends('layouts.desh_app')
@section('searchpanel')

@endsection


@section('pageHeading')
    Your Orders Details
@endsection






@section('desh_content')










<div class="row">
<div class="col-md-6">

<table class="table">
  <thead class="thead-dark">
    <tr>
      {{-- <th scope="col">userId</th> --}}
      <th scope="col">Order id</th>
      <th scope="col">Country</th>
      <th scope="col">city</th>
      <th scope="col">UserName</th>
      <th scope="col">CompanyName</th>
      <th scope="col">Address</th>
      <th scope="col">Zip</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Order Note</th>
      <th scope="col">Payment Type</th>
      <th scope="col">Discount</th>
      <th scope="col">Ship</th>
      <th scope="col">Sub total</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($allBills as $item)
        <tr>
          {{-- <th scope="row">{{$item->userId}}</th> --}}
          <td>{{$item->orderTrackingId}}</td>
          <td>{{App\Country::findOrFail($item->country_id)->name}}</td>
          <td>{{App\State::findOrFail($item->city_id)->name}}</td>
          <td>{{$item->userName}}</td>
          <td>{{$item->companyName}}</td>
          <td>{{$item->address}}</td>
          <td>{{$item->zip}}</td>
          <td>{{$item->email}}</td>
          <td>{{$item->phone}}</td>
          <td>{{$item->orderNote}}</td>
          <td>
            @if ($item->paymentType)
              Cash On Delivery
            @else
              Advanced Payment
            @endif
          </td>
          <td>{{$item->dis}}</td>
          <td>{{$item->ship}}</td>
          <td>{{$item->sub}}</td>
          <td>{{$item->tot}}</td>
          <td>
            @if ($item->actionStatus == 0)
              <span class="badge badge-pill badge-primary">New Order</span>
            @elseif($item->actionStatus == 1)
              <span class="badge badge-pill badge-warning">Pending</span>
            @elseif($item->actionStatus == 2)
              <span class="badge badge-pill badge-info">Follow Up</span>
            @elseif($item->actionStatus == 3)
              <span class="badge badge-pill badge-success">Confirmed</span>
            @elseif($item->actionStatus == 4)
              <span class="badge badge-pill badge-danger">Canceled</span>
            @endif
          </td>
        </tr>
        @endforeach
  </tbody>
</table>
<a class="btn btn-primary" href="{{url('/show/products')}}/{{$orderId}}">Show this order products</a>

</div>
</div>











@endsection






@section('addNewScript')
    {{-- <script>
        // const saveBtn = document.getElementById('saveBtn');
        const saveForm = document.getElementById('saveForm');
        const address = document.getElementById('address').value;
        const phone = document.getElementById('phone').value;
        const zip = document.getElementById('zip').value;

        saveForm.addEventListener('submit',function (e) {
            e.preventDefault();
            if (address == null || address==' ' || address=='') {
                const ele=document.createElement('li');
                ele.classList='list-group-itema alert alert-danger';
                ele.innerHTML=`<p>Fill Up All The Form Currectly</p>`;
                saveForm.insertBefore(ele,address);
                setTimeout(function () {
                    document.querySelector('.alert').remove();
                },2000);
            }
        });
    </script> --}}
@endsection
