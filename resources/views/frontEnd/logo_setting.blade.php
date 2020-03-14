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
Logo Setting
@endsection
@section('desh_content')











<div class="col-10">




        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Logo</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new Logo</h4>
              <form enctype="multipart/form-data" action="{{ Route('saveNewLogo') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Logo</label>
                    <input name="logo" type="file" class="form-control"  aria-describedby="emailHelp" >
                </div>
                <div class="form-group">
                    <select name="activation" class="form-control">
                        <option value="0">Deactive</option>
                        <option value="1">Active</option>
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
                    <th scope="col">Logo</th>
                    <th scope="col">activation</th>
                    <th scope="col">Aciton</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($allLogo as $item)
                    <tr>
                        <th><img width="250" src="{{asset('/frontEnd/img/logo')}}/{{$item->logo}}" alt="No Image"></th>
                        @if ($item->activation == 1)
                        {{-- <td><a class="btn btn-success" href="{{url('/theme/settings/logo/activation')}}/{{$item->id}}/{{$item->activation}}">Active</a></td> --}}
                        <th><span style="border-radius:50px"  class="btn btn-success">Activated</span></th>
                        @else
                        <td><a style="border-radius:50px" class="btn btn-danger" href="{{url('/theme/settings/logo/activation')}}/{{$item->id}}/{{$item->activation}}">Deactive</a></td>
                        @endif
                        <td><a style="border-radius:50px" class="btn btn-danger" href="{{url('/theme/settings/logo/delete')}}/{{$item->id}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

        </div>






        @section('addNewScript')

        @endsection






@endsection
