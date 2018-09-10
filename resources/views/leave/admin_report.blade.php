@extends('layouts.admin')
@section('admin_view')

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                	<div class="table-responsive">
	                    <table class="table" id="example">
		                      	<thead>
			                        <tr>
			                          <th>No</th>
			                         
			                          <th>Requested User</th>
			                          <th>Requested Date</th>
			                          <th>Detail</th>
			                          
			                          
			                        </tr>
		                      	</thead>
	                      		<tbody>
	                      			<?php $count=1; ?>

	                      			@foreach($leave_users as $leave_user)
	                      				
	                      			<tr>
	                      				<td>{{$count}}</td>
	                      				
	                      				<td>{{$leave_user['account']['account_name']}}</td>
	                      				<td>{{$leave_user['request_date']}}</td>
	                      				<td><a href="{{url('leave_detail/'.$leave_user['id'])}}">Show Form</a></td>

	                      			</tr>
	                      			<?php $count++  ?>
	                      			@endforeach

	                      			

	                	 		</tbody>
	                	</table>
	               	</div>
                </div>
            </div>
		</div>
	</div>

	
@endsection