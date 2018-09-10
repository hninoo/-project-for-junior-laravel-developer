<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Account_role;
use App\Models\Timeplan;
use App\Models\Day;
use App\Models\Check;
use App\Models\Status;
use App\Models\Role;
use App\Models\Late;
use App\Models\Check_status;
use App\Models\Leave_absent;
use Validator;
use Auth;
use DB;

use DateTime;
use DateTimeZone;

class Checkin_outController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $curr_d=$this->get_currdate();
        // dd($curr_d);

        $role=Role::where('role_name',"Admin")->first();
        // dd($role);
        $data['results']=Account::join("account_roles","account_roles.account_id","=","accounts.id")->where('active','!=',0)->where('account_roles.role_id','!=',$role['id'])->get()->toArray();
        // dd($data['results']);
        foreach ($data['results'] as $res) 
        {
            // dd($res['id']);

             $data['chk_days'][$res['id']]=Check::where('date',$curr_d)->where('account_id',$res['id'])->first();

        }
        // dd($data);

        // dd($data['chk_days']);
       
        return view('users.active_home',$data);
    }

    public function checkin_form($id)
    {
        $result['users']=Account::where('id',$id)->first()->toArray();
     
        return view('users.check_in',$result);
    }
    public function get_currtime()
        {
           $timezone = 'Asia/Rangoon';
            $date = new DateTime('now', new DateTimeZone($timezone));
            $localtime = $date->format('H:i:s');
            // dd($localtime);
            return $localtime;
        }
    public function get_currdate()
        {
           
           ini_set('date.timezone', 'Asia/Rangoon');
            $dt = new DateTime();
            $currDate = date_format($dt, 'Y-m-d');
        // dd($currDate);
            return $currDate;
        }
   
    public function check_in(Request $request,$id)
    {
      
         $validator = Validator::make($request->all(), [
            'password'=>'required',
            ]);
        if($validator->fails())
            {
              
                return redirect('checkin/'.$id)->withErrors($validator)->withInput();

            }
        else
            {
                
                $userdata=array('email'=>$request->input('hidden_email'),'password'=>$request->input('password'),'id'=>$id);
                // dd($userdata);
              
                 if(Auth::attempt($userdata))
                    {
                        $user_id=Auth::user()->id;
                        session()->put("user_id",$user_id);

                        $today=date('D');
                      
                        $result['res']=Account_role::with('time_plan')->where('account_id',$id)->first()->toArray();
                       
                         $time_plan_id=$result['res']['time_plan']['id'];
                      

                         $result['check_day']=Day::with('office_time')->where('time_plan_id',$time_plan_id)->get()->toArray();
                          // dd($result['check_day']);
                         foreach ($result['check_day'] as $check) 
                         {
                            
                             if ($check['day_name']==$today) 
                             {
                               

                                 $day_name=$check['day_name'];
                                 $start_time=$check['office_time']['start_time'];
                              
                                 $allow_time=$check['office_time']['allow_time'];
                                 $end_time=$check['office_time']['end_time'];

                                
                             }

                            
                         }

                         $date=getdate();

                         // dd($today);
                         $chk_day=Day::where('day_name',$today)->get()->toArray();
                         // dd($chk_day);

                         if ($chk_day==null) 
                         {
                            
                            // echo "NULL";die();
                            $current_date=$this->get_currdate();
                            // dd($current_date);
                            $current_time=$this->get_currtime();
                            
                            $check_data=new Check();
                            $check_data->date=$current_date;
                            $check_data->check_in_time=$current_time;
                            $check_data->check_out_time="00:00:00";
                            $check_data->manhour=0;
                            $check_data->account_id=$id;
                            $check_data->time_plan_id=$time_plan_id;

                            $check_data->save();

                            $check_data=Check::where('account_id',$id)->first();
                            $check_id=$check_data['id'];


                            $status_name='ot';
                            // dd($status_name);
                            $status=Status::where('status_name',$status_name)->first();
                            $status_id=$status['id'];

                            $check_status=new Check_status();

                            $check_status->check_id=$check_id;

                            $check_status->status_id=$status_id;

                            $check_status->save();
                            return redirect('home');
                         }

                         else
                            {
                            // echo "True";die();
                            // dd($start_time,$allow_time);
                            // dd($allow_time);
                                $current_date=$this->get_currdate();

                                $time=$this->get_currtime();

                                $start_t=strtotime($start_time);
                               
                                $secs = strtotime($allow_time)-strtotime("00:00:00");
                          
                                $office_time=$start_t+$secs;
                               
                                $curr_time=strtotime($time);
                              
                                $half_day_leave=strtotime('11:00');
                            
                                $half_leave_late_day=strtotime("13:15");

                                $full_day_leave=strtotime('14:00');

                           
                                if($curr_time>$office_time && $curr_time<$half_day_leave)
                                    //checkin between 9:15am & 11:00am
                                    {
                                        $status='late';
                                        // dd($status);
                                    }

                                elseif($curr_time>$half_day_leave && $curr_time<$half_leave_late_day)
                                //check in time between 11:01pm and 1:15pm
                                    
                                    {
                                        $status='half day leave';
                                        // dd($status);   

                                    }
                                elseif($curr_time>$half_leave_late_day && $curr_time<$full_day_leave)
                                    //checkin between 1:16pm & 2:00pm
                                    {
                                         
                                        $status_late="late";
                                        $status_half="half day leave";
                                        // dd($status_late,$status);
                                        $current_date=$this->get_currdate();
                           
                                        $current_time=$this->get_currtime();
                                        
                                        $check_data=new Check();
                                        $check_data->date=$current_date;
                                        $check_data->check_in_time=$current_time;
                                        $check_data->check_out_time="00:00:00";
                                        $check_data->manhour=0;
                                        $check_data->account_id=$id;
                                        $check_data->time_plan_id=$time_plan_id;

                                        $check_data->save();

                                        $check_data=Check::where('account_id',$id)->first();
                                        $check_id=$check_data['id'];

                                        $status=Status::where('status_name',$status_late)->first();

                                        $status_id=$status['id'];
                                        // dd($status_id);

                                        $check_status=new Check_status();

                                        $check_status->check_id=$check_id;

                                        $check_status->status_id=$status_id;

                                        $sta_leave=Status::where('status_name',$status_half)->first();
                                        // dd($sta_leave);

                                        $sta_id=$sta_leave['id'];
                                        // dd($sta_id);
                                        $check_res=new Check_status();

                                        $check_res->check_id=$check_id;

                                        $check_res->status_id=$sta_id;


                                        $check_status->save();

                                        $check_res->save();

                                        return redirect('leave/'.$id);

                                        
                                    }
                                elseif($curr_time>$full_day_leave)
                                    {
                                        $status="full day leave";
                                        // dd($status);
                                    }
                                else
                                    {
                                        // check_in between 00:00am & 9:15am
                                        $status='intime';
                                        // dd($status);
                                    }
                                    $current_date=$this->get_currdate();
                           
                                    $current_time=$this->get_currtime();
                                    
                                    $check_data=new Check();
                                    $check_data->date=$current_date;
                                    $check_data->check_in_time=$current_time;
                                    $check_data->check_out_time="00:00:00";
                                    $check_data->manhour=0;
                                    $check_data->account_id=$id;
                                    $check_data->time_plan_id=$time_plan_id;

                                    $check_data->save();

                                    $check_datas=Check::where('account_id',$id)->where('date',$current_date)->first();
                                    // dd($check_datas);
                                    $check_id=$check_datas['id'];

                                    // dd($check_id);


                                    if( $status=='late')
                                    {
                                            $status=Status::where('status_name',$status)->first();
                                            $status_id=$status['id'];

                                            $check_status=new Check_status();

                                            $check_status->check_id=$check_id;

                                            $check_status->status_id=$status_id;
                                             // dd($check_status);
                                            $check_status->save();

                                            // return view('late/lateform');
                                           
                                            return redirect('late/'.$id);
                                    }
                                    elseif($status=="full day leave")
                                    {
                                         $status=Status::where('status_name',$status)->first();
                                        $status_id=$status['id'];

                                        $check_status=new Check_status();

                                        $check_status->check_id=$check_id;

                                        $check_status->status_id=$status_id;

                                        $check_status->save();
                                        return redirect('leave/'.$id);
                                    }
                                    elseif($status=='half day leave')
                                    {
                                         $status=Status::where('status_name',$status)->first();
                                        $status_id=$status['id'];

                                        $check_status=new Check_status();

                                        $check_status->check_id=$check_id;

                                        $check_status->status_id=$status_id;

                                        $check_status->save();
                                        return redirect('leave/'.$id);
                                    }
                                    elseif($status=='intime')
                                    {
                                        $status=Status::where('status_name',$status)->first();
                                        $status_id=$status['id'];

                                        $check_status=new Check_status();

                                        $check_status->check_id=$check_id;

                                        $check_status->status_id=$status_id;

                                        $check_status->save();
                                   
                                        return redirect('home');
                                    }


                            }

                    
                    }
            
                    else
                    {
                        return redirect('checkin/'.$id)->with('alert', 'Email or Password invalid!!');
                    }


            }
    }

    public function late($id)
    {
        // dd($id);
        $curr_date=$this->get_currdate();

       $data['late_results']=Account::join("checks","checks.account_id","=","accounts.id")->join("account_roles","account_roles.id","=","accounts.id")->join("roles","roles.id","=","account_roles.role_id")->join("check_statuses","check_statuses.check_id","=","checks.id")->where("accounts.id",$id)->where('checks.date',$curr_date)->first()->toArray();
       // dd($data['late_results']['account_id']);
       // dd($data);

       return view("late.lateform",$data);

    }

    public function store_late(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason'=>'required',
            ]);
        if($validator->fails())
            {
              
               return redirect('late/'.$id)
                        ->withErrors($validator)
                        ->withInput();

            }
        else
            {
              $late_reason=new Late();
              $late_reason->check_status_id=$request->input('hide_check_id');
              $late_reason->reason=$request->input('reason');

              // dd($late_reason);

              $late_reason->save();

              return redirect('home');

            } 

    }

    public function leave($id)
    {
        // dd($id);
        
        $curr_date=$this->get_currdate();



        $data['leave_res']=Account::join("checks","checks.account_id","=","accounts.id")->join("account_roles","account_roles.id","=","accounts.id")->join("roles","roles.id","=","account_roles.role_id")->join("check_statuses","check_statuses.check_id","=","checks.id")->where("accounts.id",$id)->where("checks.date",$curr_date)->first()->toArray();

        // dd($data);
        return view('leave.leaveform',$data);
  
    }

    public function store_leave(Request $request,$id)
    {   
       
        $validator = Validator::make($request->all(), [
            'reason'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'num_of_days'=>'required',
            ]);
        // dd($validator);
        if($validator->fails())
            {
              // echo "fail";die();
               return redirect('leave/'.$id)
                        ->withErrors($validator)
                        ->withInput();

            }
        else
            {
                // echo "true";die();
                $status_id=$request->input("status_id");
                // dd($status_id);
                $leave_reason=new Leave_absent();
                $leave_reason->start_date=$request->input('from_date');

                $leave_reason->end_date=$request->input('to_date');
                $leave_reason->reason=$request->input('reason');
                $leave_reason->number_of_day=$request->input('num_of_days');
                $leave_reason->request_date=$this->get_currdate();
                $leave_reason->request_status=0;
                $leave_reason->account_id=$id;
                $leave_reason->status_id=$status_id;
                // dd($leave_reason);
                $leave_reason->save();
               
                return redirect('home');
            }
    }

    public function check_out($id)
    {
        // dd($id);
        $half_day=new DateTime('12:00');
        $half_day_l = $half_day->format('H:i:s');

        $full_day=new DateTime('14:00');
        $full_day_l = $full_day->format('H:i:s');

        $office_end_time=new DateTime('17:00');
        $off_end_time = $office_end_time->format('H:i:s');
        // dd($half_day,$full_day,$office_end_time);
        $check_out_time=$this->get_currtime();
        // dd($check_out_time);
        // dd($half_day_l,$full_day_l,$off_end_time,$check_out_time);
       
        $current_date=$this->get_currdate();
        // dd($current_date);

        $l_status=Check::where('date',$current_date)->where('account_id',$id)->first();

        // dd($l_status);
     


        if($l_status['status_id']!=7)
        {
        	if($check_out_time<$half_day_l)
        	//checked out before 12:00Pm
		      {
		        
		        $leave_status="full day leave";
		         // dd($leave_status);

		      }
		     

		    elseif($check_out_time>$half_day_l && $check_out_time<$full_day_l)
		     //checked out between 12:01 pm - 2:00 pm
			 {
			 	
			      
			    $leave_status="half day leave";
			    // dd($leave_status);
			        
			 }

			elseif($check_out_time>$full_day_l && $check_out_time<$off_end_time)
		      //checked out btw 2:00pm -5:00 pm
		      {

		        $leave_status="early checkout";
		     	// dd( $leave_status);
		      }

		      else
		      {
		        
		         	$leave_status="intime";
		         	// dd($leave_status);
		        
		        
		      }

        } 

        $check_in_time=$l_status['check_in_time'];
        $time_plan_id=$l_status['time_plan_id'];
        // dd($check_in_time);
       

        $check_data=Check::where('account_id',$id)->where('date',$current_date)->first();
        // dd( $check_data);
        $check_id=$check_data['id'];
        // dd( $check_id);
      

        $check_in_time=$check_data['check_in_time'];
        // dd($check_in_time);

        $man_hour=strtotime($check_out_time)-strtotime($check_in_time);
        // dd($man_hour);
        $man_hr=date("H:i:s",$man_hour);
        // dd($man_hr);
      

        $check_data->date=$current_date;
        $check_data->check_in_time=$check_in_time;
        $check_data->check_out_time=$check_out_time;
        $check_data->manhour=$man_hr;
        $check_data->account_id=$id;
        $check_data->time_plan_id=$time_plan_id;

        // dd($check_data);
        $check_data->save();

		$status=Status::where('status_name',$leave_status)->first();
        $status_id=$status['id'];
        // dd($status_id);
        // dd($check_id);
        $check_status=new Check_status();

        $check_status->check_id=$check_id;

        $check_status->status_id=$status_id;

        // dd($check_status);

        $check_status->save();
        
        if($leave_status=="full day leave")
        {
            return redirect('leave/'.$id);
        }

         elseif($leave_status=="half day leave")
        {
            return redirect('leave/'.$id);
        }

         elseif($leave_status=="early checkout")
        {
            return redirect('home');
        }
        
        elseif($leave_status=="intime")
        {
            return redirect('home');
        }


    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
