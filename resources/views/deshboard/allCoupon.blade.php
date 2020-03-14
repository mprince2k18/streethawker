@extends('layouts.desh_app')
@section('searchpanel')
<li class="hide-phone app-search">
    <form role="search" class="">
        <input type="text" placeholder="Search..." class="form-control">
        <a href=""><i class="fa fa-search"></i></a>
    </form>
</li>
@endsection
@section('pageHeading')
Manage Coupons
@endsection
@section('desh_content')











<div class="col-10">




        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Coupon</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new Coupon</h4>
              <form enctype="multipart/form-data" action="{{ Route('saveNewCoupon') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon</label>
                    <input name="coupon" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Write Coupon">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Discount</label>
                    <input name="discount" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Write discount">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status">
                      <option value="0">Deactive</option>
                      <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Expiry Date</label>
                  <input name="expiryDate" type="date" class="form-control"  aria-describedby="emailHelp" placeholder="Write expiry date">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Expiry time</label>
                  <input name="time" type="time" class="form-control"  aria-describedby="emailHelp" placeholder="Write expiry date">
                </div>

                <button type="submit" class="btn btn-primary col-12 text-center">Add</button>
            </form>
              </div>
            </div>
          </div>
        </div>



        <div class="row">
            <table class="table">
                <caption>List of bands</caption>
                <thead>
                  <tr class="bg-info">
                    <th scope="col">Coupon</th>
                    <th scope="col">Discount</th>
                    <th scope="col">activation</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($allCoupon as $item)

                    <tr>
                        <th scope="row"> {{$item->coupon}} </th>
                        <td> {{$item->discount}} </td>
                        <td>
                            @if ($item->status == 1)
                            <a class="btn btn-success" href="{{__('couponActivation')}}/{{$item->id}}/0">Activated</a>

                            @else
                            <a class="btn btn-danger" href="{{__('couponActivation')}}/{{$item->id}}/1">Deactivated</a>

                            @endif
                        </td>
                        <td> {{$item->expiryDate}} </td>
                        <td>
                        <a class="btn btn-danger" href="{{__('couponDelete')}}/{{$item->id}}">Delete</a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td>No Data</td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
        </div>

        </div>






        @section('addNewScript')
            {{-- <script src="{{ asset('assets/js/addCategory.js') }}"></script> --}}
            <script>

            </script>

        @endsection






@endsection
