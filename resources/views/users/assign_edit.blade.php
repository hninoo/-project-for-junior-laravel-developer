@extends('layouts.admin')
@section('admin_view')
<div class="row justify-content-center">
		<div class="col-md-6 d-flex align-items-stretch grid-margin">
			<div class="row flex-grow">
				<div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title text-center"><h4>Assign Edit</h4></div>
                      
                      {{ Form::open(array('url' => 'assign/edit/'.$user['id'],'class'=>'forms-sample')) }}

                          
                      		<div class="form-group">
                      			<div class="row">
                      			   <div class="col-sm-6"><h5>User Name</h5></div>
                          			<div class="col-sm-6">
                          				<h5>{{$user['account_name']}}</h5>
                          			</div>	
                        		</div>
                      		</div>

                          <div class="form-group">
                            <div class="row">
                               <div class="col-sm-6"><h5>Email</h5></div>
                                <div class="col-sm-6">
                                  <h5>{{$user['email']}}</h5>
                                </div>  
                            </div>
                          </div>

                          <div class="form-group">
                              <div class="row">
                                   <div class="col-sm-6"><h5>Time Plan</h5></div>
                                   <div class="col-sm-6">
                                   <select name="timename" class="form-control">
                                      @foreach($time_plans as $time_plan)

                                           @if($time_plan['id']==$user['time_plan_id']) 
                                           <option value="{{$time_plan['id']}}" selected>
                                             
                                              {{$time_plan['time_plan_name']}}
                                           </option>
                                           @else
                                           <option value="{{$time_plan['id']}}">
                                               {{$time_plan['time_plan_name']}}
                                           </option>
                                            @endif
                                      @endforeach
                                      </select>
                                   </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="row">
                                   <div class="col-sm-6"><h5>Role</h5></div>
                                   <div class="col-sm-6">
                                   <select name="rolename" class="form-control">
                                      @foreach($roles as $role)

                                           @if($role['id']==$user['role_id']) 
                                           <option value="{{$role['id']}}" selected>
                                             
                                              {{$role['role_name']}}
                                           </option>
                                           @else
                                           <option value="{{$role['id']}}">
                                               {{$role['role_name']}}
                                           </option>
                                            @endif
                                      @endforeach
                                      </select>
                                   </div>
                              </div>
                          </div>

                          <div class="form-group" align="center"> 
                              <input type="submit" name="update" value="Update" class="btn btn-outline-success" >
                          </div>
                        
                        
                        
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
			</div>
		</div>
	</div>
@endsection