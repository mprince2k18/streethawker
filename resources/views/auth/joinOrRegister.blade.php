


@extends('layouts.front_app')

@section('allContentHere')


  <div class="container">
  <div class="row">


  <div class="col-md-6">
      <div class="well mb-sm-30">
          <div class="new-customer">
              <h3 class="custom-title">New customer ?</h3>
              <p class="mtb-10"><strong>Register from here</strong></p>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
              <a class="customer-btn" href="{{ url('/register') }}">continue</a>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="well mb-sm-30">
          <div class="new-customer">
              <h3 class="custom-title">New Member</h3>
              <p class="mtb-10"><strong>Register Here</strong></p>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
              <a class="customer-btn" href="{{ url('/mamber/register') }}">continue</a>
          </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="well mb-sm-30">
        <div class="new-customer">
            <h3 class="custom-title">New Vendor ?</h3>
            <p class="mtb-10"><strong>Register Now</strong></p>
            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
            <a class="customer-btn" href="{{ url('/vendor/register') }}">continue</a>
        </div>
    </div>
</div>


</div>
</div>

@endsection
