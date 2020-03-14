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





        <div class="row col-6">
                <div class="col">
                    <label for="digit">Digit</label>
                    <input id="digit" type="text" class="dig_gene form-control" placeholder="How Many Digit Of Pin ?">
                </div>
                <div class="col">
                    <label for="generate">Generate</label>
                    <input id="generate" type="text" class="dig_gene form-control" placeholder="How Many Pin You Want ?">
                </div>
            </div><br>
            <div class="row col-6">
                <button id="generateBtn" class="btn btn-success form-control" type="button">Generate</button>
            </div>





</div>










@section('addNewScript')
    <script>
        $(document).ready(function () {

            document.getElementById('generateBtn').disabled=true;
            $('.dig_gene').keyup(function () {
                checkInputs();
            });
            $('.dig_gene').change(function () {
                checkInputs();
            });



            $('#generateBtn').click(function () {
                let baseUrl = window.location.origin;
                let newUrl = "/saveNewSecurityPin";
                let extraData = "/"+$('#digit').val()+"/"+$('#generate').val();
                window.location.href = baseUrl+newUrl+extraData;
            });


            function checkInputs() {
                if ($('#digit').val() == null || $('#digit').val() == 0 || $('#generate').val() == null ||$('#generate').val() == 0) {
                    document.getElementById('generateBtn').disabled=true;
                }
                else{
                    document.getElementById('generateBtn').disabled=false;
                }
            }
        });
    </script>
@endsection
@endsection
