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
			                         
			                          <th>Time</th>
			                          <th>Date</th>
			                          
			                          
			                        </tr>
		                      	</thead>
	                      		<tbody>
	                      			<?php $count=1; ?>

	                      			@foreach($results as $result)
	                      				
	                      			<tr>
	                      				<td>{{$count}}</td>
	                      				
	                      				<td>
	                      					<font color="#FF0000">{{$result['check_in_time']}}</font>
	                      				</td>
	                      				<td><a href="{{url('reprint_late/'.$result['check_id'])}}"><font color="#FF0000" ><u>{{$result['date']}}</u></font></a></td>
	                      				

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