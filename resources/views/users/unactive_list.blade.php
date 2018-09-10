@extends('layouts.admin')
@section('admin_view')

<div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Blocked User Lists</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          
                          <th>Name</th>
                          <th>Timeplan</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Operation</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                      @foreach($users as $user)
                      @if(!empty($user['role']))
                        <tr>
                          
                          <td>{{$user['account_name']}}</td>


                          @foreach($time_plans as $time_plan)
                          <td >{{$time_plan['time_plan_name']}}</td>
                          @endforeach

                         <td>{{$user['email']}}</td>
                         <td>{{$user['role'][0]['role_name']}}</td>
                         <td><a href="{{url('reactive/'.$user['id'])}}" class="btn btn-outline-success">Active</a></td>
                        </tr>
                    @endif  
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

@endsection