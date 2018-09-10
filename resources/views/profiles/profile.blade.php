@extends('layouts.app')
@section('user')
<div class="col-md-4 float-left">
  
      <div style="background:#fff;" align="center">
        <img src="{{url('template/image/logonw.jpg')}}" width="250" height="250">
        
      </div>
    
</div>
<div class="col-md-6 float-right" >
           {{ Form::open(array('url' => 'signin')) }}
                @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                @endif

            <div class="row " style="padding-left: 150px;">
                <img src="{{url('template/image/profile.png')}}" width="140" height="140">
            </div>
       <div class="row" id="ur_info_row"  style="margin-top: 20px;">

            

          <table class="table">
            <tr class="p-info">
              <td><span><b>Name</b></span></td>
              <td>
                <span id="info1">{{$user_data['account_name']}}</span>
               
            </tr>
            <tr class="p-info">
              <td><span><b>Phone</b></span></td>
              <td>
                <span id="info2">{{$user_data['phone']}}</span>
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Email</b></span></td>
              <td>
                <span id="info3">{{$user_data['email']}}</span>
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>NRC</b></span></td>
              <td>
                <span id="info4">{{$user_data['nrc']}}</span>
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Date of Birth</b></span></td>
              <td>
                <span id="info5">{{$user_data['dob']}}</span>
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Address</b></span></td>
              <td>
                <span id="info6">{{$user_data['address']}}</span>
                
              </td>
            </tr>


          </table>
          

    </div>
    <div class="row">
       <a href="{{url('profile/edit/'.$user_data['id'])}}" class="btn btn-danger">Edit</a>
       &nbsp &nbsp &nbsp
       <a class="btn btn-primary" href="{{url('change_pass/'.$user_data['id'])}}">Change Password</a>
    </div>
</div>
   

@endsection
