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











<div class="col-10">




        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Brand</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new Brand</h4>
              <form enctype="multipart/form-data" action="{{ Route('saveNewBrand') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name</label>
                    <input name="brand_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Brand name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                    <input name="photo" type="file" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Activation</label>
                    <select name="activation" class="form-control" id="exampleFormControlSelect1">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    </select>
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
                    <th scope="col">brand_name</th>
                    <th scope="col">activation</th>
                    {{-- <th scope="col">request</th> --}}
                    <th scope="col">approvedby</th>
                    <th scope="col">photo</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($allBrands as $item)

                    @if ($item->request == 1)

                    <tr>
                        <th scope="row"> {{$item->brand_name}} </th>
                        <td>
                            @if ($item->activation == 1)
                            <a class="btn btn-success" href="{{__('brandActivation')}}/{{$item->id}}/0">Activated</a>

                            @else
                            <a class="btn btn-danger" href="{{__('brandActivation')}}/{{$item->id}}/1">Deactivated</a>

                            @endif
                        </td>
                        {{-- <td class="">
                            <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre="">
                                <span class="caret"><span class="label label-success">Approved</span></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1" x-placement="top-end" x-out-of-boundaries="" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(384px, 183px, 0px);">
                                <a class="dropdown-item" href=" brandRewquest/{{$item->id}}/1 ">
                                    Approve
                                </a>
                                <a class="dropdown-item" href="brandRewquest/{{$item->id}}/0">
                                    Band
                                </a>
                            </div>
                        </td> --}}
                        <td> {{App\User::findOrFail($item->approvedby)->email}} </td>
                        <td><img src=" {{asset('uploads/brand')}}/{{$item->photo}} " alt="no Photo" width="50"></td>
                    </tr>
                    @endif
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
