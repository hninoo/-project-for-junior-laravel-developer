@extends('layouts.app')
@section('user')
  
<div class="row">
    <div class="col-md-4 float-left">
  
      <div style="background:#fff;" align="center">
        <img src="{{url('template/image/logonw.jpg')}}" width="250" height="250">
        
      </div>
</div>
    <div class="col-md-6 float-right">
      {!! Form :: open(array('url'=>'change_pass/'.$res['id']))!!}

          <input type="hidden" name="dbpassword" value="{{$res['password']}}">

            <table class="table">
              <tr class="p-info">
                <td class="col-md-4"><b>Current Password</b></td>
                <td class="col-md-6">
                  <input type="password" name="current_pass" class="form-control" placeholder="Current Password" required>
                </td>
              </tr>
              <tr class="p-info">
                <td class="col-md-4"><b>New Password</b></td>
                <td class="col-md-6">
                  <input type="password" name="new_pass" class="form-control" placeholder="New Password" required>
                </td>
              </tr>
              <tr class="p-info">
                <td class="col-md-4"><b>Confirm New Password</b></td>
                <td class="col-md-6">
                  <input type="password" name="conf_pass" class="form-control" placeholder="Confirm New Password" required>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <button type="button" class="btn btn-default" id="pw_cancle">Cancle</button>
                  <button type="submit" class="btn btn-primary">Change</button>
                </td>
              </tr>
            </table>
          
      {!! Form :: close() !!}
    </div>  
</div>
@endsection  
