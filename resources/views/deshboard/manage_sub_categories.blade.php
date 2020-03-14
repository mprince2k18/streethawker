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
Manage Sub Categories
@endsection
@section('desh_content')










<div class="col-10">



    <!--Trigger-->
    <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> Sub Category</a>

    <div id="login" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-body">
            <button data-dismiss="modal" class="close">&times;</button>
            <h4>Add sub category</h4>
          <form action="{{ Route('saveNewSubCategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Category</label>
                <select id="category" name="category" class="form-control" id="exampleFormControlSelect1">
                <option value="0">Categories</option>
                @foreach ($allCaregories as $item)
                    @if ($item->activation == 1)
                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"> Sub Category Name</label>
                <input name="sub_category_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter sub category name">
            </div>
            <button id="saveBtn" type="submit" class="btn btn-primary col-12 text-center">Save</button>
        </form>
          </div>
        </div>
      </div>
    </div>



    <div>
            <table class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col">Sub Category Name</th>
                <th scope="col">Activation</th>
                <th scope="col">category</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allSubCaregories as $item)
                <tr>
                <th scope="row">{{$item->sub_category_name}}</th>
                <td>
                    @if ($item->activation == 1)
                        <a class="btn btn-success" href=" {{__('changeCategoryActivation')}}/{{$item->id}}/{{$item->activation}} ">Active</a>
                    @else
                        <a class="btn btn-danger" href=" {{__('changeCategoryActivation')}}/{{$item->id}}/{{$item->activation}} ">Inactive</a>
                    @endif
                </td>
                <td>{{ App\category::find($item->categoryId)->category_name }}</td>
                <td>
                    <a class="btn btn-primary" href=" {{__('editsubcategory')}}/{{$item->id}} "><i class="fa fa-edit"></i></a>
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
                $(document).ready(function () {
                    if ($('#category').val() == 0) {
                        $('#saveBtn').prop("disabled", true);
                    }
                    $('#category').change(function () {
                        let categoryId = $(this).val();
                        if (categoryId == 0) {
                            $('#saveBtn').prop("disabled", true);
                        }
                        else{
                            $('#saveBtn').prop("disabled", false);
                        }
                    });

                });
            </script>

        @endsection






@endsection
