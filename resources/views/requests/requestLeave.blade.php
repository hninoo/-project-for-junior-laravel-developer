@extends('layouts.app')
@section('user')

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                	<div class="table-responsive">
	                    <table class="table" id="example">
		                      	<thead>
			                        <tr>
			                          <th>No</th>
			                          <th>Request Date</th>
			                          <th>Detail</th>
			                         
			                          
			                        </tr>
		                      	</thead>
	                      		<tbody>
	                      			<?php $count=1; ?>
	                      			@foreach($req_leave as $r_leave)
	                      			<tr>
	                      				<td>{{$count}}</td>
	                      				<td>{{$r_leave['request_date']}}</td>
	                      				<td><a href="{{url('leave_review/'.$r_leave['id'])}}"><font color="#FF0000" ><u>Show Form</u></font></a></td>
	                      		

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

	<!-- <script type="text/javascript">
		$(document).ready(function() {
    			$('#example').DataTable();
			} );
	</script> -->
@endsection