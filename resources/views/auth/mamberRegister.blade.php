

@extends('layouts.front_app')

@section('allContentHere')
        <!-- Breadcrumb Start -->
        <h1>Member Registration</h1>
        <div class="breadcrumb-area mt-30">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="d-flex align-items-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="register.html">Register</a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Breadcrumb End -->
       <!-- Register Account Start -->
        <div class="register-account ptb-100 ptb-sm-60">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="register-title">
                            <h3 class="mb-10">REGISTER ACCOUNT</h3>
                            <p class="mb-10">If you already have an account with us, please login at the login page.</p>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-register"  method="POST" action="{{ route('memberRegisterPost') }}">
                        @csrf
                            <fieldset>
                                <legend>Your Personal Details</legend>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="f-name"><span class="require">*</span>Full Name</label>
                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter Your Full Name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="l-name"><span class="require">*</span>Email Address</label>
                                    <div class="col-md-10">
                                        <input placeholder="Your Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="company_or_industry"><span class="require">*</span>Company or industry</label>
                                    <div class="col-md-10">
                                        <input placeholder="Your Company" id="company_or_industry" type="company_or_industry" class="form-control @error('company_or_industry') is-invalid @enderror" name="company_or_industry" value="{{ old('company_or_industry') }}" required autocomplete="company_or_industry">

                                        @error('company_or_industry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="address"><span class="require">*</span>Address</label>
                                    <div class="col-md-10">
                                        <input placeholder="Address" id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="zip"><span class="require">*</span>ZIP</label>
                                    <div class="col-md-10">
                                        <input placeholder="zip" id="zip" type="zip" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}" required autocomplete="zip">

                                        @error('zip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="phone"><span class="require">*</span>Phone</label>
                                    <div class="col-md-10">
                                        <input placeholder="phone" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>




                            </fieldset>





                            <fieldset>
                                <legend>Your Password</legend>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="password"><span class="require">*</span>Password:</label>
                                    <div class="col-md-10">
                                        <input placeholder="Type Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="control-label col-md-2" for="password-confirm"><span class="require">*</span>Confirm Password</label>
                                    <div class="col-md-10">
                                        <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </fieldset>
                            {{-- <fieldset class="newsletter-input">
                                <legend>Newsletter</legend>
                                <div class="form-group d-md-flex align-items-md-center">
                                    <label class="col-md-2 control-label">Subscribe</label>
                                    <div class="col-md-10 radio-button">
                                         <label class="radio-inline"><input type="radio" name="optradio">Yes</label>
                                         <label class="radio-inline"><input type="radio" name="optradio">No</label>
                                    </div>
                                </div>
                            </fieldset> --}}
                            <div class="terms">
                                <div class="float-md-right">
                                    {{-- <span>I have read and agree to the <a href="#" class="agree"><b>Privacy Policy</b></a></span> --}}
                                    {{-- <input type="checkbox" name="agree" value="1"> &nbsp; --}}
                                    <input type="submit" value="Continue" class="return-customer-btn">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Register Account End -->
@endsection
