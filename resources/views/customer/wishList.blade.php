


@extends('layouts.front_app')

@section('allContentHere')

<div class="container">

  <table class="table">
    <thead class="bg-danger">
      <tr>
        <th scope="col">Photo</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Actions</th>
        <th scope="col">Cart</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allWishList as $element)
        @if ($element->ralationWithProduct->activation == 1 )

      <tr>
        <th scope="row"><img src="{{asset('uploads/product')}}/{{$element->ralationWithProduct->photo}}" alt="No Photo" width="80"></th>
        <td>{{ $element->ralationWithProduct->product_name }}</td>
        <td>{{ $element->ralationWithProduct->product_price }}</td>
        <td>
          <a href="{{url('remove/from/wish/list')}}/{{$element->id}}" class="btn btn-danger">Remove</a>
        </td>
        <td>
          <a href="{{url('add/to/cart')}}/{{$element->ralationWithProduct->id}}" class="btn btn-info">Add to cart</a>
        </td>
      </tr>
    @endif
      @endforeach
    </tbody>
  </table>
</div>


@endsection
