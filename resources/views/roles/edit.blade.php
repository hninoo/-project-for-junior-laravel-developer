@extends('layouts.admin')
@section('admin_view')

<div class="row justify-content-center">
		<div class="col-md-6 d-flex align-items-stretch grid-margin">
			<div class="row flex-grow">
				<div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-center">Role Edit</h4>
                      
                      {{ Form::open(array('url' => 'role/edit/'.$roles['id'],'class'=>'forms-sample')) }}
                      		<div class="form-group">
                      			<div class="row">
                      			
                          			<div class="col-sm-4">
                          				<label for="exampleInputEmail1">Role Name</label>
                          			</div>
                          			<div class="col-sm-6">
                          				<input type="text" class="form-control"  placeholder="Enter Role Name" name="role_name" value="{{$roles['role_name']}}">
                          			</div>
                          			
                        		</div>
                      		</div>
                        
                        
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

@endsection