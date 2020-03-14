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










<div class="col-10">



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
                                        {{-- <span class=" label label-warning">Not Aproved</span> --}}
                                        <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <span class="caret"><span class="label label-warning">Not Aproved</span></span>
                                           </a>

                                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                               <a class="dropdown-item" href=" {{__('brandRegisterApprove')}}/{{$item->id}}/1 ">
                                                   {{ __('Approve') }}
                                               </a>
                                           </div>
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
              <input id="show" type="text" class="form-control" placeholder="Last name">
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
