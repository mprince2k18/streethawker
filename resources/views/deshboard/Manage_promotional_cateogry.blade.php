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
                <h4>Add new promitjional Cateogry</h4>
                <input id="searchBrand" type="text" class="form-control" placeholder="Search Category">
                <form action="{{Route('new_promotional_cateogry')}}" method="POST">
                    @csrf
                  <div class="m-b-0">
                    <select name="category" id="sres" class="form-control" multiple="" data-role="tagsinput">

                    </select>
                </div>
                <button class="btn btn-success form-control">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col">
                <h3>Your Brand Lists</h3>
                <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category Icon</th>
                    <th scope="col">Category Image</th>
                    {{-- <th scope="col">Aditional Informaiton</th> --}}
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allproitonalCateogry as $item)
                    <tr>
                    <th scope="row">{{$item->relationWithCategory->category_name}}</th>
                    <td> <img src="{{asset('frontEnd/img/vertical-menu/')}}/{{$item->relationWithCategory->category_photo}}" alt="Sorry" width="20px" height="20px"> </td>
                    <td> <img src="{{asset('frontEnd/img/categories/')}}/{{$item->relationWithCategory->category_big_photo}}" alt="Sorry" width="80" height="100"> </td>

                    {{-- <td><textarea name="adiinfo" cols="20" rows="2" readonly> {{$item->relationWithCategory->aditional_information}} </textarea></td> --}}
                    <td>
                        <a class="btn btn-danger" href=" {{url('removePromotionalCategory')}}/{{$item->id}} "><i class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    @empty
                    <tr><td>No data available</td></tr>
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
                url:'/getCategorySearch',
                data: {searchData: searchData},
                    success: function (data) {
                        // console.log(data);
                        $('#sres').html(data);
                        // alert(data);
                    }
                });






                });




                });
            </script>

        @endsection






@endsection
