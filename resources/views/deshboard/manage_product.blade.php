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
        Manage Products
        @endsection
        @section('desh_content')









        <div class="col-12">



                <!--Trigger-->
                <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Product</a>

                <div id="login" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <div class="modal-content">
                      <div class="modal-body">
                        <button data-dismiss="modal" class="close">&times;</button>
                        <h4>Add new category</h4>
                      <form enctype="multipart/form-data" action="{{ Route('saveNewProduct') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input value=" {{old('product_name')}} " name="product_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter product name">
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input value=" {{old('product_price')}} " name="product_price" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Enter product price">
                        </div>
                        <div class="form-group">
                            <label>Product Stock</label>
                            <input value=" {{old('product_quantity')}} " name="product_quantity" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Enter product qnantity">
                        </div>
                        {{-- //Caregory --}}
                        <div class="form-group">
                            <label>Select category</label>
                            <select id="category" name="category" class="form-control" id="exampleFormControlSelect1">
                                @forelse ($allcategory as $item)
                                @if ($item->activation != 0)
                                <option value=" {{$item->id}} "> {{$item->category_name}} </option>
                                @endif
                                @empty
                                <option>No Data</option>
                                @endforelse
                            </select>
                        </div>
                    {{-- //Sub Categtegory --}}
                        <div class="form-group">
                            <label>Select sub category</label>
                            <select id="subcategory" name="subcategory" class="form-control" id="exampleFormControlSelect1">

                                <option value="0"> Select One * </option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>select a brand</label>
                            <select name="brand" class="form-control" id="exampleFormControlSelect1">
                                @forelse ($registeredBrands as $item)
                                <option value=" {{$item->brand_id}} "> {{App\Brand::findOrFail($item->brand_id)->brand_name}} </option>
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
                            <textarea value=" {{old('description')}} " name="description" class="form-control" placeholder="Write discription"></textarea>
                        </div>
                        <div class="form-group">
                            <label>product Point</label>
                            <input value=" {{old('point')}} " name="point" type="number" class="form-control"  aria-describedby="emailHelp" placeholder="Product Point">
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
                            <th scope="col">Product name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Product price</th>
                            <th scope="col">Product Quantity</th>
                            <th scope="col">Description</th>
                            <th scope="col">Activation</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Approved By</th>
                            <th scope="col">Point</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allproduct as $item)
                            <tr>
                            <th scope="row">{{$item->product_name}}</th>
                            <th scope="row">{{App\category::findOrFail($item->category)->category_name}}</th>
                            <th scope="row">{{App\Brand::findOrFail($item->brand)->brand_name}}</th>
                            <th scope="row">{{$item->product_price}}</th>
                            <th scope="row">{{$item->quantity}}</th>
                            <td><textarea name="adiinfo" cols="10" rows="2" readonly> {{$item->description}} </textarea></td>
                            <td>
                                    @if ($item->activation == 1)
                                        <a class="btn btn-success" href=" {{__('changeProductActivation')}}/{{$item->id}}/{{$item->activation}} ">Active</a>
                                    @else
                                        <a class="btn btn-danger" href=" {{__('changeProductActivation')}}/{{$item->id}}/{{$item->activation}} ">Inactive</a>
                                    @endif
                            </td>
                            <td>
                                    @if ($item->approval == 1)
                                        <span class="label label-success">Approved</span>
                                    @else
                                        <span class="label label-warning">Not Approved</span>
                                    @endif
                            </td>
                            <td>
                                @if ($item->approvedby == 0)
                                    <span class="label label-danger">not seen</span>
                                @elseif($item->approvedby == null)
                                    <span class="label label-danger">user error</span>
                                @else
                                {{App\User::findOrFail($item->approvedby)->name}}
                                @endif
                            </td>
                            <th scope="row">{{$item->point}}</th>
                            <td>
                                <img src=" {{asset('uploads/product')}}/{{$item->photo}} " width="50px" alt="Photo Link Not Found">
                            </td>
                            <td>
                                <a class="btn btn-primary" href=" {{__('editProduct')}}/{{$item->id}} "><i class="fa fa-edit"></i></a>
                                {{-- <a class="btn btn-danger" href=" {{__("deleteCategory")}}/{{$item->id}} " ><i class="fa fa-trash"></i></a> --}}
                                <button onclick="myFunction({{$item->id}})" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                            </td>
                            </tr>
                            @empty
                            <tr><td>
                                <div class="row">
                                    <div class="alert alert-danger" role="alert">
                                        No Data Available
                                    </div>
                                </div>
                            </td></tr>
                            @endforelse
                        </tbody>
                        </table>
                        {{ $allproduct->links() }}
                </div>



                </div>








             @section('addNewScript')
                {{-- <script src="{{ asset('assets/js/addCategory.js') }}"></script> --}}
                <script>
                    function myFunction(id) {
                    var txt;
                    var r = confirm("Make sure you want to delete ?!");
                        if (r == true) {
                            location.href = "{{__("deleteproduct")}}/"+id;
                            // alert("{{__("deletecategory")}}/"+id);
                        }
                    }
                </script>
                <script>
                    //variable
                    var subcategory=document.getElementById('subcategory');
                    var category=document.getElementById('category');

                    //event Listener
                    category.addEventListener('change',categoryChange);


                    //funcjiton
                    function categoryChange() {
                        var categoryId = this.value;

                    //ajax strart
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                    type:'POST',
                    url:'/getSubCategory',
                    data: {categoryId: categoryId},
                        success: function (data) {
                            // $( "#company_upazilla" ).html(data);
                            // alert(data);
                            $('#subcategory').html(data);
                        }
                    });
                    //ajax end

                    }
                </script>

            @endsection






@endsection
