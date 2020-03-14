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
        Manage Hot Deal
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
                <h4>Add new Brand To Your List</h4>
                <input id="searchBrand" type="text" class="form-control" placeholder="Search Brand">
                <form action="{{Route('addNewHotDeal')}}" method="POST">
                    @csrf
                    <div class="m-b-0">
                        <select name="product" id="product" class="form-control" multiple="" data-role="tagsinput">
                        </select>
                    </div>
                    <div class="m-b-0">
                        <label for="rate"> Offer Rate (in percentage)</label>
                        <input class="form-control" type="number" name="rate" id="rate" placeholder="offer">
                    </div>
                    <div class="m-b-0">
                        <label for="stock"> Offer Stock</label>
                        <input placeholder="stock" class="form-control" type="number" name="stock" id="stock" >
                    </div>
                    <div class="m-b-0">
                        <label for="deadline"> Offer DeadLine </label>
                        <input placeholder="deadline" class="form-control" type="date" name="deadline" id="deadline" >
                    </div>
                    <div class="m-b-0">
                        <label for="deadline"> Offer DeadLine Time</label>
                        <input placeholder="deadline time" class="form-control" type="time" name="deadlinetime" id="deadlinetime" >
                    </div>
                    <div class="m-b-0">
                        <label for="deadline"> Select One</label>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="newInfo" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    New
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="newInfo" id="exampleRadios2" value="2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Regular
                                </label>
                                </div>
                    </div>
                <button class="btn btn-success form-control">Add to list</button>
                </form>
              </div>
            </div>
          </div>
        </div>


</div>


        <table class="table">
        <thead class="table-dark">
            <tr>
              <th scope="col">product</th>
            <th scope="col">Offer Rate (in percentage)</th>
            <th scope="col">Offer Stockth</th>
            <th scope="col">Offer DeadLineth</th>
            <th scope="col">Offer DeadLine Time</th>
            <th scope="col">Action </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allHotDeal as $item)
            <tr>
            <th scope="row">{{App\product::findOrFail($item->product)->product_name}}</th>
            <th scope="row">{{$item->rate}} %</th>
            <th scope="row">{{$item->stock}}</th>
            <th scope="row">{{$item->deadline}}</th>
            <th scope="row">{{$item->deadlinetime}}</th>

            <th>
                <a href="{{ url('hotDeal/Delete') }}/{{ $item->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </th>
            </tr>
          @endforeach
        </tbody>
        </table>







@section('addNewScript')
    <script>
        $('#searchBrand').keyup(e => {
                var searchData = $('#searchBrand').val();
                    // $('#show').val(searchData);

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                // alert(searchData.toLowerCase());

                $.ajax({
                type:'POST',
                url:'/getProductSearch',
                data: {searchData: searchData},
                    success: function (data) {
                        // $( "#company_upazilla" ).html(data);
                        // $('#productid').html(data);
                        $('#product').html(data);
                        // alert(data);
                    }
                });


        });
    </script>
@endsection






@endsection
