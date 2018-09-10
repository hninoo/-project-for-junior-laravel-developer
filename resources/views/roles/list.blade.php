@extends('layouts.admin')
@section('admin_view')
	
	<div class="row justify-content-center">
		<div class="col-md-6 d-flex align-items-stretch grid-margin">
			<div class="row flex-grow">
				<div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-center">Role Create</h4>
                      
                      {{ Form::open(array('url' => 'role/create','class'=>'forms-sample')) }}
                      		<div class="form-group">
                      			<div class="row">
                      			
                          			<div class="col-sm-4">
                          				<label for="exampleInputEmail1">Role Name</label>
                          			</div>
                          			<div class="col-sm-6">
                          				<input type="text" class="form-control"  placeholder="Enter Role Name" name="role_name">
                          			</div>
                          			
                        		</div>
                      		</div>

                          <div style="color: red !important;" align="center">{{$errors->first('role_name')}}</div>

                        
                        <div align="center">
                          <button type="submit" class="btn btn-success mr-2 ">Submit</button>
                        </div>
                        
                        <!-- <button class="btn btn-light">Cancel</button> -->
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title "><h5 class="text-center">Role Lists</h5></h4>
                  
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Role Name</th>
                          <th>Operation</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count=1;?>
                        @foreach($roles as $role)
      								<tr>
      									 <td>{{$count}}</td>
        									<td>{{$role['role_name']}}</td>
        									<td>
        										<a href="{{url('role/edit/'.$role['id'])}}" class="btn btn-outline-success">Edit</a>
        									</td>

								      </tr>
								      <?php $count++ ?>
							@endforeach
                        
                        

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
	</div>

		

@endsection
