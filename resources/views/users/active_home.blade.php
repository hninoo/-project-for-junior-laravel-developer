@extends('layouts.home')
@section('home_view')
<div class="container" style="margin-top:20px;">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" >
                <div class="card-body">
                  
                    <h4 class="card-title "></h4>
                      
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Operation</th>
                                

                              </tr>
                            </thead>
                            <tbody>
                               <?php
                                 $count=1;
                                ?>

                              @foreach($results as $result)
                                <tr>

                                  <td>{{$count}}</td>
                                  <td>{{$result['account_name']}}</td>
                                  <td>{{$result['email']}}</td>

                                    <td>
                                        
                                  @if(empty($chk_days))    
                                      <a href="{{url('checkin/'.$result['id'])}}" class="btn btn-outline-success">Checkin</a>

                                      

                                  @else
                                      @if($chk_days[$result['id']]==null)

                                          <a href="{{url('checkin/'.$result['id'])}}" class="btn btn-outline-success">Checkin</a>

                                      @else
                                          @if($chk_days[$result['id']]['account_id']==$result['id'])

                                               @if($chk_days[$result['id']]['check_out_time']=="00:00:00")

                                                  <a href="{{url('checkout/'.$result['id'])}}" class="btn btn-outline-success">Checkout</a>

                                                 

                                                   <label style="padding-left:40px;">

                                                      <font color="<?php if($chk_days[$result['id']]['check_in_time']>="09:16:00") { echo '#FF0000';}else{ echo '#000000';}?>">

                                                        <?php echo date("g:i A", strtotime($chk_days[$result['id']]['check_in_time'])); ?>


                                                        
                                                      </font>

                                                    </label> 
                                                 
                                              @elseif($chk_days[$result['id']]['check_out_time']!="00:00:00")
                                                 
                                                  <button disabled="true" class="btn btn-outline-success">Finished</button>
                                                  
                                                     
                                                  
                                                  <label style="padding-left:55px;">
                                                      
                                                      <font color="<?php if($chk_days[$result['id']]['check_in_time']>="09:16:00") { echo '#FF0000';}else{ echo '#000000';}?>">

                                                        <?php echo date("g:i A", strtotime($chk_days[$result['id']]['check_in_time'])); ?>
                                                      </font>

                                                </label>
                                                
                                                  <label>-</label>
                                                  <label  >
                                                    <font color="#FF00FF"><?php echo date("g:i A", strtotime($chk_days[$result['id']]['check_out_time'])); ?>
                                                    </font>
                                                  </label>


                                              @else
                                                  
                                                    <a href="{{url('checkin/'.$result['id'])}}" class="btn btn-outline-success">Checkin</a>
                                                 
                                                   
                                              @endif
                                      @endif
                                    @endif  
                                  @endif  
                                    </td>
                                 
                                
                                  
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