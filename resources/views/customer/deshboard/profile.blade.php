    @extends('layouts.desh_app')
    @section('searchpanel')

    @endsection


    @section('pageHeading')
        Customer profile
    @endsection






    @section('desh_content')










    <div class="col-md-12 align-center">
    <div class="col-md-8">


    <div class="form-group">
        <label for="formGroupExampleInput">Name</label>
        <input readonly value="{{Auth::user()->name}}" type="text" name="yourName" class="form-control" id="formGroupExampleInput" placeholder="Your Name">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Email</label>
        <input readonly value="{{Auth::user()->email}}" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Company</label>
        <input readonly value="{{Auth::user()->company_or_industry}}" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
    </div>


        <form id="saveForm" action="{{route('saveProfile')}}" method="post">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Address</label>
                        <input required onkeyup="validateNow(event)" name="address" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                    </div>
                </div>
                <div class="col">
                    @if (App\CustomerInfo::where('userId',Auth::user()->id)->exists())
                        <label for="formGroupExampleInput2">Now Address</label>
                        <input class="form-control" type="text" readonly value="{{App\CustomerInfo::where('userId',Auth::user()->id)->first()->address}}">
                        @else
                        <label for="formGroupExampleInput2">Now Address</label>
                        <input class="form-control" type="text" value="No Address" readonly>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Phone</label>
                        <input required onkeyup="validateNow(event)" name="phone" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                    </div>
                </div>
                <div class="col">
                    @if (App\CustomerInfo::where('userId',Auth::user()->id)->exists())
                        <label for="formGroupExampleInput2">Now Phone</label>
                        <input class="form-control" type="text" readonly value="{{App\CustomerInfo::where('userId',Auth::user()->id)->first()->phone}}">
                        @else
                        <label for="formGroupExampleInput2">Now Phone</label>
                        <input class="form-control" type="text" value="No Phone" readonly>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                <label for="formGroupExampleInput2">Zip</label>
                <input required onkeyup="validateNow(event)"  name="zip" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                    </div>
                </div>
                <div class="col">
                    @if (App\CustomerInfo::where('userId',Auth::user()->id)->exists())
                        <label for="formGroupExampleInput2">Now Zip</label>
                        <input class="form-control" type="text" readonly value="{{App\CustomerInfo::where('userId',Auth::user()->id)->first()->zip}}">
                        @else
                        <label for="formGroupExampleInput2">Now Zip</label>
                        <input class="form-control" type="text" value="No Zip" readonly>
                    @endif
                </div>
            </div>

            <div class="form-group">
                    <button id="saveBtn" type="submit" class="btn btn-danger">Save Profile</button>
            </div>
        </form>

    </div>
    </div>











    @endsection






@section('addNewScript')
    {{-- <script>
        // const saveBtn = document.getElementById('saveBtn');
        const saveForm = document.getElementById('saveForm');
        const address = document.getElementById('address').value;
        const phone = document.getElementById('phone').value;
        const zip = document.getElementById('zip').value;

        saveForm.addEventListener('submit',function (e) {
            e.preventDefault();
            if (address == null || address==' ' || address=='') {
                const ele=document.createElement('li');
                ele.classList='list-group-itema alert alert-danger';
                ele.innerHTML=`<p>Fill Up All The Form Currectly</p>`;
                saveForm.insertBefore(ele,address);
                setTimeout(function () {
                    document.querySelector('.alert').remove();
                },2000);
            }
        });
    </script> --}}
@endsection
