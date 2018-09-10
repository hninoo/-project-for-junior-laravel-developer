@extends('layouts.app')
@section('user')
<div class="card">
		<div class="container" >

			<div class="row justify-content-center">
					<div  class="col-md-8 col-md-offset-2 form">
						<div class="row " >

				          <div class="col-md-4">
				            <img src="{{url('template/image/logo.png')}}" width="150" height="150">
				          </div>

				          <div class="col-md-8 header">
				            <h4>နယူးဝက်(စ်)မင်စတာကုမ္ပဏီလီမိတက်</h4>
				            <h4>New Westminister Co. Ltd.</h4>
				            <p>Enterprise Software Services</p>
				            <p>အမှတ်(၃-ဘီ)၊တိုက်အမှတ်(၂၇၀)၊ပြည်လမ်း၊စမ်းချောင်းမြို့နယ်၊ရန်ကုန်မြို့</p>
				            <p>(Tel)09 300 49508</p>
				          </div>

			        	</div>

			        	<div class="container" style="margin-top:20px;">
				        	<div class="row">
				         
				              <div class="col-md-4">Name of Applicant</div>
				              <div class="col-md-8">{{$leave_res['account_name']}}</div>
				        	</div>

				        	<div class="row">
				         
				              <div class="col-md-4">Position</div>
				              <div class="col-md-8">{{$leave_res['role_name']}}</div>
				        	</div>
	            

	        			</div>

	        			<div class="container" style="margin-top:20px;">
						        <div class="row">
						            <div class="col-md-4">Leave Applied For</div>
						              <p id="reason"></p>
						            <div class="col-md-8">

						                {{$leave_res['reason']}}
						            </div>
						          
						        </div>

	        						<hr style="border: solid 1px;">
						        <ul>
						              <li>Please attach copies of relevant documents in support of this application.</li>
						        </ul>
	    				</div>

	    				<div class="row">
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
				                      <span>{{$leave_res['start_date']}}</span>
				                    </td>
				                    <td>
				                      <span>{{$leave_res['end_date']}}</span>
				                    </td>
				                    <td>
				                      <span>{{$leave_res['number_of_day']}}</span>
				                    </td>
				                </tr>
				              </tbody>
	            			</table>
	        			</div>

	        			<div class="row print-row">

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

	        			<div class="row print-row">
				            <div >
				                <div class="row " id="pre" >
				                    <div>

				                      <pre>
Name        : __________________

Signature   : __________________

Designation : __________________
				                      </pre>
				                	</div>
                                     
                  				</div>

							</div>
							<div>
								
			</div>
			<div class="row">
				<div >
				    <span>Approved</span>
				        <div style="width:50px;height:20px;border:1px solid #000;"></div>
				</div>
				&nbsp &nbsp
				 <div>
				    <span>Not Approved</span>
				        <div style="width:50px;height:20px;border:1px solid #000;"></div>
				 </div>
            </div>
		</div>
	</div>

</div>

@endsection