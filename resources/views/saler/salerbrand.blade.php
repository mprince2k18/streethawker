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
Manage Brands
@endsection
@section('desh_content')
<meta name="csrf-token" content="{{ csrf_token() }}">










<div class="col-12">



        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Brand</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new Brand To Your List</h4>
                <input id="searchBrand" type="text" class="form-control" placeholder="Search Brand">
                <form action="{{Route('addNewBrand')}}" method="POST">
                    @csrf
                  <div class="m-b-0">
                    <select name="brand" id="sres" class="form-control" multiple="" data-role="tagsinput">

                    </select>
                </div>
                <button class="btn btn-success form-control">Add to list</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <a class="btn btn-primary" href="#" data-target="#req" data-toggle="modal"><i class="fa fa-plus"></i>Request Brad</a>

        <div id="req" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Request a new brand</h4>
                <form enctype="multipart/form-data" action="{{ Route('requestNewBrand') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Name</label>
                        <input name="brand_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Brand name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Photo</label>
                        <input name="photo" type="file" accept="image/*" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Activation</label>
                        <select name="activation" class="form-control" id="exampleFormControlSelect1">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                        </select>
                    </div> --}}
                    <button type="submit" class="btn btn-primary col-12 text-center">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>



        <div class="row">
            <div class="col">
                <h3>Your Brand Lists</h3>
                    <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">Brand</th>
                                <th scope="col">Saler</th>
                                <th scope="col">Approval status</th>
                                <th scope="col">Aproved by</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($registerBrands as $item)
                                <tr>
                                    <th scope="row"> {{App\Brand::findOrFail($item->brand_id)->brand_name}} </th>
                                    <td> {{App\User::findOrFail($item->saler_id)->name}} </td>
                                    <td>
                                    @if ($item->approval_status == 0)
                                        <span class=" label label-warning">Not Aproved</span>
                                    @else
                                        <span class=" label label-success">Aproved</span>
                                    @endif
                                    </td>
                                    <td>
                                    @if ($item->aproved_by == 0)
                                        <span class=" label label-danger">Not seen by admin</span>
                                    @else
                                        {{App\User::findOrFail($item->aproved_by)->name}}
                                    @endif
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
            <div class="col">
              <h3>Your Brand Requests</h3>
              <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Brand</th>
                        <th scope="col">Activation</th>
                        <th scope="col">Request</th>
                        <th scope="col">Aproved by</th>
                        <th scope="col">Photoy</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($requestBrands as $item)
                        <tr>
                            <th scope="row"> {{$item->brand_name}} </th>
                            <td>
                                @if ($item->activation == 1)
                                    <span class=" label label-success">Active</span>
                                @else
                                    <span class=" label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                            @if ($item->request == 0)
                                <span class=" label label-warning">Waiting</span>
                            @else
                                <span class=" label label-success">Acepted</span>
                            @endif
                            </td>
                            <td>
                            @if ($item->approvedby == 0)
                                <span class=" label label-danger">Not seen by admin</span>
                            @else
                                {{App\User::findOrFail($item->approvedby)->name}}
                            @endif
                            </td>
                            <td>
                            <img src="{{asset('uploads/brand')}}/{{$item->photo}}" alt="no photo" width="50px">
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


        </div>






        @section('addNewScript')
            {{-- <script src="{{ asset('assets/js/addCategory.js') }}"></script> --}}
            <script>
                $(document).ready(function name() {



                $('#searchBrand').keyup(function() {
                var searchData = $('#searchBrand').val();
                    // $('#show').val(searchData);

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                // alert(searchData.toLowerCase());

                $.ajax({
                type:'POST',
                url:'/getBrandSearch',
                data: {searchData: searchData},
                    success: function (data) {
                        // $( "#company_upazilla" ).html(data);
                        // $('#productid').html(data);
                        $('#sres').html(data);
                        // alert(data);
                    }
                });






                });




                });
            </script>

        @endsection






@endsection
