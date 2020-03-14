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





        <div>

        </div>

        <form action="{{ Route('updateCategory') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value=" {{$id}} ">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input name="category_name" type="text" class="form-control"  aria-describedby="emailHelp" value=" {{$category->category_name}} ">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Activation</label>
                    <select name="activation" class="form-control" id="exampleFormControlSelect1">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="aditional_information" class="form-control" placeholder="Write if has additional information ">{{$category->aditional_information}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary col-12 text-center">Update</button>
            </form>

        </div>






        @section('addNewScript')



        @endsection






@endsection
