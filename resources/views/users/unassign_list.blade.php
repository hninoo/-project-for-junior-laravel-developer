@extends('layouts.admin')
@section('admin_view')
 
 <div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                                      <h4 class="card-title "><h5 class="text-center">To Assign List</h5></h4>
                      
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Time Plan</th>
                                <th>Role</th>
                                <th>Operation</th>
                              </tr>
                            </thead>
                            <tbody>
                               <?php
                                 $count=1;
                              ?>
                              @foreach($users as $user)
                              @if(empty($user['role']))
                								<tr>
                									<td>{{$count}}</td>
                  								<td>{{$user['account_name']}}</td>
                  								<td>{{$user['email']}}</td>	

                                  {!! Form :: open(array('url'=>'unassigned_user'))!!}
                                    <td>
                                      <input type="hidden" name="hideid" value="{{$user['id']}}">
                                      
                                      <select class="form-control" name="time_plan">
                                          <option selected>Choose...</option>
                                         @foreach($time_plans as $time_plan)
                                            <option value="{{$time_plan['id']}}">{{$time_plan['time_plan_name']}}</option>
    
                                         @endforeach
                                      </select>

                                      <div style="color: red !important;" align="center">{{$errors->first('time_plan_id')}}</div>

                                    </td>
                                    <td>
                                      
                                      <select class="form-control" name="role_name">
                                          <option selected>Choose...</option>
                                      @foreach($roles as $role)
                                        
                                            <option value="{{$role['id']}}">{{$role['role_name']}}</option>
    
                                      @endforeach
                                       </select>
                                       <div style="color: red !important;" align="center">{{$errors->first('role_id')}}</div>

                                    </td>	
                                    <td>

                                      <input type="submit" class="btn btn-outline-success" value="Assign">



                                      <a href="{{url('cancel/'.$user['id'])}}" class="btn btn-outline-success" style="margin-top: 7px;">Cancel</a>
                  								  </td>

                                  {!! Form :: close() !!}  

      								          </tr>
    								            <?php $count++ ?>
                                @endif
    						              @endforeach


                           
                          </tbody>
                        </table>
                  </div>
              
                </div>
              </div>
            </div>
	</div>


  <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Employee Lists</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          
                          <th>Name</th>
                          <th>Timeplan</th>
                          <th>Role</th>
                          <th>Operation</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                      @foreach($results as $result)
                        <tr>
                          
                          <td>{{$result['account_name']}}</td>

                          @foreach($time_plans as $time_plan)
                          <td >{{$time_plan['time_plan_name']}}</td>
                          @endforeach

                          @foreach($result['role'] as $role)
                          <td >{{$role['role_name']}}</td>
                          @endforeach

                          <td><a href="{{url('block/'.$result['id'])}}" class="btn btn-outline-success" onclick="return confirm('Are you sure to Block?')">Block</a>

                          <a href="{{url('assign/edit/'.$result['id'])}}" class="btn btn-outline-success">Edit</a>

                          </td>
                        </tr>
                        
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

@endsection