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
Manage Categories
@endsection
@section('desh_content')











<div class="col-10">



        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Category</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new category</h4>
              <form action="{{ Route('saveNewCategory') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input name="category_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter category name">
                </div>
                <div class="form-group">
                    <label for="category_photo">Photo</label>
                    <input name="category_photo" type="file" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="category_photo">Category big photo</label>
                    <input name="category_big_photo" type="file" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Activation</label>
                    <select name="activation" class="form-control" id="exampleFormControlSelect1">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="aditional_information" class="form-control" placeholder="Write if has additional information "></textarea>
                </div>
                <button type="submit" class="btn btn-primary col-12 text-center">Add</button>
            </form>
              </div>
            </div>
          </div>
        </div>



        <div>
                <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category Icon</th>
                    <th scope="col">Category Image</th>
                    <th scope="col">Activation</th>
                    <th scope="col">Aditional Informaiton</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allCaregories as $item)
                    <tr>
                    <th scope="row">{{$item->category_name}}</th>
                    <td> <img src="{{asset('frontEnd/img/vertical-menu/')}}/{{$item->category_photo}}" alt="Sorry" width="20px" height="20px"> </td>
                    <td> <img src="{{asset('frontEnd/img/categories/')}}/{{$item->category_big_photo}}" alt="Sorry" width="80" height="100"> </td>
                    <td>
                        @if ($item->activation == 1)
                            <a class="btn btn-success" href=" {{__('changeCategoryActivation')}}/{{$item->id}}/{{$item->activation}} ">Active</a>
                        @else
                            <a class="btn btn-danger" href=" {{__('changeCategoryActivation')}}/{{$item->id}}/{{$item->activation}} ">Inactive</a>
                        @endif
                    </td>
                    <td><textarea name="adiinfo" cols="20" rows="2" readonly> {{$item->aditional_information}} </textarea></td>
                    <td>
                        <a class="btn btn-primary" href=" {{__('editcategory')}}/{{$item->id}} "><i class="fa fa-edit"></i></a>
                        {{-- <a class="btn btn-danger" href=" {{__("deleteCategory")}}/{{$item->id}} " ><i class="fa fa-trash"></i></a> --}}
                        <button onclick="myFunction({{$item->id}})" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                    </td>
                    </tr>
                    @empty
                    <tr><td>No data available</td></tr>
                    @endforelse
                </tbody>
                </table>
        </div>


</div>






        @section('addNewScript')
            {{-- <script src="{{ asset('assets/js/addCategory.js') }}"></script> --}}
            <script>
                function myFunction(id) {
                var txt;
                var r = confirm("Make sure you want to delete ?!");
                    if (r == true) {
                        location.href = "{{__("deletecategory")}}/"+id;
                        // alert("{{__("deletecategory")}}/"+id);
                    }
                }
            </script>

        @endsection






@endsection
