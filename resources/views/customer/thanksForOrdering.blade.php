


@extends('layouts.front_app')

@section('allContentHere')


<div class="text-center">
  <h1>Thanks For Ordering</h1>
  @if(Session::has('orderTrackingId'))
    <h2>Your Order Number</h2>
    <h3>{{ Session::get('orderTrackingId') }}</h3>
  @endif
</div>





@endsection
