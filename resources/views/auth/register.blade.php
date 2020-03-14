{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="securityPin" class="col-md-4 col-form-label text-md-right">{{ __('Security pin') }}</label>

                            <div class="col-md-6">
                                <input id="securityPin" type="text" class="form-control @error('securityPin') is-invalid @enderror" name="securityPin" value="{{ old('securityPin') }}" required autocomplete="securityPin" autofocus>

                                @error('securityPin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fathersName" class="col-md-4 col-form-label text-md-right">{{ __('Fathers Name') }}</label>

                            <div class="col-md-6">
                                <input id="fathersName" type="text" class="form-control @error('fathersName') is-invalid @enderror" name="fathersName" value="{{ old('fathersName') }}" required autocomplete="fathersName" autofocus>

                                @error('fathersName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mothersName" class="col-md-4 col-form-label text-md-right">{{ __('mothersName') }}</label>

                            <div class="col-md-6">
                                <input id="mothersName" type="text" class="form-control @error('mothersName') is-invalid @enderror" name="mothersName" value="{{ old('mothersName') }}" required autocomplete="mothersName" autofocus>

                                @error('mothersName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="NID" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

                            <div class="col-md-6">
                                <input id="NID" type="text" class="form-control @error('NID') is-invalid @enderror" name="NID" value="{{ old('NID') }}" required autocomplete="NID" autofocus>

                                @error('NID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateOfBirth" class="col-md-4 col-form-label text-md-right">{{ __('dateOfBirth') }}</label>

                            <div class="col-md-6">
                                <input id="dateOfBirth" type="date" class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required autocomplete="dateOfBirth" autofocus>

                                @error('dateOfBirth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomenyName" class="col-md-4 col-form-label text-md-right">{{ __('nomenyName') }}</label>

                            <div class="col-md-6">
                                <input id="nomenyName" type="text" class="form-control @error('nomenyName') is-invalid @enderror" name="nomenyName" value="{{ old('nomenyName') }}" required autocomplete="nomenyName" autofocus>

                                @error('nomenyName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomenyRelation" class="col-md-4 col-form-label text-md-right">{{ __('nomenyRelation') }}</label>

                            <div class="col-md-6">
                                <input id="nomenyRelation" type="text" class="form-control @error('nomenyRelation') is-invalid @enderror" name="nomenyRelation" value="{{ old('nomenyRelation') }}" required autocomplete="nomenyRelation" autofocus>

                                @error('nomenyRelation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}








@extends('layouts.front_app')

@section('allContentHere')
        <!-- Breadcrumb Start -->
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
                        <form class="form-register"  method="POST" action="{{ route('register') }}">
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
                        <a href="{{ url('auth/google') }}" class="return-customer-btn">Register With Google</a>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Register Account End -->
@endsection
