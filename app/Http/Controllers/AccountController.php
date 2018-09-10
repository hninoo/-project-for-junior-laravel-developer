<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Account;
use App\Models\Role;
use App\Models\Account_role;
use App\Models\Timeplan;
use App\Models\Late;
use App\Models\Check;
use App\Models\Status;
use App\Models\Leave_absent;
use App\Models\Check_status;
use Auth;
use DB;
use Hash;
use DateTime;
use DateTimeZone;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.signin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'account_name'=>'required|regex:/^[a-zA-Z ]+$/|unique:accounts|max:255|min:3',

            'email'=>'required|string|email|max:255|unique:accounts',

            'password'=>'required',

            'phone' => 'required|min:6|numeric',

            'address' => 'required|string',

            'dob'=>'required|date',
            'nrc'=>'required',

            ]);
        // dd($validator);
        if($validator->fails())
        {
            // echo "Fail";die();
            return redirect('signup')->withErrors($validator)->withInput();
        }
        else
        {
            $account=new Account();
            $account->account_name=$request->input('account_name');
            $account->email=$request->input('email');
            $account->phone=$request->input('phone');
            $account->address=$request->input('address');
            $account->dob=$request->input('dob');
            $account->nrc=$request->input('nrc');
            $account->active=0;
            
            $account->password=bcrypt($request->input('password'));
            // dd($account);
            $account->save();
            return redirect("signin")->with('alert','Register Successful!!Please wait allowance of admin!!');
            
        }
    }

    public function signin(Request $request)
    {
        // echo "string";die();
        $validator=Validator::make($request->all(),[
            
            'email'=>'required|email|',  
            'password'=>'required',
            ]);
        // dd($validator);
        if($validator->fails())
        {
            // echo "fail";die();
            return redirect('signin')->withErrors($validator)->withInput();
        }
        else
        {
            // echo "success";die();

            $data['active']=Account::where('email',$request->input('email'))->where('active',1)->get()->toArray();
            // dd($data['active']);


            if($data['active']==null)
            {
                return redirect("signin")->with('alert', 'Please wait allowance of admin!!');
            }
            else
            {
                 $userdata=array('email'=>$request->input('email'),'password'=>$request->input('password'));
                 // dd($userdata);
                 if(Auth::attempt($userdata))
                {
                    $user_id=Auth::user()->id;
                    $name=Auth::user()->account_name;
                    $result=Account_role::where('account_id',$user_id)->get()->toArray();
                    // dd($result);
                    $role_id=$result[0]['role_id'];
                    // dd($role_id);
                    session()->put("account_name",$name);
                    session()->put("user_id",$user_id);
                    session()->put("role_id",$role_id);
                    if($role_id==1)
                    {
                        return redirect('unassigned_user');
                    }
                    else
                    {
                        return redirect('profile');
                    }
                }
                else
                {
                     return redirect("signin")->with('alert', 'Email or Password invalid!!');
                }

            }
                 
        }
    }
                             
    
    public function logout()
    {
        Auth::logout();
        return redirect("signin");
    }

    public function assign()
    {
        $data['users']=Account::with('role')->where('active',0)->get()->toArray();
        // dd($data['users']);
        $data['results']=Account::with("role")->where('active',1)->where('id','!=',1)->get()->toArray();
        // dd($data['results']);
        // dd($data);
        $data['roles']=Role::where('id','!=',1)->get()->toArray();
        $data['time_plans']=Timeplan::get()->toArray();
        // dd($data);
        return view('users.unassign_list',$data);
    }
    public function add_assign(Request $request)
    {
        $validator=Validator::make($request->all(),[
            
            'time_plan'=>'required',  
            'role_name'=>'required',
            ]);
        // dd($validator);
        if($validator->fails())
        {
            // echo "fail";die();
            return redirect('unassigned_user')->withErrors($validator)->withInput();
        }

        else
        {
            $id=$request->input("hideid");
        $role=$request->input("role_name");
        $time_plan_id=$request->input("time_plan");
        // dd($id);
        // dd($role);
        $user=Account::with("role")->where('id',$id)->first();
        
        $user->active=1;
        $user->save();

        $role_acc=new Account_role();
        $role_acc->account_id=$id;
        $role_acc->role_id=$role;
        $role_acc->time_plan_id=$time_plan_id;

        // dd($role_acc);
        $role_acc->save();
        
        return redirect('unassigned_user');
        }

        
    }

    public function block_user()
    {
        $block['block_users']=Account::with("role")->where('active',0)->get()->toArray();
        // dd($block);
        return view('users.unactive_list');
    }
    public function profile()
    {
        $user_id=session()->get('user_id');
        $role_id=session()->get('role_id');
         // dd($user_id,$role_id);
        $profile['user_data']=Account::join("account_roles","accounts.id","=","account_roles.account_id")->where('accounts.id',$user_id)->where('account_roles.role_id',$role_id)->first()->toArray();
        // dd($profile);
        return view('profiles.profile',$profile);
    }

    public function profile_edit($id)
    {
       // dd($id);
        $profile_data['data']=Account::where('id',$id)->first()->toArray();
        // dd($profile_data);
        return view('profiles.profile_edit',$profile_data);
    }

    public function profile_update(Request $request,$id)
    {
        $validator=Validator::make($request->all(),[
            
            'uname'=>'required',
            'phone'=>'required',
            'nrc'=>'required',
            'dob'=>'required',
            'address'=>'required',
            ]);
        if($validator->fails())
        {
            // echo "fail";die();
            return redirect('profile/edit/'.$id)->withErrors($validator)->withInput();
        }
        else
        {
            $user_data=Account::where('id',$id)->first();

           // dd($user_data);
            $user_data->account_name=$request->input('uname');
            $user_data->phone=$request->input('phone');
            $user_data->nrc=$request->input('nrc');
            $user_data->dob=$request->input('dob');
            $user_data->address=$request->input('address');

            // dd( $user_data);

            $user_data->save();
            return redirect("profile");
        }

    }

    public function changePasswordForm($id)
    {
        $data['res']=Account::where('id',$id)->first()->toArray();
        // dd($data);
        return view('profiles.change_password',$data);
    }
    
    public function changePassword(Request $request,$id)
    {
        // dd($id);
         $validator=Validator::make($request->all(),[
            
            'current_pass'=>'required',  
            'new_pass'=>'required',
            ]);
        
        if($validator->fails())
        {
            // echo "fail";die();
            return redirect('change_pass/'.$id)->withErrors($validator)->withInput();
        }
        else
        {
          
           if(strcmp($request->get('current_pass'),$request->get('new_pass'))==0)
           {
            return redirect("change_pass/".$id)->with('alert','Incorrect password');
           }

           $user=Account::where('id',$id)->first();

           // dd($request->get('new_pass'));

           $user->password=bcrypt($request->get('new_pass'));

           // dd($user->password);

           $user->save();

           return redirect('profile')->with('alert', 'Password Change Success!!');

        }

 
    }


    public function edit($id)
    {
        // dd($id);
        // $data['user']=Account::with("role")->where('id',$id)->first()->toArray();

        $data['user']=Account::join("account_roles","accounts.id","=","account_roles.account_id")
        ->where("accounts.id",$id)
        ->first()->toArray();

        // dd($data);

        $data['roles']=Role::where('id','!=',1)->get()->toArray();

        $data['time_plans']=Timeplan::get()->toArray();
        // dd($data);
        return view('users.assign_edit',$data);
    }

 
    public function update(Request $request,$id)
    {
       // dd($id);
        $validator = Validator::make($request->all(), [
            'timename' => 'required',
            'rolename' => 'required',
                  
        ]);

           if ($validator->fails()) 
           {
            // echo "fail";die();
            return redirect('assign/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
           }
           else
           {


              $acc_data=Account_role::join("accounts","accounts.id","=","account_roles.account_id")->where('accounts.id',$id)->first();
              // dd($acc_data);
               

              $acc_data->time_plan_id=$request->input('timename');
              // dd($acc_data->time_plan_id);
              $acc_data->role_id=$request->input('rolename');
               // dd($acc_data);

               $acc_data->save();
               return redirect('unassigned_user');
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Account::where('id',$id)->first();
        // dd($data);
        $data->active=0;
        $data->save();
        return redirect('unassigned_user');
    }

     public function leave_report()
    {
       $user_id=session()->get("user_id");

       $data['status']=Status::where("status_name","full day leave")->first();

       // dd($data['status']['id']);
       $status_id=$data['status']['id'];
       $data['leave_users']=Account::with("role")->where("accounts.id",$user_id)->first()->toArray();
      // dd($data);
      return view("leave.leave_report",$data);
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
           
          
           $timezone = 'Asia/Rangoon';
            $dt =new DateTime('now', new DateTimeZone($timezone));
            $currDate = date_format($dt, 'Y-m-d');
            // dd($currDate);
            return $currDate;
        }

    public function store_leave_rp(Request $request)
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
                
                $user_id=session()->get("user_id");
                $status_id=$request->input("status_id");
                // dd($status_id);
                // dd($user_id);
                $leave_reason=new Leave_absent();
                $leave_reason->start_date=$request->input('from_date');

                $leave_reason->end_date=$request->input('to_date');
                $leave_reason->reason=$request->input('reason');
                $leave_reason->number_of_day=$request->input('num_of_days');
                $leave_reason->request_date=$this->get_currdate();
                $leave_reason->request_status=0;
                $leave_reason->account_id=$user_id;
                $leave_reason->status_id=$status_id;
                

                // dd($leave_reason);
                $leave_reason->save();
               
                return redirect('requestLeave');
            }
    }

    public function requestLeave()
    {
       $user_id=session()->get("user_id");
       // dd($user_id);

        $result['req_leave']=Leave_absent::where("leave_absents.account_id",$user_id)->get()->toArray();
        // dd($result);
        return view('requests/requestLeave',$result);
    }

    public function leave_review($id)
    {
        // dd($id);
        $user_id=session()->get("user_id");
        // dd($user_id);

        $result['leave_res']=Account::join("account_roles","accounts.id","=","account_roles.account_id")->join("roles","roles.id","=","account_roles.role_id")->join("leave_absents","leave_absents.account_id","accounts.id")->where("leave_absents.account_id",$user_id)->where("account_roles.account_id",$user_id)->where("leave_absents.id",$id)->first()->toArray();

        // dd($result);
        return view('leave/review_leave',$result);
    }

    public function late_report()
    {
     // dd($id);
        $user_id=session()->get("user_id");

      $late_status=Status::where('status_name',"late")->first()->toArray();
      $late_status_id=$late_status['id'];

      $data['results']=Check_status::with("late","status")->join("checks","checks.id","=","check_statuses.check_id")->where("checks.account_id",$user_id)->where("check_statuses.status_id",$late_status_id)->get()->toArray();
        // dd($data);
      
      return view('late/list',$data);
    }

    public function reprint_late($id)
    {
        // dd($id);
        $user_id=session()->get("user_id");
        
        // dd($user_id);

        $data['user']=Account::join("account_roles","account_roles.account_id","=","accounts.id")->join("roles","roles.id","=","account_roles.role_id")->where('accounts.id',$user_id)->first()->toArray();
        
      $data['late_res']=Check_status::with("late","status")->join("checks","checks.id","=","check_statuses.check_id")->where("check_statuses.check_id",$id)->where("checks.account_id",$user_id)->first()->toArray();

        // dd($data);

      return view("late.late_report",$data);

    }

    public function reprint_late_store(Request $request,$id)
    {
        // dd($id);
        $user_id=session()->get("user_id");
        $late_status=Status::where("status_name","late")->first();
        
        $data['lates']=Check_status::with("late","status")->join("checks","checks.id","=","check_statuses.check_id")->where("check_statuses.check_id",$id)->where("checks.account_id",$user_id)->where("status_id",$late_status['id'])->select("check_statuses.*","checks.date","checks.check_in_time")->first()->toArray();
        // dd($data);
        if(!empty($data['lates']['late']))
        {
            return redirect("late_report");
        }
        else
        {
            $curr_date=$this->get_currdate();
            $data['user']=Account::join("account_roles","account_roles.account_id","=","accounts.id")->join("checks","checks.account_id","accounts.id")->join("check_statuses","check_statuses.check_id","=","checks.id")->with("role")->where("checks.id",$id)->where("checks.date",$curr_date)->where("active","!=",0)->first();

            $data['check']=Check::with("check_status")->where("id",$id)->where("date",$curr_date)->first();

             // dd($data);
            $check_status_id=$data['check']['check_status'][0]['id'];
                // dd($check_status_id);
            $late=new Late();
            $late->reason=$request->input("reason");
            $late->check_status_id=$check_status_id;
            // dd($late);
            $late->save();
            return redirect("late_report");
        }
    }
    
}