@extends('layouts.desh_app')
@section('searchpanel')

@endsection


@section('pageHeading')
    Your Orders Cart
@endsection






@section('desh_content')










<div class="col-md-8">
<div class="col-md-8">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Product</th>
      {{-- <th scope="col">customer_ip</th> --}}
      <th scope="col">product quantity</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($allCart as $item)
        <tr>
          <th scope="row">{{App\product::findOrFail($item->product_id)->product_name}}</th>
          {{-- <td>{{$item->customer_ip}}</td> --}}
          <td>{{$item->product_quantity}}</td>
          <td>{{(App\product::findOrFail($item->product_id)->product_price)*$item->product_quantity}}</td>
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
