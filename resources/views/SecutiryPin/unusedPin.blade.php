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
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($unUsedPin as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><h6>{{$item->pin}}</h6></td>
                <td>{{$item->created_at}}</td>
                <td><button type="submit" onclick="removePin({{$item->id}})" class="btn btn-danger">Remove</button></td>
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
      {{ $unUsedPin->links() }}


</div>




@section('addNewScript')
    <script>
        function removePin(pinId){
            var r = confirm("Are you sure you want to delete this Pin ?");
            if (r == true) {
                let baseUrl = window.location.origin;
                let newUrl = baseUrl+"/removePin/"+pinId;
                window.location.href = newUrl;
            }
        }
    </script>
@endsection
@endsection
