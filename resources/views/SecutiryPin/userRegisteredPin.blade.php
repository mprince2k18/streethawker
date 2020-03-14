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



    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Serial</th>
            <th scope="col">Pin</th>
            <th scope="col">User Email</th>
            <th scope="col">Registered</th>
            <th scope="col">Pin Created</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($registeredPin as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><h6>{{$item->pin}}</h6></td>
                <td><h6>{{App\User::find($item->registered_user_id)->email}}</h6></td>
                <td>{{$item->updated_at}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
            @empty
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            @endforelse
        </tbody>
      </table>
      {{ $registeredPin->links() }}


</div>










@section('addNewScript')

@endsection
@endsection
