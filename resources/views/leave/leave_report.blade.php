@extends('layouts.leave')
@section('leave')
<style type="text/css">
  .container
  {
    font-size: 18px ! important;
  }
  p 
  {
    font-size: 18px ! important;
  }
  li
  {
    font-size: 18px ! important;
  }
</style>

<link rel="stylesheet" href="{{ asset('template/css/toprint.css') }}">

<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">

<script src="{{asset('js/jquery-bootstrap-datepicker.js')}}"></script>

<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

{!! Form :: open(array('url'=>'leave_report','class'=>'printPreview','id'=>'toPrint'))!!}

<input type="hidden" name="status_id" value="{{$status['id']}}">

<div class="container">
 
    <div class="row justify-content-center" >
      <div class="col-md-3 col-md-offset-3" align="center">

        <input type="submit" class="btn btn-warning" value="Print Out and Request Form"  id="this" onclick="doPrint()">
      </div>
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <div class="col-md-3" align="center">
      
          <button onclick="hide()" id="preview_btn" type="button" class="btn btn-primary">Preview</button>

          <button onclick="show()" id="fill_btn" type="button" class="btn btn-primary" style="display:none;">
            Fill Again
          </button>
       </div>
    </div>
  
  <div class="row">

  
    <div class="leave_form form">

      <!-- Title row -->
        <div class="row" style="margin-top:20px;">
     
          <div class="row ">
              <div class="col-md-6 img">
              
                <img src="{{url('template/image/logo.png')}}" width="150" height="150" alt="Logo">
               
              </div>

              <div class="col-md-6 header" >
                <h3>နယူးဝက္(စ္)မင္စတာကုမၸဏီလီမိတက္</h3>
                <h3>New Westminister Co. Ltd.</h3>
                <p>Enterprise Software Services</p>
                <h5>အမွတ္(၃ဘီ)၊တိုက္အမွတ္(၂၇၀)၊ျပည္လမ္း၊စမ္းေခ်ာင္းၿမိဳ႕နယ္၊ရန္ကုန္ၿမိဳ႕</h5>
                <p>(Tel)09 300 49508</p>
              </div>
          </div>

        </div>

    </div>
     


     
    <div class="container" style="margin-top:20px;">

        <div class="row">
         
              <div class="col-md-4"><h4>Name of Applicant</h4></div>
              <div class="col-md-8">{{$leave_users['account_name']}}</div>
        </div>

        <div class="row">
         
              <div class="col-md-4"><h4>Position</h4></div>
              <div class="col-md-8">{{$leave_users['role'][0]['role_name']}}</div>
        </div>

    </div>

     
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-4"><h4>Leave Applied For</h4></div>
              <p id="reason"></p>
            <div class="col-md-8">

                <input type="text" class="form-control" name="reason" id="input_reason" style="border-color:black;border-radius:2px;font-size:20px;" placeholder="Reason for taking a leave">
            </div>
          
        </div>

        <hr style="border: solid 1px;">
        <ul>
              <li>Please attach copies of relevant documents in support of this application.</li>
        </ul>
    </div>

     
    <div class="container ">
        <table class="table table-bordered">
              <thead>
                <tr>
                  <td>From</td>
                  <td>To</td>
                  <td>Numbers of day</td>
                </tr>
              </thead>
                <tbody>
                  <tr>
                    <td>
                      <span id="from_date"></span>
                      <div class="col-sm-12 input-group date" id="from_div">

                        
                        <input class="form-control"  style="font-size:20px"type="text" name="from_date" id="input_from" placeholder="from date" data-date-format='yy-mm-dd'>
                        
                        <span style="display:none;" class="input-group-addon col-sm-3"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </td>
                    <td>
                      <span id="to_date"></span>
                      <div class="col-sm-11 input-group date from_control" id="to_div">
                        
                          <input class="form-control" style="font-size:20px" type="text" name="to_date" id="input_to" placeholder="to date" data-date-format='yy-mm-dd'>
                         
                        <span style="display:none;" class="input-group-addon col-sm-3"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </td>
                    <td>
                      <span id="num_of_days"></span>

                      <div id="radio_btns">
                        <input type="radio" name="rdb" id="rdb1" value="1">
                        <label id="lbl1">Full Day</label><br>
                        <input type="radio" name="rdb" id="rdb2" value="09:00AM - 01:00PM">
                        <label id="lbl2">Morning Half Day</label><br>
                        <input type="radio" name="rdb" id="rdb3" value="01:00PM - 05:00PM">
                        <label id="lbl3">Evening Half Day</label>
                      </div>

                      <input type="hidden" name="num_of_days" id="input_num_days">
                      

                    </td>
                  </tr>
                </tbody>
        </table>
                  

    </div>

      <div class="container">
        <div class="row print-row" style="margin-top: 38px;">

            <div class="col-md-6 colum-6">
              <hr style="border: solid 1px;">
              <p>Applicant's Signature</p>
            </div>

            <div class="col-md-6 colum-6">
              <p id="today"></p>
              <hr style="border: solid 1px;">
              <p>Date</p>
            </div>

        </div>
      <hr style="border: dotted 1px;">

      <div class="container">
        <p>*For HR Use</p>
          <div class="row print-row">
              
                 
                    

                      <pre>
Name        : _________________________

Signature   : _________________________

Designation : _________________________
                      </pre>
                      &nbsp &nbsp &nbsp &nbsp &nbsp
                  <div class="row">
                    <div >
                         <span>Approved</span>
                        <div style="width:50px;height:20px;border:1px solid #000;"></div>
                    </div>
                        &nbsp  &nbsp &nbsp
                     <div >
                         <span>Not Approved</span>
                        <div style="width:50px;height:20px;border:1px solid #000;"></div>
                    </div>
                </div>
          </div>
</div>
</div>
</div>


</div>
{!! Form :: close() !!}

<script type="text/javascript">

function show() {
  document.getElementById('input_reason').type = "text";
  document.getElementById('input_from').type = "text";
  document.getElementById('input_to').type = "text";
  document.getElementById('from_div').style.display = "block";
  document.getElementById('to_div').style.display = "block";
  document.getElementById('preview_btn').style.display = "block";
  document.getElementById('fill_btn').style.display = "none";
  document.getElementById('radio_btns').style.display = "block";
}

function hide() {//akt change
  var reason = document.getElementById('input_reason'),
      from_date = document.getElementById('input_from'),
      to_date = document.getElementById('input_to'),
      show_btn = document.getElementById('preview_btn'),
      hide_btn = document.getElementById('fill_btn'),
      total_days = parseInt( ( ( new Date(to_date.value) - new Date(from_date.value) ) / (1000*24*3600) ) + 1 ),
      rdb1 = document.getElementById('rdb1'),
      rdb2 = document.getElementById('rdb2'),
      rdb3 = document.getElementById('rdb3'),
      lbl1 = document.getElementById('lbl1'),
      lbl2 = document.getElementById('lbl2'),
      lbl3 = document.getElementById('lbl3');

  document.getElementById('reason').innerHTML = reason.value;
  document.getElementById('from_date').innerHTML = from_date.value;
  document.getElementById('to_date').innerHTML = to_date.value;
  if(total_days != 1)
  {
    document.getElementById('num_of_days').innerHTML = total_days;
    document.getElementById('input_num_days').value = total_days;
  }else {
      if(document.getElementById('rdb2').checked)
      {
          document.getElementById('num_of_days').innerHTML = "1/2 (" + document.getElementById('rdb2').value + ")";
            document.getElementById('input_num_days').value = 0.5;
      }else if(document.getElementById('rdb3').checked)
      {
          document.getElementById('num_of_days').innerHTML = "1/2 (" + document.getElementById('rdb3').value + ")";
            document.getElementById('input_num_days').value = 0.5;
      }else if(document.getElementById('rdb1').checked)
      {
          document.getElementById('num_of_days').innerHTML = total_days;
            document.getElementById('input_num_days').value = total_days;
      }

  }

  document.getElementById('to_div').style.display = "none";
  document.getElementById('from_div').style.display = "none";

  document.getElementById('radio_btns').style.display = "none";

  reason.type = "hidden";
  from_date.type = "hidden";
  to_date.type = "hidden";
  show_btn.style.display = "none";
  hide_btn.style.display = "block";
}
</script>
<script type='text/javascript'>
function doPrint() {
  $("#toPrint").trigger("submit");
  $('#this').hide();
  $('#preview_btn').hide();
  $('#fill_btn').hide();
  $("#toPrint").submit(
    window.print()
  );
}
</script>


<script type='text/javascript'>

$( document ).ready(function() {
    $(".col-sm-12.date").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $(".col-sm-11.date").datepicker({ 
        format: 'yyyy-mm-dd'
    });
}); 
</script>

@endsection
