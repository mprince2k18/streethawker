


@extends('layouts.front_app')

@section('allContentHere')








  {{-- <div class="container"> --}}
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Register') }}</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('vendorRegisterPost') }}">
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
                              <label for="mothersName" class="col-md-4 col-form-label text-md-right">{{ __('MothersName') }}</label>

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
                              <label for="dateOfBirth" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

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
                              <label for="nomenyName" class="col-md-4 col-form-label text-md-right">{{ __('Nomeny Name') }}</label>

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
                              <label for="nomenyRelation" class="col-md-4 col-form-label text-md-right">{{ __('Nomeny Relation') }}</label>

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
                              <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                              <div class="col-md-6">
                                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                  @error('phone')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="zip" class="col-md-4 col-form-label text-md-right">{{ __('zip') }}</label>

                              <div class="col-md-6">
                                  <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}" required autocomplete="zip" autofocus>

                                  @error('zip')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                              <div class="col-md-6">
                                  <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                  @error('address')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="company_or_industry" class="col-md-4 col-form-label text-md-right">{{ __('Company or industry') }}</label>

                              <div class="col-md-6">
                                  <input id="company_or_industry" type="text" class="form-control @error('company_or_industry') is-invalid @enderror" name="company_or_industry" value="{{ old('company_or_industry') }}" required autocomplete="company_or_industry" autofocus>

                                  @error('company_or_industry')
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
  {{-- </div> --}}








@endsection
