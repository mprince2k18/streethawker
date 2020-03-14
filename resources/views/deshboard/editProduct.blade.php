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
Edit Product
@endsection
@section('desh_content')











<div class="col-10">





        <div>

        </div>

        <form enctype="multipart/form-data" action="{{ Route('updateProduct') }}" method="POST">
            @csrf
            <input type="hidden" value="{{$productInfo->id}}" name="id">
            <div class="form-group">
                <label>Product Name</label>
                <input value="{{$productInfo->product_name}}" name="product_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input value="{{$productInfo->product_price}}" name="product_price" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Enter product price">
            </div>
            <div class="form-group">
                <label>Select category</label>
                <select name="category" class="form-control" id="exampleFormControlSelect1">
                    @forelse ($allcategory as $item)
                    @if ($item->activation != 0)
                    <option value=" {{$item->id}} "> {{$item->category_name}} </option>
                    @endif
                    @empty
                    <option>No Data</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <label>Activation</label>
                <select name="activation" class="form-control" id="exampleFormControlSelect1">
                    <option value="1"> Active </option>
                    <option value="0">Deactive</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" placeholder="Write discription">{{$productInfo->description}}</textarea>
            </div>
            <div class="form-group">
                <label>product Point</label>
                <input value="{{$productInfo->point}}" name="point" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Product Point">
            </div>
            <div class="wrapper">
                    <div class="box">
                            <div class="js--image-preview"></div>
                            <div class="upload-options">
                              <label>
                                <input name="photo" type="file" class="image-upload" accept="image/*" />
                              </label>
                            </div>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary col-12 text-center">update product</button>
        </form>

        </div>






        @section('addNewScript')



        @endsection






@endsection
