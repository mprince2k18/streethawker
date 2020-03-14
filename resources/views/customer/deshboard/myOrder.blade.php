@extends('layouts.desh_app')
@section('searchpanel')

@endsection


@section('pageHeading')
    Your Orders
@endsection






@section('desh_content')










<div class="col-md-12 align-center">
<div class="col-md-8">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Tracking Number</th>
      <th scope="col">Date</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($myOrders as $item)
        <tr>
          <th scope="row">{{$item->orderTrackingId}}</th>
          <th scope="row">{{$item->created_at}}</th>
          <td>{{$item->totalAmount}}</td>
          <td><a class="btn btn-info" href="{{url('/my/order/details')}}/{{$item->id}}">Details</a></td>
        </tr>
        @endforeach
  </tbody>
</table>

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
