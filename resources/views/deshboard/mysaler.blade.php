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
    All My Saler
@endsection
@section('desh_content')









<div class="col-10">



        <!--Trigger-->
        <a class="btn btn-primary" href="#" data-target="#login" data-toggle="modal"><i class="fa fa-plus"></i> New Saler</a>

        <div id="login" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <h4>Add new Saler</h4>
              <form enctype="multipart/form-data" action="{{ Route('addNewSaler') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>User Name</label>
                    <input value="{{old('user_name')}}" name="user_name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="{{old('email')}}" name="email" type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Company/Industry</label>
                    <input required value="{{old('company_or_industry')}}" name="company_or_industry" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter company orindustry">
                </div>
                <div class="form-group">
                    <label>Default Password</label>
                    <input value="salerDefPNew" name="password" type="text" class="form-control"  aria-describedby="emailHelp" readonly>
                </div>
                {{-- <div class="form-group">
                    <label>Select category</label>
                    <select name="category" class="form-control" id="exampleFormControlSelect1">
                        <option value="3">Admin</option>
                        <option value="2">Saler</option>
                        <option value="1">Customer</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label>Approvl</label>
                    <select name="approval" class="form-control" id="exampleFormControlSelect1">
                        <option value="2">Approve</option>
                        <option value="1">Waiting</option>
                        <option value="0">Band</option>
                    </select>
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
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">role</th>
                    <th scope="col">approval</th>
                    <th scope="col">Account Created</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allSler as $item)
                    <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                        @if ($item->role == 2)
                            <p class="label label-muted">Saler</p>
                        @elseif($item->approval == 3)
                            <p class="label label-muted">Admin</p>
                        @else
                            {{-- <p class="label label-danger">Customer</p> --}}
                        @endif
                    </td>
                    <td>
                        @if ($item->approval == 0)
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="caret"><span class="label label-danger">Banded</span></span>
                           </a>

                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               <a class="dropdown-item" href=" {{__('salerApproval')}}/{{$item->id}}/2 ">
                                   {{ __('Approve') }}
                               </a>
                               <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/1">
                                   {{ __('Waiting') }}
                               </a>
                               <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/0">
                                   {{ __('Band') }}
                               </a>
                           </div>
                        @elseif($item->approval == 2)
                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="caret"><span class="label label-success">Approved</span></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                                <a class="dropdown-item" href=" {{__('salerApproval')}}/{{$item->id}}/2 ">
                                    {{ __('Approve') }}
                                </a>
                                <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/1">
                                    {{ __('Waiting') }}
                                </a>
                                <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/0">
                                    {{ __('Band') }}
                                </a>
                            </div>
                        @else

                                <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <span class="caret"><span class="label label-warning">Waiting</span></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href=" {{__('salerApproval')}}/{{$item->id}}/2 ">
                                        {{ __('Approve') }}
                                    </a>
                                    <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/1">
                                        {{ __('Waiting') }}
                                    </a>
                                    <a class="dropdown-item" href="{{__('salerApproval')}}/{{$item->id}}/0">
                                        {{ __('Band') }}
                                    </a>
                                </div>

                        @endif
                    </td>
                    <td>{{$item->created_at->diffForHumans()}}</td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this saler?');" href="{{__('deleteSaler')}}/{{$item->id}}">Delete</a></td>
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
                {{-- {{ $allproduct->links() }} --}}
        </div>
        <ul>
            <li>Role 1 costomer</li>
            <li>Role 2 Saler</li>
            <li>Role 3 Admin</li>
            <br>
            <li>Approval 0 Account banded</li>
            <li>Approval 1 Account waiting for saler</li>
            <li>Approval 2 Account Approved for saler</li>
        </ul>



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

    @endsection






@endsection
