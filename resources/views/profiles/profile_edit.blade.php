@extends('layouts.app')
@section('user')
<div class="col-md-4 float-left">
  
      <div style="background:#fff;" align="center">
        <img src="{{url('template/image/logonw.jpg')}}" width="250" height="250">
        
      </div>
    
</div>
{!! Form :: open(array('url'=>'profile/edit/'.$data['id']))!!}
<div class="col-md-6 float-right" >

            <div class="row " style="padding-left: 150px;">
                <img src="{{url('template/image/profile.png')}}" width="140" height="140">
            </div>
       <div class="row" id="ur_info_row"  style="margin-top: 20px;">

            

          <table class="table">
            <tr class="p-info">
              <td><span><b>Name</b></span></td>
              <td>
                <input type="text" name="uname" value="{{$data['account_name']}}" class="form-control">
               
            </tr>
            <tr class="p-info">
              <td><span><b>Phone</b></span></td>
              <td>
                <input type="text" name="phone" value="{{$data['phone']}}" class="form-control">
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Email</b></span></td>
              <td>
                <span id="info3">{{$data['email']}}</span>
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>NRC</b></span></td>
              <td>
                <input type="text" name="nrc" value="{{$data['nrc']}}" class="form-control">
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Date of Birth</b></span></td>
              <td>
                 <input type="date" name="dob" value="{{$data['dob']}}" class="form-control">
                
              </td>
            </tr>
            <tr class="p-info">
              <td><span><b>Address</b></span></td>
              <td>
                <textarea name="address" row="3" class="form-control">{{$data['address']}}</textarea>
                
              </td>
            </tr>


          </table>

    </div>
{!! Form :: close() !!}
    <div class="row">
       <input type="submit" name="save" value="Save" class="btn btn-outline-success">
    </div>
</div>
   

@endsection
