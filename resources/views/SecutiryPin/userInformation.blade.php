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
User Detail Information
@endsection
@section('desh_content')









<div class="col-12">



    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">User Name</th>
            <th scope="col">User Email</th>
            <th scope="col">fathersName</th>
            <th scope="col">mothersName</th>
            <th scope="col">NID</th>
            <th scope="col">dateOfBirth</th>
            <th scope="col">nomenyName</th>
            <th scope="col">nomenyRelation</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($UserInformation as $item)
            <tr>
                <td>{{App\User::find($item->userId)->name}}</td>
                <td>{{App\User::find($item->userId)->email}}</td>
                <td>{{$item->fathersName}}</td>
                <td>{{$item->mothersName}}</td>
                <td>{{$item->NID}}</td>
                <td>{{$item->dateOfBirth}}</td>
                <td>{{$item->nomenyName}}</td>
                <td>{{$item->nomenyRelation}}</td>
            </tr>
            @empty
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            @endforelse
        </tbody>
      </table>
      {{ $UserInformation->links() }}


</div>










@section('addNewScript')

@endsection
@endsection
