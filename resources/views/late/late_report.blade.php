<!--   akt -->
@extends('layouts.app')
@section('user')



{!! Form :: open(array('url'=>'reprint_late/'.$late_res['check_id'],'id'=>'toprint'))!!}


  <div class="container" >
  <div class="row" >
    <div >
      <div align="center" >
        <h4>NEW WESTINISTER CO.,LTD</h4>
              <h3>Explanation Form</h3>
      </div>

          <div class="row " id ="font_more" style="padding: 40px;">
                  <p align="justify-content-center" id="size" style="font-size:25px;line-height: 40px;">
                    New Westminister Co., Ltd, တြင္ <b>{{$user['role_name']}}</b>  အျဖစ္ တာ၀န္ထမ္းေဆာင္ေနေသာ ၀န္ထမ္း <b>{{$user['account_name']}}</b>  သည္  <b>{{$late_res['date']}}</b> ေန႔ရက္  <b>{{$late_res['check_in_time']}}</b>   အခ်ိန္မွ  ရံုးသို႔  ေအာက္ေဖာ္ျပပါ အေၾကာင္းအရာေၾကာင့္ ေနာက္က်ေရာက္ရွိခဲ့ပါသည္။
                  </p>
          </div>
          
          <div class="col-md-12">
              <div class="form-group" style="padding:40px">
                <div class="input-group">
                    
                      <label style="font-size: 25px;line-height: 40px;" class="col-md-6" align="center">ရံုးေနာက္က်ျခင္းအေၾကာင္းအရာ</label>

                      @if(empty($late_res['late']))

                          <input type="text" class="form-control" name="reason" id="reason" style="border-color:red;border-radius:3px;font-size: 25px">

                      @else

                          <input type="text" class="form-control" name="reason" id="reason" style="border-color:red;border-radius:3px;font-size: 25px" value="{{$late_res['late'][0]['reason']}}">
                         
                      @endif
                      
                </div>
   
              </div>

                    <input type="hidden" name="hide_check_id" value="{{$late_res['check_id']}}">

                  <div class="row" id="pre" style="padding-right:40px;float:right">
                       <div class="jumbotron" align="right">

                         <pre style="float:right">
                          ၀န္ထမ္းလက္မွတ္ :  _________________________

                          ေန႔ရက္ &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp_________________________
                          </pre>
                       
                      </div>

                  </div>     
          </div>  
    </div>
  </div>
        <div class="row justify-content-center">
          <div>
             
            
              <input type="submit" class="btn btn-outline-success" style="height:100px;font-size: 32px;width:200px" value="Print" id="btn" onclick="return doPrint();">


          </div>
        </div> 
</div>

{!! Form :: close() !!}

<script>

function doPrint() {
  var reason = document.getElementById('reason'),
  btn=document.getElementById('btn');
  reason.style.border = "none";
  btn.style.display = "none";
//  document.getElementById("toprint").style.margin = "auto";
  document.getElementById("toprint").style.padding = "20px 20px 20px 20px";//edit for ptinting display
  document.getElementById("pre").style.paddingTop = "100px";

  $("#toprint").trigger("submit");
  $("#toprint").submit(
    window.print()
  );
}
</script>
@endsection