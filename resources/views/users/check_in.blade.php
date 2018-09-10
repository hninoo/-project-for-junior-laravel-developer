@extends('layouts.home')
@section('home_view')
<div >
  <div>
    <div class="row justify-content-center" style="margin-top:90px">
    <div class="col-md-6 ">
      <div>
        <div class="col-12">
                  <div class="card">
                    <div class="card-body" style="background-color:#dedef0;">
                      <h4 class="card-title text-center">Enter Password</h4>
                      
                      {{ Form::open(array('url' => 'checkin/'.$users['id'],'class'=>'forms-sample')) }}
                      @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                      @endif
                      <input type="hidden" name="hidden_email" value="{{$users['email']}}">

                          <div class="form-group">
                            <div class="row">
                                
                                <div class="col-sm-4">
                                  <label >{{$users['account_name']}}</label>
                                </div>
                                

                                <div class="col-sm-6">
                                  <input type="password" class="form-control"  placeholder="Password" name="password">
                                </div>
                                
                            </div>
                          </div>
                        
                        <center><input type="submit" class="btn btn-success mr-2" value="Save"></center>
                      
                      
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
      </div>
    </div>
  </div>
  </div>
</div>

  @endsection