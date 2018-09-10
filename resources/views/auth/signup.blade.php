@extends('layouts.home')
@section('home_view')
 
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <h2 class="text-center mb-4" style="margin-top: 40px;">Register</h2>
            <div class="auto-form-wrapper">
              {{ Form::open(array('url' => 'signup')) }}
                <div class="form-group">
                  <div class="input-group">
                    
                        <label class="col-sm-4 col-form-label text-md-right">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="account_name" value="{{old('account_name')}}">
                        <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                  
                    </div>
                          
                  </div>

                </div>
                <div style="color: red !important;" align="center">{{$errors->first('account_name')}}</div>

                
                <div class="form-group">
                  <div class="input-group">
                    
                        <label class="col-sm-4 col-form-label text-md-right">Email</label>
                        <input type="email" class="form-control" placeholder="email@gmail.com" name="email" value="{{old('email')}}">
                        <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                  
                    </div>
                    
                  </div>
                </div>

                <div style="color: red !important;" align="center">{{$errors->first('email')}}</div>

                <div class="form-group">
                  <div class="input-group">
                  <label class="col-sm-4 col-form-label text-md-right">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                   
                  </div>
                </div>
                <div style="color: red !important;" align="center">{{$errors->first('password')}}</div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>

                  </div>
                </div>

                 <div class="form-group">
                  <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{old('phone')}}">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                   
                  </div>
                </div>
                <div style="color: red !important;" align="center">{{$errors->first('phone')}}</div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">Nrc</label>
                    <input type="text" class="form-control" placeholder="Nrc" name="nrc" value="{{old('nrc')}}">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                   
                  </div>
                </div>
                <div style="color: red !important;" align="center">{{$errors->first('nrc')}}</div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">Date of birth</label>
                    <input type="date" class="form-control"  name="dob" value="{{old('dob')}}">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                   
                  </div>
                </div>

                <div style="color: red !important;" align="center">{{$errors->first('dob')}}</div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">Address</label>
                    <!-- <textarea class="form-control" name="address"></textarea> -->
                      <input type="text" class="form-control" name="address" value="{{old('address')}}">
                      <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                   
                  </div>
                </div>
                <div style="color: red !important;" align="center">{{$errors->first('address')}}</div>

                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Register</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="{{url('signin')}}" class="text-black text-small">Login</a>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
 
@endsection
  